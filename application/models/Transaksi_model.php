<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    function getDataPendaftaran($searchText = '', $orderText = '')
    {
        $this->db->distinct();
        $this->db->select('dftr.*, m.nik, m.nama AS nama_murid, m.alamat');
        $this->db->from('pendaftar dftr');
        $this->db->join('murid AS m', 'm.id=dftr.murid_id', 'left');
        if ($searchText) {
            $this->db->like('m.nik', $searchText)->or_like('m.nama', $searchText);
        }
        if ($orderText == 'id') {
            $this->db->order_by('dftr.id', 'ASC');
        } else if ($orderText == 'nama') {
            $this->db->order_by('m.nama', 'ASC');
        } else {
            $this->db->order_by('dftr.id', 'DESC');
        }
        return $this->db->get()->result_array();
    }

    function getDataMurid($searchText = '', $orderText = '')
    {
        $this->db->distinct();
        $this->db->select('m.*');
        $this->db->from('murid m');
        $this->db->where('m.status', 1);
        if ($searchText) {
            $this->db->like('m.nama', $searchText)->or_like('u.nik', $searchText);
        }
        if ($orderText == 'id') {
            $this->db->order_by('m.nik', 'ASC');
        } else if ($orderText == 'nama') {
            $this->db->order_by('m.nama', 'ASC');
        } else {
            $this->db->order_by('m.nik', 'DESC');
        }
        return $this->db->get()->result_array();
    }

    function listTransaksi($searchText = '', $orderText = '')
    {
        $this->db->distinct();
        $this->db->select('tr.*, m.nama AS nama_murid, m.id AS murid_id, mb.nama AS metode_byr');
        $this->db->from('transaksi tr');
        $this->db->join('murid AS m', 'm.nik=tr.nik', 'left');
        $this->db->join('metode_pembayaran AS mb', 'mb.id=tr.metode_bayar', 'left');
        $this->db->where('tr.kode_spp', 0);
        if ($searchText) {
            $this->db->like('m.nik', $searchText)->or_like('m.nama', $searchText);
        }
        if ($orderText == 'nik') {
            $this->db->order_by('m.nik', 'ASC');
        } else if ($orderText == 'nama') {
            $this->db->order_by('m.nama', 'ASC');
        } else {
            $this->db->order_by('m.nik', 'DESC');
        }
        return $this->db->get()->result_array();
    }

    function getTrInfo($kode)
    {
        $query = "SELECT * FROM `transaksi` WHERE kode = '" . $kode . "' ";
        $data = $this->db->query($query);
        $result = $data->row_array();
        return $result;
    }

    function listTransaksiMe($nik, $searchText = '', $orderText = '')
    {
        $this->db->distinct();
        $this->db->select('tr.*, u.nama AS nama_sales');
        $this->db->from('transaksi tr');
        $this->db->join('users AS u', 'u.nik=tr.sales', 'left');
        $this->db->where('tr.sales', $nik);
        if ($searchText) {
            $this->db->like('nama_barang', $searchText)->or_like('u.nama', $searchText);
        }
        if ($orderText == 'kode') {
            $this->db->order_by('tr.kode', 'ASC');
        } else if ($orderText == 'barang') {
            $this->db->order_by('tr.nama_barang', 'ASC');
        } else if ($orderText == 'sales') {
            $this->db->order_by('u.nama', 'ASC');
        } else {
            $this->db->order_by('tr.kode', 'DESC');
        }
        return $this->db->get()->result_array();
    }
}
