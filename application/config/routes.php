<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Login Admin //
$route['admin'] = 'Login/adm';
$route['register'] = 'Login/register';
$route['logoutAdmin'] = 'Login/logout_adm';

$route['dashboard'] = 'Dashboard';

// Master Data registration //
$route['registrationList'] = 'Admin/registration';
$route['manageClass/(:any)'] = 'Admin/manageClass/$1';
$route['getPaymentRegister'] = 'Admin/getPaymentRegister';
$route['classList'] = 'Admin/classList';
$route['kelasDetail/(:any)'] = 'Admin/kelasDetail/$1';
$route['student'] = 'Admin/student';
$route['updateStudent/(:any)'] = 'Admin/ubahDataSiswa/$1';

// Pembayaran //
$route['administrativeCost'] = 'Payment/administrativeCost';
$route['update_biaya_administrasi'] = 'Payment/update_biaya_administrasi';
$route['reRegistrationPayment'] = 'Payment/reRegistrationPayment';
$route['sppPayment'] = 'Payment/sppPayment';

// PELANGGAN // 
$route['logout'] = 'Login/logout';
$route['home'] = 'Murid';
$route['registration'] = 'Pendaftar/index';
$route['payment-re-registration'] = 'Pendaftar/bayar_daftar_ulang';
$route['pembayaran'] = 'Pendaftar/next_pembayaran';
$route['buktiPembayaran'] = 'Pendaftar/buktiPembayaran';
$route['send_trx'] = 'Pendaftar/updateBayar';

// SPP //
$route['spp-payment'] = 'Murid/sppPayment';
$route['paySpp/(:any)'] = 'Murid/paySpp/$1';
$route['pembayaranSpp'] = 'Murid/pembayaranSpp';
$route['send_trx_spp'] = 'Murid/updateBayar';
