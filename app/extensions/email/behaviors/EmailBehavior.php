<?php

/**
 * Class EmailBehavior
 * @author niskac
 */
class EmailBehavior extends CBehavior {
	/**
	 * @var string the application component id for the mailer.
	 */
	public $componentID = 'email';

	protected $_mailer;

	/**
	 * Creates an email message from a template.
	 * @param string $name the template name.
	 * @param array $config the email configuration.
	 * @return EmailMessage the model.
	 * @see Emailer::createFromTemplate
	 */
	public function createEmailFromTemplate($name, $config = array()) {
		return $this->getMailer()->createFromTemplate($name, $config);
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
	public function createEmail($from, $to, $subject, $body, $config = array()) {
		return $this->getMailer()->create($from, $to, $subject, $body, $config);
	}

	/**
	 * Sends a single email.
	 * @param EmailMessage $model the model instance.
	 * @return integer the number of recipients.
	 * @see Emailer::send
	 */
	public function sendEmail(EmailMessage $model) {
		return $this->getMailer()->send($model);
	}

	/**
	 * Returns the mailer component instance.
	 * @return Emailer the component.
	 */
	protected function getMailer() {
		if (isset($this->_mailer)) {
			return $this->_mailer;
		} else {
			return $this->_mailer = Yii::app()->getComponent($this->componentID);
		}
	}
}