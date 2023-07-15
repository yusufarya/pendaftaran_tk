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
            echo json_encode(array('status' => 'success', 'dataTrans' => $dataTr, 'total_biaya' => number_format($biaya_detail['total_biaya']), 'biaya' => $biaya_detail['total_biaya']));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function accPayment()
    {
        $idPendaftar = $this->input->post('idPendaftar');
        $total_biaya = $this->input->post('total_biaya');
        $nomorTr = $this->input->post('nomorTr');
        $dataUpdate = ['status_bayar' => 1,];
        $update = $this->db->update('pendaftar', $dataUpdate, ['id' => $idPendaftar]);
        $dataUpdate1 = [
            'harga' => $total_biaya
        ];
        $update = $this->db->update('transaksi', $dataUpdate1, ['nomor' => $nomorTr]);
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

    function kelasDetail($idkelas)
    {
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;

        $data['dataDetail'] = $this->db->select('m.*, k.kode AS kode_kelas, k.kelompok')
            ->from('murid m')
            ->join('kelas AS k', 'k.id=m.kelas_id')
            ->where('k.id', $idkelas)
            ->get()->result_array();

        $data['me'] = $cekSession;
        $label = $data['dataDetail']  ? $data['dataDetail'][0]['kelompok'] : '';
        $data['title'] = 'Kelas ' . $label;
        $data['active'] = 'Kelas';

        $this->global['page_title'] = 'Detail Kelas - TK AMALIA';
        $this->loadViewsAdmin('admin/detailKelas', $this->global, $data, NULL, TRUE);
    }

    function student()
    {
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

    function ubahDataSiswa($id_murid)
    {
        $this->db->select('*');
        $this->db->from('murid');
        $this->db->where('id', $id_murid);
        $result = $this->db->get()->row_array();
        $data['mDetail'] = $result;

        $data['kelasInfo'] = $this->db->get('kelas')->result_array();
        $data['me'] = cekSession();
        $data['title'] = 'Ubah Data Murid';
        $data['active'] = 'Murid';

        $this->global['page_title'] = 'Ubah Data Murid - TK AMALIA';
        $this->loadViewsAdmin('admin/editDataMurid', $this->global, $data, NULL, TRUE);
    }

    function updateMurid()
    {
        $post = $this->input->post(NULL, true);

        $data = [
            'nama' => ucwords($post['nama']),
            'tempat_lahir' => $post['tempat_lahir'],
            'negara' => $post['negara'],
            'alamat' => $post['alamat'],
            'no_telp' => $post['no_telp'],
            'kelas_id' => $post['kelas_id'],
            'status' => $post['status'],
        ];
        $this->db->where('id', $post['id']);
        $update = $this->db->update('murid', $data);

        redirect('kelasDetail/' . $post['id']);
    }
}
