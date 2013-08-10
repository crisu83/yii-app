<?php

Yii::import('vendor.phpnode.yiipassword.*');

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
 * @property string $lastLoginAt
 * @property string $lastActiveAt
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

    /**
     * @return array the behavior configurations (behavior name=>behavior configuration)
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), array(
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
            'workflow' => array(
                'class' => 'vendor.crisu83.yii-workflow.behaviors.WorkflowBehavior',
                'defaultStatus' => self::STATUS_DEFAULT,
                'statuses' => array(
                    self::STATUS_DEFAULT => array(
                        'label' => t('label', 'Default'),
                        'transitions' => array(self::STATUS_DELETED),
                    ),
                    self::STATUS_DELETED => array(
                        'label' => t('label', 'Deleted'),
                    ),
                ),
            ),
        ));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('name', 'required'),
            array('requiresNewPassword', 'numerical', 'integerOnly' => true),
            array('name, salt, password, passwordStrategy', 'length', 'max' => 255),
            // The following rule is used by search().
            array('id, name, lastLoginAt, lastActiveAt', 'safe', 'on' => 'search'),
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array_merge(parent::relations(), array(
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'id' => t('label', 'ID'),
            'name' => t('label', 'Name'),
            'password' => t('label', 'Password'),
            'lastLoginAt' => t('label', 'Last login at'),
            'lastActiveAt' => t('label', 'Last active at'),
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.lastLoginAt', $this->lastLoginAt, true);
        $criteria->compare('t.lastActiveAt', $this->lastActiveAt, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}