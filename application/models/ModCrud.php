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
    public function checkUser($data)
    {
        return $this->db->get_where('students', $data)->result_array();
    }
    public function updateUser($data)
    {
        $this->db->where('stId', $data['stId']);
        return $this->db->update('students', $data);
    }
}
