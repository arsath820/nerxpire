<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class lamp extends CI_Model{
    abstract protected function prefixName($name);
}

class bulb extends lamp {

    public function prefixName($name, $seperator =".", $greet = "Dear") {
        if ($name == "anish kumar") {
            $prefix = "Mr"; 
        }
        elseif ($name == "angel kumar") {
            $prefix = "Mrs"; 
        }
        else {
            $prefix = ""; 
        }
        return "{$greet} {$prefix}{$seperator} {$name}";    
    }
}
?>