<?php

/**
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class ActiveRecord extends CActiveRecord
{
    // Active record statuses.
    const STATUS_DELETED = -1;
    const STATUS_DEFAULT = 0;

    /**
     * Returns a list of behaviors that this model should behave as.
     * @return array the behavior configurations (behavior name=>behavior configuration)
     */
    public function behaviors()
    {
        return array(
            'formatter' => array(
                'class' => 'vendor.crisu83.yii-formatter.behaviors.FormatterBehavior',
            ),
        );
    }

    /**
     * Returns the default named scope that should be implicitly applied to all queries for this model.
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        $scope = parent::defaultScope();
        if ($this->hasAttribute('status')) {
            $tableAlias = $this->getTableAlias(true, false /* do not check scopes */);
            $condition = $tableAlias . '.status >= 0';
            if (isset($scope['condition'])) {
                if (strpos($scope['condition'], 'status') === false) {
                    $scope['condition'] = '(' . $scope['condition'] . ') AND (' . $condition . ')';
                }
            } else {
                $scope['condition'] = $condition;
            }
        }
        return $scope;
    }

    /**
     * This method is invoked before saving a record (after validation, if any).
     * @return boolean whether the saving should be executed. Defaults to true.
     */
    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            $now = new CDbExpression('NOW()');

            if ($this->isNewRecord) {
                if ($this->hasAttribute('createdAt')) {
                    $this->createdAt = $now;
                }
            } else {
                unset($this->createdAt); // make sure we don't touch this.

                if ($this->status !== self::STATUS_DELETED && $this->hasAttribute('updatedAt')) {
                    $this->updatedAt = $now;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method is invoked before deleting a record.
     * @return boolean whether the record should be deleted. Defaults to true.
     */
    protected function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->hasAttribute('deletedAt')) {
                $this->deletedAt = new CDbExpression('NOW()');
            }
            if ($this->hasAttribute('status')) {
                $this->status = self::STATUS_DELETED;
            }
            $this->save(false);
            return false; // prevent actual DELETE query from being run
        }
        return true;
    }
}

