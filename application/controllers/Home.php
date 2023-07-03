<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController
{

    public function index()
    {
        cekSessionUser();
        $cekSessionUser = cekSessionUser();

        $data['me'] = $cekSessionUser;
        $data['title'] = 'Home Admin';
        $data['active'] = 'Home';

        $this->global['page_title'] = 'Home - BENGKEL LAS';
        $this->loadViews('pelanggan/home', $this->global, $data, NULL, TRUE);
    }
}
