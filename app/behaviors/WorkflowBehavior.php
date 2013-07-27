<?php

// todo: move to a separate project that is available through Composer.
class WorkflowBehavior extends CActiveRecordBehavior
{
    /**
     * @var string the name of the status attribute.
     */
    public $statusAttribute = 'status';
    /**
     * @var integer the default status.
     */
    public $defaultStatus;
    /**
     * @var array the status configurations.
     */
    public $statuses = array();

    /**
     * Actions to take before validating the owner.
     * @param CModelEvent $event
     */
    public function beforeValidate($event)
    {
        parent::beforeValidate($event);
        if ($this->owner->hasAttribute($this->statusAttribute)
            && empty($this->owner->{$this->statusAttribute}))
            $this->owner->{$this->statusAttribute} = $this->defaultStatus;
    }

    /**
     * Changes the status of the owner to the given status (if allowed).
     * @param string $newStatus the new status value.
     * @return boolean whether the status was changed.
     */
    public function changeStatus($newStatus)
    {
        if ($this->owner->hasAttribute($this->statusAttribute))
        {
            $oldStatus = $this->owner->{$this->statusAttribute};
            if ($this->isTransitionAllowed($oldStatus, $newStatus))
            {
                $this->owner->{$this->statusAttribute} = $newStatus;
                return $this->owner->save(true, array($this->statusAttribute));
            }
        }
        return false;
    }

    /**
     * Returns the current status id of the owner.
     * @return string the id.
     */
    public function getStatusId()
    {
        if (!$this->owner->hasAttribute($this->statusAttribute))
            throw new CException('Failed to get status id. Status attribute does not exist.');
        return $this->owner->{$this->statusAttribute};
    }

    /**
     * Returns the name of the status with the given id.
     * @param string $id the status id.
     * @return string the name.
     */
    public function getStatusName($id = null)
    {
        $options = $this->getStatusOptions();
        if (!isset($id))
            $id = $this->getStatusId();
        return isset($options[$id]) ? $options[$id] : '???';
    }

    /**
     * Returns the status configuration for the given status id.
     * @param string $id the status id.
     * @return array the config.
     */
    public function getStatusConfig($id = null)
    {
        if (!isset($id))
            $id = $this->getStatusId();
        return isset($this->statuses[$id]) ? $this->statuses[$id] : array();
    }

    /**
     * Returns the options for all available statuses.
     * @return array the options.
     */
    public function getStatusOptions()
    {
        $options = array();
        foreach ($this->statuses as $id => $status)
            if (isset($status['label']))
                $options[$id] = $status['label'];
        return $options;
    }

    /**
     * Returns the options for the allowed statuses.
     * @return array the options.
     */
    public function getAllowedStatusOptions()
    {
        $options = array();
        $config = $this->getStatusConfig();
        if (isset($config['transitions']) && is_array($config['transitions']))
            foreach ($config['transitions'] as $id)
                $options[$id] = $this->getStatusName($id);
        return $options;
    }

    /**
     * Returns whether the transition between the given statuses is allowed.
     * @param string $oldStatus the old status.
     * @param string $newStatus the new status.
     * @return boolean the result.
     */
    public function isTransitionAllowed($oldStatus, $newStatus)
    {
        $config = $this->statuses[$oldStatus];
        return isset($config['transitions'])
            && is_array($config['transitions'])
            && in_array($newStatus, $config['transitions']);
    }

    /**
     * Returns whether the owner has the given status.
     * @param string $id the status id.
     * @return boolean the result.
     */
    public function hasStatus($id)
    {
        return (string)$this->getStatusId() === (string)$id;
    }
}