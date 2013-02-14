<?php

Yii::import('email.models.EmailActiveRecord');

/**
 * This is the model class for table "email_message".
 *
 * The followings are the available columns in table 'email':
 * @property string $id
 * @property string $from
 * @property string $to
 * @property string $cc
 * @property string $bcc
 * @property string $subject
 * @property string $body
 * @property string $headers
 * @property string $createTime
 * @property integer $status
 */
class EmailMessage extends EmailActiveRecord {
	/**
	 * @var Swift_Message $message the message instance.
	 */
	public $message;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailMessage the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'email_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('from, to, subject, body, headers, createTime', 'required'),
			array('status', 'numerical', 'integerOnly' => true),
			array('subject', 'length', 'max' => 255),
			array('cc, bcc', 'safe'),
			// The following rule is used by search().
			array('id, from, to, cc, bcc, subject, body, headers, createTime, status', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'from' => Yii::t('label', 'From'),
			'to' => Yii::t('label', 'To'),
			'cc' => Yii::t('label', 'Cc'),
			'bcc' => Yii::t('label', 'Bcc'),
			'subject' => Yii::t('label', 'Subject'),
			'body' => Yii::t('label', 'Body'),
			'headers' => Yii::t('label', 'Headers'),
			'createTime' => Yii::t('label', 'Create Time'),
			'status' => Yii::t('label', 'Status'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('from', $this->from, true);
		$criteria->compare('to', $this->to, true);
		$criteria->compare('cc', $this->cc, true);
		$criteria->compare('bcc', $this->bcc, true);
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('headers', $this->headers, true);
		$criteria->compare('createTime', $this->createTime, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the number of recipients for this message.
	 * @return integer the count.
	 */
	public function getRecipientCount() {
		return isset($this->message) ? count($this->message->getTo()) : -1;
	}

	/**
	 * This method is invoked before saving a record (after validation, if any).
	 * @return boolean whether the saving should be executed. Defaults to true.
	 */
	protected function beforeSave() {
		if (parent::beforeSave()) {
			if (isset($this->message)) {
				$this->from = implode(', ', array_keys($this->message->getFrom()));
				$this->to = implode(', ', array_keys($this->message->getTo()));
				$cc = $this->message->getCc();
				if (is_array($cc)) {
					$this->cc = implode(', ', $cc);
				}
				$bcc = $this->message->getBcc();
				if (is_array($bcc)) {
					$this->bcc = implode(', ', $bcc);
				}
				$this->subject = $this->message->getSubject();
				$this->body = $this->message->getBody();
				$this->headers = implode('', $this->message->getHeaders()->getAll());
			}
			return true;
		}
		return false;
	}

	/**
	 * Converts this model to a string.
	 * @return string the text.
	 */
	public function __toString() {
		if (isset($this->message)) {
			$from = implode(', ', array_keys($this->message->getFrom()));
			$to = implode(', ', array_keys($this->message->getTo()));
			$headers = implode('', $this->message->getHeaders()->getAll());
			$body = $this->message->getBody();
			return 'From: ' . $from . PHP_EOL
				. 'To: ' . $to . PHP_EOL
				. 'Headers: ' . PHP_EOL . $headers
				. 'Body: ' . PHP_EOL . $body;
		}
		return '';
	}
}