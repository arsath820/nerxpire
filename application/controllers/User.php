<?php
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

    if (!$this->session->userdata('logged_in')) {
        $this->session->set_flashdata('message', 'You must log in first to continue');
        $this->session->set_flashdata('msg_type', 'danger');
        redirect('auth/login');
    }
        // Load both models
        $this->load->model('Student_model');
        $this->load->model('Reference_model');
    }

    // Default method to display students and references
    public function index() {
        // Get references (which also includes student data)
        $data['references'] = $this->Reference_model->get_references();
        $this->load->view('user_list', $data);
    }

    // Show Add form
    public function create() {
        $this->load->view('create_user');
    }

    // Insert new student and reference
    public function store() {
        $student_data = array(
        'name' => $this->input->post('name'),
        'age' => $this->input->post('age')
    );
    $student_id = $this->Student_model->insert_student($student_data);

    $reference_data = array(
        'student_id' => $student_id,
        'email' => $this->input->post('email'),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
    );
    $this->Reference_model->insert_reference($reference_data);
    $this->session->set_flashdata('message', 'User created successfully!');
    $this->session->set_flashdata('msg_type', 'success');

    redirect('user');
    }

    // Show Edit form
    public function edit($id) {
       $data['student'] = $this->db->get_where('students', array('id' => $id))->row();
       $data['reference'] = $this->db->get_where('reference', array('student_id' => $id))->row();
       $this->load->view('edit_user', $data);
    }

    // Update student and reference
    public function update($id) {
        $student_data = array(
        'name' => $this->input->post('name'),
        'age' => $this->input->post('age')
    );
    $this->Student_model->update_student($id, $student_data);

    $reference_data = array(
        'email' => $this->input->post('email')
    );
    $this->Reference_model->update_reference($id, $reference_data);
    $this->session->set_flashdata('message', 'User updated successfully!');
    $this->session->set_flashdata('msg_type', 'success');

    redirect('user');
    }

    // Delete
    public function delete($id) {
    // Delete from reference table first if there's foreign key constraint
    $this->db->where('student_id', $id);
    $this->db->delete('reference');

    // Then delete from students table
    $this->db->where('id', $id);
    $this->db->delete('students');
    $this->session->set_flashdata('message', 'User deleted successfully!');
    $this->session->set_flashdata('msg_type', 'danger');

    redirect(base_url('index.php/user')); // redirect to list page
    }
}
?>