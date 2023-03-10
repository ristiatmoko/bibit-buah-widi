<?php

class Pelanggan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggan');	
        $this->load->model('m_auth');
        $this->load->model('m_admin');
    }

    public function register()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required', array('required' => '%s Harus Di Isi !!'));

        $this->form_validation->set_rules('email', 'email', 'required|is_unique[tbl_pelanggan.email]', array(
            'required' => '%s Harus Di Isi !!',
        ));

        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus Di Isi !!'));

        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]', array(
            'required' => '%s Harus Di Isi !!',
            'matches' => '%s Password Tidak Sama'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register Pelanggan',
                'isi'   => 'v_register',
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        } else {
            $data = array(
                'nama_pelanggan'    => $this->input->post('nama_pelanggan'),
                'email'             => $this->input->post('email'),
                'password'          => $this->input->post('password'),
            );
            $this->m_pelanggan->register($data);
            $this->session->set_flashdata('pesan', 'Register Berhasil, Silahkan Login !');
            redirect('pelanggan/register');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => '%s Harus Di isi !!'
        ));

        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Di isi !!'
        ));

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->pelanggan_login->login($email, $password);
        }
            
        $data = array(
            'title' => 'Login Pelanggan',
            'isi'   => 'v_login_pelanggan',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function logout()
    {
        $this->pelanggan_login->logout();
    }

    public function akun()
    {
        //proteksi halaman
        $this->pelanggan_login->proteksi_halaman();
        $data = array(
            'title' => 'Akun saya',
            'isi' => 'v_akun_saya'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function index($offset = 0)
    {
        $data = array(
            'title' => 'Pelanggan',
            'pesanan_masuk_notif' => $this->m_admin->pesanan_masuk_notif(),
            'pelanggan' => $this->m_pelanggan->get_all_data(),
            'isi'   => 'admin/v_pelanggan', 
        );
        $this->load->view('layout/v_wrapper_backend',$data, FALSE);
    }
//hapus pelanggan
    public function delete ($id_pelanggan = NULL)
    {
        $data=array('id_pelanggan' => $id_pelanggan);
        $this->m_pelanggan->delete($data);
        $this->session->set_flashdata('pesan','Data Berhasil di Hapus !');
        redirect('pelanggan');
    }
//edit pelanggan
    public function edit($id_pelanggan= NULL)
    {
        $data = array(
            'id_pelanggan' => $id_pelanggan,
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $this->m_pelanggan->edit($data);
        $this->session->set_flashdata('pesan','Data Berhasil di edit !');
        redirect('pelanggan');
    }
}
