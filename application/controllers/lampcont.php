<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lampcont extends CI_Controller {
    public function index() {
        $this->load->model('bulb');
        
        // $data['message'] = $this->bulb->prefixName("anish kumar"); //can only do one name at a time

        $names = ["anish kumar","angel kumar"];

        $data['messages'] = [];

        foreach($names as $name) {
            $data['messages'][] = $this->bulb->prefixName($name);
        }

        $this->load->view('lampview',$data);
    }
}

?>