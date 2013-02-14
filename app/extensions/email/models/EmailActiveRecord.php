<?php

/**
 * Class EmailActiveRecord
 */
class EmailActiveRecord extends CActiveRecord {
	// Active record statuses.
	const STATUS_DELETED = -1;
	const STATUS_DEFAULT = 0;

	/**
	 * @return array the default scope.
	 */
	public function defaultScope() {
		$scope = parent::defaultScope();
		if ($this->hasAttribute('status')) {
			$tableAlias = $this->getTableAlias(true, false/* do not check scopes */);
			$condition = $tableAlias . '.status>=0';
			$scope['condition'] = isset($scope['condition'])
				? '(' . $scope['condition'] . ') AND (' . $condition . ')'
				: $condition;
		}
		return $scope;
	}

	/**
	 * This method is invoked before saving a record (after validation, if any).
	 * @return boolean whether the saving should be executed. Defaults to true.
	 */
	protected function beforeSave() {
		if (parent::beforeSave()) {
			if ($this->isNewRecord && $this->hasAttribute('createTime')) {
				$this->createTime = new CDbExpression('NOW()');
			}
			return true;
		}
		return false;
	}

	/**
	 * This method is invoked before deleting a record.
	 * @return boolean whether the record should be deleted. Defaults to true.
	 */
	public function beforeDelete() {
		if (parent::beforeDelete() && $this->hasAttribute('status')) {
			$this->status = self::STATUS_DELETED;
			$this->save(false);
			return false; // Prevent actual DELETE query from being run
		} else {
			return true;
		}
	}
}