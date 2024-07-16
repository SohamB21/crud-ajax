<?php
class ModCrud extends CI_Model
{
    public function addNewUser($data)
    {
        $this->db->insert('students', $data);
        return $this->db->insert_id();
    }
    public function getAllRecords()
    {
        return $this->db->get('students');
    }
    public function getLastRecord($stId)
    {
        return $this->db->get_where('students', array('stId' => $stId))->result_array();
    }
}
