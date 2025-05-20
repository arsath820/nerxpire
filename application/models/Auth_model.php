<?php
class Auth_model extends CI_Model {

    public function get_user_by_email($email) {
        return $this->db->get_where('reference', ['email' => $email])->row();
    }
}
