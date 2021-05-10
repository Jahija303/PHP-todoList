<?php

class Task {

    public $task_id;
    public $description;
    public $completed;

    function __construct($task_id, $description, $completed)
    {
        $this->task_id = $task_id;
        $this->description = $description;
        $this->completed = $completed;
    }

    public function getTaskID() {
        return $this->task_id;
    }

    public function setDescription($desc) {
        $this->description = $desc;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setCompleted($completed) {
        $this->completed = $completed;
    }

    public function getCompleted() {
        return $this->completed;
    }

    public function toggleCompleted() {
        $this->getCompleted() ? $this->setCompleted(false) : $this->setCompleted(true);
    }
}

?>