<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FruitController extends CI_Controller {

    public function index() {
        $this->load->model('Fruit_model');
        $data['message'] = $this->Fruit_model->getMessage();
        $data['intro'] = $this->Fruit_model->getIntro();

        $this->load->view('fruit_view', $data);
    }
}
