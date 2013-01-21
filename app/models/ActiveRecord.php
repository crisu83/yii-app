<?php

class ActiveRecord extends CActiveRecord
{
	// todo: implement status (e.g. deleted)

	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			$user = Yii::app()->getUser(); /* @var CWebUser $user */
			$now = new CDbExpression('NOW()');

			if ($this->isNewRecord)
			{
				if ($this->hasAttribute('creatorId'))
					$this->creatorId = $user->id;

				if ($this->hasAttribute('createTime'))
					$this->createTime = $now;
			}
			else
			{
				unset($this->createTime);
				unset($this->creatorId);

				if ($this->hasAttribute('updaterId'))
					$this->updaterId = $user->id;

				if ($this->hasAttribute('updateTime'))
					$this->updateTime = $now;
			}

			return true;
		}
		else
			return false;
	}
}

