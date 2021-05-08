<?php

class Task {

    public $description;
    public $completed;

    function __construct($description, $completed)
    {
        $this->description = $description;
        $this->completed = $completed;
    }

    public function toggleCompleteTask() {
        $this->completed = true ? $this->completed = false : $this->completed = true;
    }

    public function isCompleted() {
        return $this->completed;
    }

    public function getDescription() {
        return $this->description;
    }
}

?>