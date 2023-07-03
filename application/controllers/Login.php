<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cekSession = $this->db->get_where('murid', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession != '') {
            if ($cekSession) {
                redirect('home');
            } else {
                redirect('/');
            }
        }
        $data['cekLogin'] = 'Login Form ';
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password harus diisi!'
        ]);
        if ($this->form_validation->run() != false) {
            $this->_login();
        } else {
            $this->load->view('auth/login', $data);
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $users = $this->db->get_where('murid', ['email' => $email])->row_array();
        // print_r(password_verify($password, $users['password'])); die();
        if ($users) {
            if (password_verify($password, $users['password'])) {
                $data = [
                    'email' => $users['email']
                ];
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Email atau password salah.</div>');
                redirect('Login');
            }
            // if ($users['status'] > 0) {
            // } else {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, akun anda tidak aktif!</div>');
            //     redirect('Login');
            // }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, email anda belum terdaftar!</div>');
            redirect('Login');
        }
    }

    public function adm()
    {
        $cekSession = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        if ($cekSession != '') {
            if ($cekSession) {
                redirect('dashboard');
            } else {
                redirect('admin');
            }
        }
        $data['cekLogin'] = 'Login Admin';
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password harus diisi!'
        ]);
        if ($this->form_validation->run() != false) {
            $this->_loginAdm();
        } else {
            $this->load->view('auth/login', $data);
        }
    }

    private function _loginAdm()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $users = $this->db->get_where('users', ['email' => $email])->row_array();
        // print_r(password_verify($password, $users['password'])); die();
        if ($users) {
            if ($users['status'] > 0) {
                if (password_verify($password, $users['password'])) {
                    $data = [
                        'email' => $users['email']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Email atau password salah.</div>');
                    redirect('Login_admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, akun anda tidak aktif!</div>');
                redirect('Login_admin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger py-1" role="alert">Maaf, email anda belum terdaftar!</div>');
            redirect('Login_admin');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama lengkap', 'trim|required', [
            'required' => 'Nama harus diisi!'
        ]);
        $this->form_validation->set_rules('jenis_kel', 'Jenis Kelamin', 'trim|required', [
            'required' => 'Jenis Kelamin harus diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', [
            'required' => 'Email harus diisi!',
            'is_unique' => 'Maaf, email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', [
            'required' => 'password harus diisi!',
            'min_legth' => 'Password must be longer than 6 characters',
            'matches'   => 'Password dont match!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password2]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {

            $email = $this->input->post('email', true);

            $new_date = date('Y-m-d');

            $data = [
                'nama'      => $this->input->post('nama'),
                'alamat'    => $this->input->post('alamat'),
                'no_telp'   => $this->input->post('no_telp'),
                'jenis_kel' => $this->input->post('jenis_kel'),
                'email'     => $email,
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'status'    => 0,
                'tgl_dibuat' => $new_date
            ];

            $this->db->insert('murid', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success py-2" role="alert">Selamat! akun kamu berhasil dibuat.</div>');
            redirect('login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('message', '<div class="alert alert-success py-1" role="alert">Anda telah logout.</div>');
        redirect('login');
    }
    public function logout_adm()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('message', '<div class="alert alert-success py-1" role="alert">Anda telah logout.</div>');
        redirect('admin');
    }

    function cekUbahPassword()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $currPass = $data['users']['password'];
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password1');

        // cek password user yg telah ada di database
        if (!password_verify($current_password, $currPass)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Isi Password saat ini dengan benar!</div>');
        } else { // Jika password benar kemudian
            // cek Password baru , tidak boleh sama dengan Password lama
            if ($current_password == $new_password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password saat ini salah!</div>');
            } else {
                // Password sudah OK nih
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('users');

                $success = $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password anda berhasil diubah.</div>');
                if ($success != '') {
                    $data = array('status' => 'success', 'data' => $success);
                } else {
                    $data = array('status' => 'failed');
                }
                echo json_encode(array('status' => 'success', 'data' => $success));
            }
        }
    }
}
