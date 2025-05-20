<?php
// class User_model extends CI_Model {
//     public function __construct() {
//         parent::__construct();
//     }

//     public function get_all_users() {
//         $query = $this->db->get('students');
//         return $query->result_array();
//     }
// }
?>

<?php
class User_model extends CI_Model {
    public function get_users() {
        return $this->db->get('students')->result(); // Uses CI's query builder
    }
}
?>