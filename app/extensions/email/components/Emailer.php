<?php

require_once(__DIR__ . '/../lib/Swift/swift_required.php');
Yii::registerAutoloader(array('Swift', 'autoload'));
require(__DIR__ . '/../lib/Swift/swift_init.php');

/**
 * Class Emailer
 * @author niskac
 */
class Emailer extends CApplicationComponent {
	// Swift Mailer transport types.
	const TRANSPORT_PHP = 'php';
	const TRANSPORT_SMTP = 'smtp';

	// Mime content types.
	const CONTENT_PLAIN = 'text/plain';
	const CONTENT_HTML = 'text/html';

	/**
	 * @var string the transport type, valid values are 'php' and 'smtp'.
	 * Defaults to 'php'.
	 */
	public $transportType = self::TRANSPORT_PHP;
	/**
	 * @var array the email template configuration (name=>config).
	 */
	public $templates = array();
	/**
	 * @var string the mail options for the mailer.
	 * @see http://swiftmailer.org/docs/sending.html
	 */
	public $mailOptions;
	/**
	 * @var array the smtp options for the mailer.
	 * @see http://swiftmailer.org/docs/sending.html
	 */
	public $smtpOptions = array();
	/**
	 * @var string the path alias for where the email views are located.
	 */
	public $viewPath = 'application.views.mail';
	/**
	 * @var string the default character set.
	 */
	public $charset = 'utf8';
	/**
	 * @var string the logging category.
	 */
	public $logCategory = 'ext.email.components.Emailer';
	/**
	 * @var boolean whether the enable logging.
	 */
	public $logging = true;
	/**
	 * @var boolean whether to prevent the actual sending of emails.
	 */
	public $dryRun = false;

	protected $_mailer;
	protected $_failedRecipients = array();

	/**
	 * Initializes the component.
	 */
	public function init() {
		parent::init();
		if (!Yii::getPathOfAlias('email')) {
			Yii::setPathOfAlias('email', __DIR__ . '/..');
		}
	}

	/**
	 * Creates an email message from a template.
	 * @param string $name the template name.
	 * @param array $config the email configuration.
	 * @return EmailMessage the model.
	 */
	public function createFromTemplate($name, $config = array()) {
		if (!isset($this->templates[$name])) {
			throw new CException('Template `' . $name . '` not found.');
		}

		if (!isset($config['from'])) {
			throw new CException('Configuration must contain a `from` property.');
		}
		if (!isset($config['to'])) {
			throw new CException('Configuration must contain a `to` property.');
		}

		$data = isset($config['data']) ? $config['data'] : array();

		// Handle the subject.
		if (isset($config['subject'])) {
			$params = array();
			foreach ($data as $key => $value) {
				$params['{' . $key . '}'] = $value;
			}
			$subject = Yii::t('email', $config['subject'], $params);
		} else {
			throw new CException('Configuration must contain a `subject` property.');
		}
		// Handle the body/view.
		if (isset($config['body'])) {
			$body = $config['body'];
		} else if (isset($config['view'])) {
			$view = $config['view'];
			$controller = isset(Yii::app()->controller)
				? Yii::app()->controller
				: new CController('email')/* for console */;
			$view = strpos('.', $view) === false
				? $this->viewPath . '.' . $view
				: $view;
			$body = $controller->renderPartial($view, $data, true);
		} else {
			throw new CException('Configuration must contain a `body` or a `viewFile` property.');
		}

		$config = CMap::mergeArray($this->templates[$name], $config);
		return $this->create($config['from'], $config['to'], $subject, $body, $config);
	}

	/**
	 * Creates an email message.
	 * @param mixed $from the sender email address(es).
	 * @param mixed $to the recipient email address(es).
	 * @param string $subject the subject text.
	 * @param string $body the body text.
	 * @param array $config the email configuration.
	 * @return EmailMessage the model.
	 */
	public function create($from, $to, $subject, $body, $config = array()) {
		$message = Swift_Message::newInstance();

		// Determine content type and character set.
		$contentType = isset($config['contentType']) ? $config['contentType'] : self::CONTENT_HTML;
		$charset = isset($config['charset']) ? $config['charset'] : $this->charset;

		$message->setFrom($from)
			->setTo($to)
			->setSubject($subject)
			->setBody($body, $contentType, $charset);

		// Set cc and bcc if applicable.
		if (isset($config['cc'])) {
			$message->setCc($config['cc']);
		}
		if (isset($config['bcc'])) {
			$message->setBcc($config['bcc']);
		}

		Yii::import('email.models.EmailMessage');
		$model = new EmailMessage;
		$model->message = $message;
		$model->save(false);
		return $model;
	}

	/**
	 * Sends a single email.
	 * @param EmailMessage $model the model instance.
	 * @return integer the number of recipients.
	 */
	public function send(EmailMessage $model) {
		if ($this->logging) {
			$this->log(__CLASS__ . '.' . __FUNCTION__ . ':' . $model);
		}
		if ($this->dryRun) {
			return $model->getRecipientCount();
		}
		return $this->getMailer()->send($model->message, $this->_failedRecipients);
	}

	/**
	 * Logs the given email using Yii::log().
	 * @param string $message the message to log.
	 * @param integer $level the log level.
	 */
	protected function log($message, $level = CLogger::LEVEL_INFO) {
		Yii::log($message, $level, $this->logCategory);
	}

	/**
	 * Creates the transport instance.
	 * @return Swift_Transport the instance.
	 */
	protected function createTransport() {
		switch ($this->transportType) {
			case self::TRANSPORT_SMTP:
				$transport = Swift_SmtpTransport::newInstance();
				foreach ($this->smtpOptions as $option => $value) {
					$setter = 'set' . ucfirst($option);
					$transport->{$setter}($value); // sets option with the setter method
				}
				break;
			case self::TRANSPORT_PHP:
			default:
				$transport = Swift_MailTransport::newInstance();
				if (isset ($this->mailOptions)) {
					$transport->setExtraParams($this->mailOptions);
				}
				break;
		}
		return $transport;
	}

	/**
	 * Returns the mailer instance.
	 * @return Swift_Mailer the instance.
	 */
	public function getMailer() {
		if (isset($this->_mailer)) {
			return $this->_mailer;
		} else {
			$transport = $this->createTransport();
			return $this->_mailer = Swift_Mailer::newInstance($transport);
		}
	}

	/**
	 * Returns a list of the failed recipients for the most recent mail.
	 * @return array the recipients.
	 */
	public function getFailedRecipients() {
		return $this->_failedRecipients;
	}
}