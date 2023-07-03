<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    function listKategori($searchText = '', $orderText = '')
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('kategori');
        if ($searchText) {
            $this->db->like('nama', $searchText);
        }
        if ($orderText == 'id') {
            $this->db->order_by('id', 'ASC');
        } else if ($orderText == 'nama') {
            $this->db->order_by('nama', 'ASC');
        } else {
            $this->db->order_by('id', 'ASC');
        }
        return $this->db->get()->result_array();
    }

    function listBahanbaku($searchText = '', $orderText = '')
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('bahan_baku');
        if ($searchText) {
            $this->db->like('nama', $searchText);
        }
        if ($orderText == 'kode') {
            $this->db->order_by('kode', 'ASC');
        } else if ($orderText == 'nama') {
            $this->db->order_by('nama', 'ASC');
        } else {
            $this->db->order_by('kode', 'ASC');
        }
        return $this->db->get()->result_array();
    }
}
