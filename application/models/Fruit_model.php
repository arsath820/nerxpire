<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fruit_model extends CI_Model {
    public $name;
    public $color;

    public function __construct() {
        parent::__construct();
        $this->name = "Strawberry";
        $this->color = "red";
    }

    public function intro() {
        return "The fruit is {$this->name} and the color is {$this->color}.";
    }

    public function getIntro() {
        return $this->intro();
    }

    public function getMessage() {
        return "Am I a fruit or a berry?";
    }
}
