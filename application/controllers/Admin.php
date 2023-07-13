<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Admin extends BaseController
{

    public function registration()
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->Transaksi_model->getDataPendaftaran($searchText, $order);

        $data['me'] = $cekSession;
        $data['title'] = 'Data Pendaftar';
        $data['active'] = 'Pendaftaran';

        $this->global['page_title'] = 'Pendaftaran - TK AMALIA';
        $this->loadViewsAdmin('admin/dataPendaftaran', $this->global, $data, NULL, TRUE);
    }

    function getPaymentRegister()
    {
        $nik = $this->input->post('nik');

        $QRYB = "SELECT pendaftaran+seragam+buku_pembelajaran+alat_tulis+tas_sekolah+spp_pertama+porseni_asuransi-potongan AS total_biaya
        FROM biaya_administrasi";
        $biaya_detail = $this->db->query($QRYB)->row_array();

        $dataTr = $this->db->select('dt.*, mb.nama AS pembayaran')
            ->from('transaksi dt')
            ->join('metode_pembayaran AS mb', 'mb.id = dt.metode_bayar')
            ->where(['dt.nik' => $nik])
            ->get()->row_array();
        // pre($this->db->last_query());
        if ($dataTr) {
            echo json_encode(array('status' => 'success', 'dataTrans' => $dataTr, 'total_biaya' => number_format($biaya_detail['total_biaya'])));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function accPayment()
    {
        $idPendaftar = $this->input->post('idPendaftar');
        $dataUpdate = ['status_bayar' => 1];
        $update = $this->db->update('pendaftar', $dataUpdate, ['id' => $idPendaftar]);
        echo json_encode($update);
    }

    function classList()
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->Transaksi_model->getDataMurid($searchText, $order);

        $data['me'] = $cekSession;
        $data['title'] = 'Data Kelas';
        $data['active'] = 'Kelas';

        $this->global['page_title'] = 'Kelas - TK AMALIA';
        $this->loadViewsAdmin('admin/dataKelas', $this->global, $data, NULL, TRUE);
    }

    function addClassGroup()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');

        $insertData = [
            'kode' => $kode,
            'kelompok' => $nama,
        ];

        $this->db->insert('kelas', $insertData);
        redirect('classList');
    }

    function manageClass($idDaftar)
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->db->select('dt.*, m.nama AS nama_murid, m.usia, m.kelas_id, m.jenis_kel')
            ->from('pendaftar dt')
            ->join('murid m', 'm.id=dt.murid_id')
            ->where('dt.id', $idDaftar)
            ->get()->row_array();

        $data['me'] = $cekSession;
        $data['title'] = 'Update Kelas Murid';
        $data['active'] = 'Pendaftaran';

        $this->global['page_title'] = 'Pembagian Kelas - TK AMALIA';
        $this->loadViewsAdmin('admin/pembagian_kelas', $this->global, $data, NULL, TRUE);
    }

    function updateKelasMurid()
    {
        $murid_id = $this->input->post('murid_id');
        $kelas = $this->input->post('kelas');

        $updateData = [
            'kelas_id' => $kelas,
            'status' => 1,
        ];
        $this->db->where('id', $murid_id);
        $this->db->update('murid', $updateData);
        echo '{}';
    }

    function student()
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->Transaksi_model->getDataMurid($searchText, $order);

        $data['me'] = $cekSession;
        $data['title'] = 'Data Murid';
        $data['active'] = 'Murid';

        $this->global['page_title'] = 'Murid - TK AMALIA';
        $this->loadViewsAdmin('admin/dataMurid', $this->global, $data, NULL, TRUE);
    }
}
