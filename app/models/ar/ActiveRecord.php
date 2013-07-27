<?php

/**
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class ActiveRecord extends CActiveRecord
{
    // Default active record statuses.
    const STATUS_DELETED = -1;
    const STATUS_DEFAULT = 0;

    /**
     * Returns the default named scope that should be implicitly applied to all queries for this model.
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        $scope = parent::defaultScope();
        if ($this->hasAttribute('status'))
        {
            $tableAlias = $this->getTableAlias(true, false/* do not check scopes */);
            $condition = $tableAlias . '.status >= 0';
            if (isset($scope['condition']))
            {
                if (strpos($scope['condition'], 'status') === false)
                    $scope['condition'] = '(' . $scope['condition'] . ') AND (' . $condition . ')';
            }
            else
                $scope['condition'] = $condition;
        }
        return $scope;
    }

    /**
     * Deletes the row corresponding to this active record.
     * @return boolean whether the deletion is successful.
     * @throws CException if the record is new
     */
    public function delete()
    {
        if ($this->asa('workflow') !== null)
        {
            $this->changeStatus(self::STATUS_DELETED);
            return true; // prevents hard deletion
        }
        return parent::delete();
    }

    /**
     * Hard deletes the record.
     * @return boolean whether the deletion is successful.
     */
    public function hardDelete()
    {
        return parent::delete();
    }
}

