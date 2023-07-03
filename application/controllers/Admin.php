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

    function addKategori()
    {
        $nama = $this->input->post('nama');
        $keterangan = $this->input->post('keterangan');
        $data = [
            'nama' => ucwords($nama),
            'keterangan' => ucfirst($keterangan)
        ];
        $result = $this->db->insert('kategori', $data);
        if ($result) {
            redirect('kategoriList');
        } else {
            die('Proses Gagal. Hubungi Administrator');
        }
    }

    function updateKeterangan()
    {
        $id = $this->input->post('id_edit');
        $nama = $this->input->post('nama_edit');
        $keterangan = $this->input->post('ket_edit');
        $data = [
            'nama' => ucwords($nama),
            'keterangan' => ucfirst($keterangan)
        ];
        $this->db->where("id", $id);
        $result = $this->db->update('kategori', $data);
        if ($result) {
            redirect('kategoriList');
        } else {
            die('Proses Gagal. Hubungi Administrator');
        }
    }

    function deleteKategori()
    {
        $id = $this->input->post('id_del');
        $this->db->where('id', $id);
        $this->db->delete('kategori');
        redirect('kategoriList');
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
