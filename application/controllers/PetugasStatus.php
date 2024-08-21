<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PetugasStatus extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index()
    {
        if (empty($this->session->userdata('Petugas'))) {
            redirect('petugas/login');
        }
        $data['petugas'] = $this->Madmin->get_by_id('tbl_petugas', array('idPetugas' => $this->session->userdata('idPetugas')))->row();
        $data['petugas1'] = $this->Madmin->get_all_data('tbl_petugas')->result();

        $config['base_url'] = base_url('petugas_status/page');
        $config['total_rows'] = $this->Madmin->count_all_data('tbl_status_pengambilan');
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['sort'] = 'tanggal';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $offset = ($page > 0) ? ($page - 1) * $config['per_page'] : 0;
        $data['status'] = $this->Madmin->get_data_paginated('tbl_status_pengambilan', $config['per_page'], $offset, $config['sort'])->result();

        $data['links']['pagination'] = $this->pagination->create_links();
        $data['links']['prev_page'] = ($page > 1) ? $page - 1 : 1;
        $data['links']['next_page'] = ($page < ceil($config['total_rows'] / $config['per_page'])) ? $page + 1 : 1;
        $data['links']['current_page'] = $page;
        $data['links']['num_pages'] = ceil($config['total_rows'] / $config['per_page']);

        $this->load->view('petugas/layout/header', $data);
        $this->load->view('petugas/layout/menu', $data);
        $this->load->view('petugas/status/tampil', $data);
        $this->load->view('petugas/layout/footer');
    }

    public function scan()
    {
        if (empty($this->session->userdata('Petugas'))) {
            redirect('petugas/login');
        }
        $data['petugas'] = $this->Madmin->get_by_id('tbl_petugas', array('idPetugas' => $this->session->userdata('idPetugas')))->row();
        $data['petugas1'] = $this->Madmin->get_all_data('tbl_petugas')->result();

        $this->load->view('petugas/layout/header', $data);
        $this->load->view('petugas/layout/menu', $data);
        $this->load->view('petugas/status/scan');
        $this->load->view('petugas/layout/footer');
    }

    public function process_scan()
    {
        if (empty($this->session->userdata('Petugas'))) {
            redirect('petugas/login');
        }

        // Ambil idPetugas dari session
        $idPetugas = $this->session->userdata('Petugas')['idPetugas'];

        // Ambil data idUser dari POST
        $idUser = $this->input->post('idUser');

        if ($idUser) {
            // Cek apakah sudah ada scan hari ini
            $today = date('Y-m-d');
            $existing_entry = $this->Madmin->check_existing_scan($idUser, $today);

            if ($existing_entry) {
                $this->session->set_flashdata('error', 'User tersebut telah anda scan hari ini!');
                redirect('petugas_status');
            } else {
                $data = [
                    'idUser' => $idUser,
                    'idPetugas' => $idPetugas,
                    'keterangan' => 'Sudah Diambil',
                    'tanggal' => date('Y-m-d H:i:s')
                ];

                $this->Madmin->insert("tbl_status_pengambilan", $data);
                $this->session->set_flashdata('success', 'Berhasil tambah data status pengambilan!');
                redirect('petugas_status');
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses QR code.');
            redirect('petugas_status');
        }
    }
    public function get_by_id($id)
    {
        if (empty($this->session->userdata('Petugas'))) {
            redirect('petugas_status');
        }
        $data['petugas'] = $this->Madmin->get_by_id('tbl_petugas', array('idPetugas' => $this->session->userdata('idPetugas')))->row();
        $dataWhere = array('idStatus' => $id);
        $data['status'] = $this->Madmin->get_by_id('tbl_status_pengambilan', $dataWhere)->row_object();
        $this->load->view('petugas/layout/header', $data);
        $this->load->view('petugas/layout/menu', $data);
        $this->load->view('petugas/status/form_edit', $data);
        $this->load->view('petugas/layout/footer');
    }
    public function edit()
    {
        if (empty($this->session->userdata('Petugas'))) {
            redirect('petugas/login');
        }
        $id = $this->input->post('id');
        $id_u = $this->input->post('idUser');
        $id_p = $this->input->post('idPetugas');
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');

        $dataUpdate = array(
            'idUser' => $id_u,
            'idPetugas' => $id_p,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan
        );
        $this->Madmin->update('tbl_status_pengambilan', $dataUpdate, 'idStatus', $id);
        $this->session->set_flashdata('success', 'Berhasil ubah data status pengambilan!');
        redirect('petugas_status');
    }

    public function delete($id)
    {
        if (empty($this->session->userdata('Petugas'))) {
            redirect('petugas_status');
        }
        $this->Madmin->delete('tbl_status_pengambilan', 'idStatus', $id);
        $this->session->set_flashdata('success', 'Berhasil hapus data status pengambilan!');
        redirect('petugas_status');
    }
}
