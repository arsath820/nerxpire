<?php
class Student_model extends CI_Model {

    // Get all students
    public function get_students() {
        return $this->db->get('students')->result();  // Fetch all students
    }

    // Insert student
    public function insert_student($data) {
        $this->db->insert('students', $data);
        return $this->db->insert_id();  // Return inserted ID
    }

    // Update student
    public function update_student($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('students', $data);
    }

    // Delete student
    public function delete_student($id) {
        return $this->db->delete('students', array('id' => $id));
    }
}
?>