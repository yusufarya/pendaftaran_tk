<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Murid extends BaseController
{
    function index()
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();

        $data['me'] = $cekSessionUser;
        $data['title'] = 'Pendaftaran';
        $data['active'] = 'Daftar';

        // $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->global['page_title'] = 'Pendaftaran - TK AMALIA';
        $this->loadViews('pendaftar/pendaftaran', $this->global, $data, NULL, TRUE);
    }
    
    function sppPayment()
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();

        $data['me'] = $cekSessionUser;
        $data['title'] = 'Pembayaran SPP';
        $data['active'] = 'spp';

        // $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->global['page_title'] = 'Pembayaran SPP - TK AMALIA';
        $this->loadViews('pendaftar/spp', $this->global, $data, NULL, TRUE);
    }
}
