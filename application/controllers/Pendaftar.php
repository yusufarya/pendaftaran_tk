<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Pendaftar extends BaseController
{

    public function index()
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

    function daftar_murid()
    {
        $cekSessionUser = cekSessionUser();

        $me = $cekSessionUser;
        $post = $this->input->post(NULL);
        // Biodata Murid //
        $nama = ucwords($post['nama']);
        $jenis_kel = $post['jenis_kel'];
        $nik = $post['nik'];
        $tanggal = $post['tanggal'];
        $tempat_lahir = ucwords($post['tempat_lahir']);
        $tgl_lahir = $post['tgl_lahir'];
        $alamat = ucwords($post['alamat']);
        $negara = ucwords($post['negara']);
        $tinggal_dengan = ucwords($post['tinggal_dengan']);
        $anak_ke = $post['anak_ke'];
        $usia = $post['usia'];
        $no_telp = $post['no_telp'];
        // Data Wali //
        $nama_w = ucwords($post['nama_w']);
        $jenis_kel_w = $post['jenis_kel_w'];
        $nik_w = $post['nik_w'];
        $tempat_lahir_w = ucwords($post['tempat_lahir_w']);
        $tgl_lahir_w = $post['tgl_lahir_w'];
        $alamat_w = ucwords($post['alamat_w']);
        $negara_w = ucwords($post['negara_w']);
        $no_telp_w = $post['no_telp_w'];
        $email_w = $post['email_w'];

        $dataMurid = [
            'nama'      => $nama,
            'jenis_kel' => $jenis_kel,
            'nik'       => $nik,
            'tempat_lahir'   => $tempat_lahir,
            'tgl_lahir'   => $tgl_lahir,
            'alamat'   => $alamat,
            'negara'   => $negara,
            'tinggal_bersama'   => $tinggal_dengan,
            'anak_ke'   => $anak_ke,
            'usia'   => $usia,
            'no_telp'   => $no_telp
        ];
        $this->db->update('murid', $dataMurid, ['id' => $me['id']]);

        $dataWali = [
            'nama'      => $nama_w,
            'jenis_kel' => $jenis_kel_w,
            'nik'       => $nik_w,
            'tempat_lahir'   => $tempat_lahir_w,
            'tgl_lahir'   => $tgl_lahir_w,
            'alamat'   => $alamat_w,
            'negara'   => $negara_w,
            'no_telp'   => $no_telp_w,
            'email'   => $email_w,
            'murid_id'   => $me['id']
        ];
        $this->db->insert('wali_murid', $dataWali);

        $dataPendaftar = [
            'id'        => rand(10000000, 99999999),
            'murid_id'  => $me['id'],
            'status_bayar'  => 0,
            'tanggal'  => $tanggal,
        ];
        $this->db->insert('pendaftar', $dataPendaftar);

        redirect('pendaftar');
    }

    function do_upload_img()
    {
        $cekSessionUser = cekSessionUser();
        $me = $cekSessionUser;

        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fotoDiri')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            // $this->loadViews('pendaftar/pendaftaran', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            echo $data;

            // $this->loadViews('pendaftar/pendaftaran', $data);
        }
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];

        $this->db->update('murid', ['gambar' => $file_name], ['id' => $me['id']]);
        redirect('pendaftar');
    }

    function bayar_daftar_ulang()
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();
        $data['me'] = $cekSessionUser;
        $data['title'] = 'Pembayaran';
        $data['active'] = 'Pembayaran';

        $data['metode_bayar'] = $this->db->get('metode_pembayaran')->result_array();

        $this->global['page_title'] = 'Pendaftaran - TK AMALIA';

        $register = $this->db->get_where('pendaftar', ['murid_id' => $cekSessionUser['id']]);
        $checkRegister = $register->num_rows();
        $dataDaftar = $register->row_array();
        // pre($dataDaftar['status_bayar']);
        if ($checkRegister) {
            if ($dataDaftar['status_bayar']) {
                $this->next_pembayaran();
            } else {
                $this->loadViews('pendaftar/bayar_daftar_ulang', $this->global, $data, NULL, TRUE);
            }
        } else {
            $this->loadViews('pendaftar/bayar_daftar_ulang', $this->global, $data, NULL, TRUE);
        }
    }

    function next_pembayaran()
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();

        $register = $this->db->get_where('pendaftar', ['murid_id' => $cekSessionUser['id']]);
        $dataDaftar = $register->row_array();

        if ($dataDaftar['status_bayar'] == 0) {
            $nik = $this->input->post('nik');
            $murid_id = $this->input->post('murid_id');
            $metode_bayar = $this->input->post('metode_bayar');

            $getLasCode = $this->db->query('SELECT MAX(nomor) AS nomor FROM transaksi')->row();
            $kode = $getLasCode->nomor;
            if ($kode != '') {
                $kode = substr($kode, -4);
                $kode += 1;
                $kode = sprintf('%04d', $kode);
                $nomorTr = 'TRGS' . date('Ym') . $kode;
            } else {
                $kode = '0001';
                $kode = sprintf('%04d', $kode);
                $nomorTr = 'TRGS' . date('Ym') . $kode;
            }

            $dataTr = [
                'nomor'         => $nomorTr,
                'nik'           => $nik,
                'tanggal'       => date('Y-m-d'),
                'tahun'         => date('Y'),
                'metode_bayar'  => $metode_bayar
            ];

            $result = $this->db->insert('transaksi', $dataTr);
        } else {
            $result = '';
            // die();
        }

        if ($result) {
            $this->db->update('pendaftar', ['status_bayar' => 1], ['murid_id' => $murid_id]);
        }

        $this->form_validation->set_rules('metode_bayar', 'Pilih Pembayaran', 'trim|required|valid_email', [
            'required' => 'Pilih metode Pembayaran.'
        ]);

        if ($this->form_validation->run() != false) {
            $this->bayar_daftar_ulang();
        } else {
            $data['me'] = $cekSessionUser;
            $data['title'] = 'Pembayaran';
            $data['active'] = 'Pembayaran';

            $data['metode_bayar'] = $this->db->get('metode_pembayaran')->result_array();

            $this->global['page_title'] = 'Pendaftaran - TK AMALIA';
            $this->loadViews('pendaftar/bayar', $this->global, $data, NULL, TRUE);
        }
    }

    function buktiPembayaran()
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();

        $data['me'] = $cekSessionUser;
        $data['title'] = 'Pembayaran';
        $data['active'] = 'Pembayaran';

        $data['metode_bayar'] = $this->db->get('metode_pembayaran')->result_array();

        $this->global['page_title'] = 'Pendaftaran - TK AMALIA';
        $this->loadViews('pendaftar/bukti_bayar', $this->global, $data, NULL, TRUE);
    }

    function updateBayar()
    {
        $cekSessionUser = cekSessionUser();
        $me = $cekSessionUser;

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

        $this->db->update('pendaftar', ['gambar' => $file_name], ['murid_id' => $me['id']]);
        redirect('daftar_ulang');
    }
}
