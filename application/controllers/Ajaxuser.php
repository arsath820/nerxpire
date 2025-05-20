<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // if (!$this->session->userdata('logged_in')) {
        //     echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        //     exit;
        // }

        $this->load->model('Student_model');
        $this->load->model('Reference_model');
    }

    public function index() {
        $this->load->view('ajax_user_list'); // New view
    }

    public function fetch_all() {
        $data = $this->Reference_model->get_references();
        echo json_encode($data);
    }

    public function store() {
        $student_data = [
            'name' => $this->input->post('name'),
            'age'  => $this->input->post('age')
        ];
        $student_id = $this->Student_model->insert_student($student_data);

        $reference_data = [
            'student_id' => $student_id,
            'email'      => $this->input->post('email'),
            'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];
        $this->Reference_model->insert_reference($reference_data);

        echo json_encode(['status' => 'success']);
    }

    public function edit($id) {
        $student = $this->db->get_where('students', ['id' => $id])->row();
        $reference = $this->db->get_where('reference', ['student_id' => $id])->row();

        echo json_encode([
            'student' => $student,
            'reference' => $reference
        ]);
    }

    public function update($id) {
        $student_data = [
            'name' => $this->input->post('name'),
            'age'  => $this->input->post('age')
        ];
        $this->Student_model->update_student($id, $student_data);

        $reference_data = ['email' => $this->input->post('email')];
        $password = $this->input->post('password');
        if (!empty($password)) {
            $reference_data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $this->Reference_model->update_reference($id, $reference_data);

        echo json_encode(['status' => 'success']);
    }

    public function delete($id) {
        $this->Reference_model->delete_reference($id);
        $this->Student_model->delete_student($id);

        echo json_encode(['status' => 'success']);
    }
}
