<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'libraries/phpqrcode/qrcode/qrlib.php'); // Include the QRcode library

class AdminQRCode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
        $this->load->helper('url');
    }

    public function index()
    {
        if(empty($this->session->userdata('Admin'))) {
            redirect('admin/login');
        }
        $data['admin'] = $this->Madmin->get_by_id('tbl_admin', array('idAdmin' => $this->session->userdata('idAdmin')))->row();
    
        $config['base_url'] = base_url('admin_user_qrcode/page');
        $config['total_rows'] = $this->Madmin->count_all_data('tbl_user');
        $config['per_page'] = 3; 
        $config['uri_segment'] = 3; 
        $config['sort'] = 'idUser';
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $offset = ($page > 0) ? ($page - 1) * $config['per_page'] : 0;
        $data['users'] = $this->Madmin->get_data_paginated('tbl_user', $config['per_page'], $offset, $config['sort'])->result();
    
        $data['links']['pagination'] = $this->pagination->create_links();
        $data['links']['prev_page'] = ($page > 1) ? $page - 1 : 1;
        $data['links']['next_page'] = ($page < ceil($config['total_rows'] / $config['per_page'])) ? $page + 1 : 1;
        $data['links']['current_page'] = $page;
        $data['links']['num_pages'] = ceil($config['total_rows'] / $config['per_page']);    

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/menu', $data);

        $this->load->view('admin/qrcode/user_qrcode', $data);
        $this->load->view('admin/layout/footer');

    }

    public function generate_qr_code($idUser) {
        // Path to save QR code image
        $file = FCPATH.'assets/qrcodes/'.$idUser.'.png';
        
        // Generate QR code
        QRcode::png($idUser, $file, QR_ECLEVEL_H, 10);

        $this->session->set_flashdata('success','Berhasil generate qr code data user!'); 
        // Redirect back to user list page
        redirect('admin_user_qrcode');
    }

    public function download_qr_code($idUser) {
        $file = FCPATH.'assets/qrcodes/'.$idUser.'.png';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        } else {
            // Handle file not found
            $this->session->set_flashdata('error', 'QR Code not found.');
            redirect('admin_user_qrcode');
        }
    }
}
?>