<?php
class Reference_model extends CI_Model {

    // Get references for all students
    public function get_references() {
        $this->db->select('students.id,students.name, students.age, reference.email');
        $this->db->from('reference');
        $this->db->join('students', 'students.id = reference.student_id'); // Join with students table
        return $this->db->get()->result();  // Fetch all reference data with student info
    }

    public function insert_reference($data) {
        return $this->db->insert('reference', $data);
    }

    public function update_reference($student_id, $data) {
        $this->db->where('student_id', $student_id);
        return $this->db->update('reference', $data);
    }

    public function delete_reference($student_id) {
        return $this->db->delete('reference', array('student_id' => $student_id));
    }
}
?>