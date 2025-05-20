<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fruitcont extends CI_Controller {

    public function index() {
        $this->load->model('fruitmod');
        $strawberry = new Strawberry("Strawberry", "red");
        $data['message'] = $strawberry->message(); 

        $this->load->view('fruitv',$data);
    }
}
?>