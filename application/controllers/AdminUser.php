<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');

        if (empty($this->session->userdata('Admin'))) {
            redirect('admin/login');
        }
    }

    public function index()
    {
        $data['admin'] = $this->Madmin->get_by_id('tbl_admin', array('idAdmin' => $this->session->userdata('idAdmin')))->row();

        $config['base_url'] = base_url('admin_user/page');
        $config['total_rows'] = $this->Madmin->count_all_data('tbl_user');
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['sort'] = 'idUser';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $offset = ($page > 0) ? ($page - 1) * $config['per_page'] : 0;
        $data['user'] = $this->Madmin->get_data_paginated('tbl_user', $config['per_page'], $offset, $config['sort'])->result();

        $data['links']['pagination'] = $this->pagination->create_links();
        $data['links']['prev_page'] = ($page > 1) ? $page - 1 : 1;
        $data['links']['next_page'] = ($page < ceil($config['total_rows'] / $config['per_page'])) ? $page + 1 : 1;
        $data['links']['current_page'] = $page;
        $data['links']['num_pages'] = ceil($config['total_rows'] / $config['per_page']);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/menu', $data);
        $this->load->view('admin/user/tampil', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add()
    {
        if (empty($this->session->userdata('Admin'))) {
            redirect('admin/login');
        }
        $data['admin'] = $this->Madmin->get_by_id('tbl_admin', array('idAdmin' => $this->session->userdata('idAdmin')))->row();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/menu', $data);
        $this->load->view('admin/user/form_tambah');
        $this->load->view('admin/layout/footer');
    }

    public function save()
    {
        if (empty($this->session->userdata('Admin'))) {
            redirect('admin/login');
        } else {
            $this->form_validation->set_rules('name', 'Nama User', 'required');
            $this->form_validation->set_rules('userName', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('statusAktif', 'Status Aktif', 'required');

            if ($this->form_validation->run() == FALSE) {
                $error_name = form_error('name');
                $error_userName = form_error('userName');
                $error_password = form_error('password');
                $error_alamat = form_error('alamat');
                $error_statusAktif = form_error('statusAktif');

                $input_name = $this->input->post('name');
                $input_userName = $this->input->post('userName');
                $input_password = $this->input->post('password');
                $input_alamat = $this->input->post('alamat');
                $input_statusAktif = $this->input->post('statusAktif');

                $this->session->set_flashdata('error_name', $error_name);
                $this->session->set_flashdata('error_userName', $error_userName);
                $this->session->set_flashdata('error_password', $error_password);
                $this->session->set_flashdata('error_alamat', $error_alamat);
                $this->session->set_flashdata('error_statusAktif', $error_statusAktif);

                $this->session->set_flashdata('input_name', $input_name);
                $this->session->set_flashdata('input_userName', $input_userName);
                $this->session->set_flashdata('input_password', $input_password);
                $this->session->set_flashdata('input_alamat', $input_alamat);
                $this->session->set_flashdata('input_statusAktif', $input_statusAktif);
                redirect('admin_user/add');
            } else {

                $name = $this->input->post('name');
                $userName = $this->input->post('userName');
                $password = $this->input->post('password');
                $alamat = $this->input->post('alamat');
                $statusAktif = $this->input->post('statusAktif');
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $dataInput = array(
                    'name' => $name,
                    'userName' => $userName,
                    'password' => $hashed_password,
                    'alamat' => $alamat,
                    'statusAktif' => $statusAktif
                );

                $this->Madmin->insert('tbl_user', $dataInput);
                $this->session->set_flashdata('success', 'Berhasil tambah data user!');
                redirect('admin_user');
            }
        }
    }

    public function get_by_id($id)
    {
        if (empty($this->session->userdata('Admin'))) {
            redirect('admin/login');
        }
        $data['admin'] = $this->Madmin->get_by_id('tbl_admin', array('idAdmin' => $this->session->userdata('idAdmin')))->row();

        $dataWhere = array('idUser' => $id);
        $data['user'] = $this->Madmin->get_by_id('tbl_user', $dataWhere)->row_object();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/menu', $data);
        $this->load->view('admin/user/form_edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit()
    {
        // Pastikan admin sudah login
        if (empty($this->session->userdata('Admin'))) {
            redirect('admin/login');
        }

        // Ambil ID pengguna dari input
        $idUser = $this->input->post('id');

        // Ambil data pengguna saat ini dari database
        $user = $this->Madmin->get_by_id('tbl_user', 'idUser', $idUser);

        // Ambil input dari form
        $nama = $this->input->post('name');
        $userName = $this->input->post('userName');
        $password = $this->input->post('password');
        $alamat = $this->input->post('alamat');
        $statusAktif = $this->input->post('statusAktif');

        // Siapkan array untuk data yang akan diperbarui
        $dataUpdate = array();

        // Periksa setiap input; jika tidak kosong, tambahkan ke $dataUpdate
        if (!empty($nama)) {
            $dataUpdate['name'] = $nama;
        }
        if (!empty($userName)) {
            $dataUpdate['userName'] = $userName;
        }
        if (!empty($alamat)) {
            $dataUpdate['alamat'] = $alamat;
        }
        if (!empty($statusAktif)) {
            $dataUpdate['statusAktif'] = $statusAktif;
        }

        // Khusus untuk password, periksa apakah diisi
        if (!empty($password)) {
            // Hash password baru
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $dataUpdate['password'] = $hashedPassword;
        }

        // Jika ada data yang perlu diperbarui, lakukan update
        if (!empty($dataUpdate)) {
            $this->Madmin->update('tbl_user', $dataUpdate, 'idUser', $idUser);
            $this->session->set_flashdata('success', 'Berhasil ubah data user!');
        }
        redirect('admin_user');
    }

    public function delete($id)
    {
        $this->Madmin->delete('tbl_user', 'idUser', $id);
        $this->session->set_flashdata('success', 'Berhasil hapus data akun!');
        redirect('admin_user');
    }
}
