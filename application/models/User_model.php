<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{    
    function getUserfo($id) {
        $query = "SELECT * FROM `users` WHERE id = '".$id."' ";
        $data = $this->db->query($query);
        $result = $data->result_array(); 
        return $result;
    }   

}