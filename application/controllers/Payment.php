<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Payment extends BaseController
{

    public function administrativeCost()
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->Transaksi_model->listTransaksi($searchText, $order);

        $data['me'] = $cekSession;
        $data['title'] = 'Biaya Administrasi';
        $data['active'] = 'payment';

        $this->global['page_title'] = 'Biaya Administrasi - TK AMALIA';
        $this->loadViewsAdmin('admin/admin_cost', $this->global, $data, NULL, TRUE);
    }

    function update_biaya_administrasi()
    {
        $postData = $this->input->post(NULL, true);

        $pendaftaran = $postData['pendaftaran'];
        $seragam = $postData['seragam'];
        $buku_pembelajaran = $postData['buku_pembelajaran'];
        $alat_tulis = $postData['alat_tulis'];
        $tas_sekolah = $postData['tas_sekolah'];
        $spp_pertama = $postData['spp_pertama'];
        $porseni_asuransi = $postData['porseni_asuransi'];
        $potongan = $postData['potongan'];

        $dataUpdate = [
            'pendaftaran' => $pendaftaran,
            'seragam' => $seragam,
            'buku_pembelajaran' => $buku_pembelajaran,
            'alat_tulis' => $alat_tulis,
            'tas_sekolah' => $tas_sekolah,
            'spp_pertama' => $spp_pertama,
            'porseni_asuransi' => $porseni_asuransi,
            'potongan' => $potongan
        ];

        $update = $this->db->update('biaya_administrasi', $dataUpdate);
        redirect('administrativeCost');
    }

    public function reRegistrationPayment()
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->Transaksi_model->listTransaksi($searchText, $order);

        $data['me'] = $cekSession;
        $data['title'] = 'Data Pembayaran Pendaftaran';
        $data['active'] = 'payment';

        $this->global['page_title'] = 'Pembayaran - TK AMALIA';
        $this->loadViewsAdmin('admin/dataPembayaranPendaftaran', $this->global, $data, NULL, TRUE);
    }

    function sppPayment()
    {
        cekSession();
        $cekSession = cekSession();

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $order = $this->input->post('orderby');
        $data['order'] = $order;
        $data['dataDetail'] = $this->Transaksi_model->listTransaksi($searchText, $order);

        $data['me'] = $cekSession;
        $data['title'] = 'Pembayaran SPP';
        $data['active'] = 'payment';

        $this->global['page_title'] = 'Pembbayaran SPP - TK AMALIA';
        $this->loadViewsAdmin('admin/dataPembayaranSpp', $this->global, $data, NULL, TRUE);
    }
}
