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

    function paySpp($bulan)
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();
        $data['me'] = $cekSessionUser;
        $data['title'] = 'Pembayaran SPP - ' . getNamaBulan($bulan);
        $data['active'] = 'spp';

        $data['metode_bayar'] = $this->db->get('metode_pembayaran')->result_array();

        $this->global['page_title'] = 'Pendaftaran - TK AMALIA';

        $register = $this->db->get_where('pendaftar', ['murid_id' => $cekSessionUser['id']]);
        $checkRegister = $register->num_rows();
        // $dataDaftar = $register->row_array();

        $register = $this->db->get_where('transaksi', ['nik' => $cekSessionUser['nik'], 'kode_spp' => $bulan]);
        $dataDaftar = $register->row_array();
        $data['bulan'] = $bulan;

        if ($checkRegister != '' && $dataDaftar != '') {
            $this->next_pembayaran();
        } else {
            $this->loadViews('pendaftar/bayar_spp', $this->global, $data, NULL, TRUE);
        }
    }

    function pembayaranSpp()
    {
        $nik = $this->input->post('nik');
        $harga = $this->input->post('harga');
        $bulan = $this->input->post('bulan');
        $metode_bayar = $this->input->post('metode_bayar');

        $getLasCode = $this->db->query('SELECT MAX(nomor) AS nomor FROM transaksi')->row();
        $kode = $getLasCode->nomor;
        if ($kode != '') {
            $kode = substr($kode, -4);
            $kode += 1;
            $kode = sprintf('%04d', $kode);
            $nomorTr = 'TRSP' . date('Ym') . $kode;
        } else {
            $kode = '0001';
            $kode = sprintf('%04d', $kode);
            $nomorTr = 'TRSP' . date('Ym') . $kode;
        }

        $dataTr = [
            'nomor'         => $nomorTr,
            'kode_spp'      => $bulan,
            'nik'           => $nik,
            'tanggal'       => date('Y-m-d'),
            'tahun'         => date('Y'),
            'harga'         => $harga,
            'metode_bayar'  => $metode_bayar
        ];

        $qry_byr = $this->db->get_where('transaksi', ['nik' => $nik, 'kode_spp' => $bulan]);
        $nl_trs = $qry_byr->row_array();
        if (!$nl_trs) {
            $this->db->insert('transaksi', $dataTr);
        }

        $this->buktiPembayaran($bulan);
    }

    function buktiPembayaran($bulan)
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();

        $data['me'] = $cekSessionUser;
        $data['title'] = 'Pembayaran Spp';
        $data['active'] = 'spp';
        $data['bulan'] = $bulan;

        $data['metode_bayar'] = $this->db->get('metode_pembayaran')->result_array();

        $this->global['page_title'] = 'Pendaftaran - TK AMALIA';
        $this->loadViews('pendaftar/bukti_bayar_spp', $this->global, $data, NULL, TRUE);
    }

    function updateBayar()
    {
        $cekSessionUser = cekSessionUser();
        $me = $cekSessionUser;

        $bulan = $this->input->post('bulan');

        $config['upload_path']          = './assets/img/pembayaran/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('buktiBayar')) {
            $error = array('error' => $this->upload->display_errors());
            // print_r($error);
            // $this->loadViews('pendaftar/pendaftaran', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            // pre($data);

            // $this->loadViews('pendaftar/pendaftaran', $data);
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];

        $this->db->update('transaksi', ['gambar' => $file_name], ['nik' => $me['nik'], 'kode_spp' => $bulan]);
        redirect('payment-re-registration');
    }
}
