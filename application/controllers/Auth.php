<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->config->load('recaptcha');
    }

    // Show login form
    public function login() {
        if ($this->session->userdata('logged_in')) {
        $this->session->set_flashdata('message', 'You are already logged in!');
        $this->session->set_flashdata('msg_type', 'info');
        redirect('user');
    }
        $this->load->view('login_view');
    }

    // Handle login form submit
    public function do_login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $response = $this->input->post('g-recaptcha-response');

    if (!$response) {
       $this->session->set_flashdata('message', 'Please complete the CAPTCHA');
       $this->session->set_flashdata('msg_type', 'danger');
       redirect('auth/login');
    }

    $this->config->load('recaptcha');
    $secret = $this->config->item('recaptcha_secret_key');

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captcha_result = json_decode($verify);

    if (!$captcha_result->success) {
       $this->session->set_flashdata('message', 'CAPTCHA verification failed.');
       $this->session->set_flashdata('msg_type', 'danger');
       redirect('auth/login');
    }


    if ($this->form_validation->run() === FALSE) {
        $this->load->view('login_view');
    } else {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->Auth_model->get_user_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            // Login success - set session
            $this->session->set_userdata([
                'user_id' => $user->student_id,
                'email' => $user->email,
                'logged_in' => TRUE
            ]);
                $this->session->set_flashdata('message', 'Login successful!');
                $this->session->set_flashdata('msg_type', 'success');
                redirect('user');
            } else {
                // Login failed
                $this->session->set_flashdata('message', 'Invalid email or password');
                $this->session->set_flashdata('msg_type', 'danger');
                redirect('auth/login');
            }
        }
    }

    // Logout
    public function logout() {
        $this->session->set_flashdata('message', 'Logout successful!');
    $this->session->set_flashdata('msg_type', 'success');
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        redirect('auth/login');
    }
}
