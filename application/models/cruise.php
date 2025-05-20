<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cruise extends CI_Model {
    const MESSAGE = "Thank you";

public function getmessage() {
    return self::MESSAGE;
}
}
?>