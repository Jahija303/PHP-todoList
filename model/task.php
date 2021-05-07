<?php

class Task {
    public $description;
    public $completed = false;

    function __construct($description)
    {
        $this->description = $description;
    }

    public function completeTaskj() {
        $this->completed = true;
    }

    public function isCompleted() {
        return $this->completed;
    }
}

?>