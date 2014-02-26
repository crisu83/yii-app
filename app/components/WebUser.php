<?php

Yii::import('vendor.nordsoftware.yii-audit.behaviors.AuditChanger');

// todo: add missing comments.
class WebUser extends CWebUser
{
    protected $_model;

    public function init()
    {
        parent::init();
        $this->updateLastActiveAt();
    }

    /**
     * Loads the user model for the logged in user.
     * @return User the model.
     */
    public function loadModel()
    {
        if (isset($this->_model)) {
            return $this->_model;
        } else {
            if ($this->isGuest) {
                return null;
            }
            return null; // todo: fix this in the build by adding a fixture.
            //return $this->_model = User::model()->findByPk($this->id);
        }
    }

    /**
     * Updates the users last active at field.
     * @return boolean whether the update was successful.
     */
    public function updateLastActiveAt()
    {
        if (!$this->isGuest) {
            if (($model = $this->loadModel()) !== null) {
                $model->lastActiveAt = sqlDateTime();
                return $model->save(true, array('lastActiveAt'));
            }
        }
        return false;
    }

    /**
     * Updates the users last login at field.
     * @return boolean whether the update was successful.
     */
    public function updateLastLoginAt()
    {
        if (!$this->isGuest) {
            if (($model = $this->loadModel()) !== null) {
                $model->lastLoginAt = sqlDateTime();
                return $model->save(true, array('lastLoginAt'));
            }
        }
        return false;
    }

    public function getId()
    {
        return !$this->isGuest ? parent::getId() : 0;
    }
}