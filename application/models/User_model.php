<?php 

class User_model extends CI_Model 
{
    function insertUser($data)
    {
        $this->db->insert('users',$data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

   
    function getAllUsers()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }

  
    function getUserById($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('users');
        return $query->row();
    }

    
    function updateUser($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('users',$data);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

     function deleteUser($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('users');
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }
}
