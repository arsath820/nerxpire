<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cruisecont extends CI_Controller {
    public function index() {
        $this->load->model('cruise');
        
        $data['message'] = $this->cruise->getmessage();

        $this->load->view('cruiseview',$data);
    }
}

?>