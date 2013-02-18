<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $salt
 * @property string $password
 * @property string $passwordStrategy
 * @property boolean $requiresNewPassword
 * @property integer $creatorId
 * @property string $createTime
 * @property integer $updaterId
 * @property string $updateTime
 */
class User extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	public function behaviors()
	{
		Yii::import('vendor.phpnode.yiipassword.*');

		return array(
			'password' => array(
				'class' => 'APasswordBehavior',
				'defaultStrategyName' => 'bcrypt',
				'strategies' => array(
					'bcrypt' => array(
						'class' => 'ABcryptPasswordStrategy',
						'workFactor' => 12,
					),
				),
			),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('requiresNewPassword', 'numerical', 'integerOnly' => true),
			array('name, salt, password, passwordStrategy', 'length', 'max' => 255),
			// The following rule is used by search().
			array('id, name, creatorId, createTime, updaterId, updateTime', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'creatorId' => 'Creator',
			'createTime' => 'Created',
			'updaterId' => 'Updater',
			'updateTime' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('creatorId', $this->creatorId);
		$criteria->compare('createTime', $this->createTime, true);
		$criteria->compare('updaterId', $this->updaterId);
		$criteria->compare('updateTime', $this->updateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}