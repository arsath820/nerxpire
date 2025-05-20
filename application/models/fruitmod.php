<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class fruitmod extends CI_Model {
    public $name;
    public $color;

    public function __construct() {
        parent::__construct();
        $this->name = "strawberry";
        $this->color = "red";
    }

    private function intro() {
        return "The fruit is {$this->name} and the color is {$this->color}.";
    }

    public function showintro() {
        return $this->intro();
    }

}

class strawberry extends fruitmod {
    public function message() {
        return "Am I a fruit or a berry?<br>" . $this->showintro();
    }
}

?>