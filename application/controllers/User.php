<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        //helper
        parent::__construct();
        is_logged_in();
    }
    
    public function  index() 
    {
        $data['title'] = 'My Profile';

        $data['user'] = $this->db->get_where('user', ['email' => 
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => 
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        //validasi file
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang diupload
            $upload_image = $_FILES['image']['name'];

            if($upload_image) {

                //setting file config
                $config['upload_path'] = './assets/img/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {

                    //replace old image in directory with new image, except picture with name default.png
                    $old_image = $data['user']['image'];
                    if($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            // flashdata / pesan
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Your profile has been updated</div>');
            redirect('user');
        }
    }

public function  changepassword() 
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => 
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'New Password', 'required|trim|min_length[3]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'Confirm New Password', 'required|trim|matches[newpassword1]');

        if($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            //mengambil value currentpassword dan newpassword1
            $current_password = $this->input->post('currentpassword');
            $new_password = $this->input->post('newpassword1');

            //cek input current password ke database
            if(!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Your current password is wrong!</div>');
                redirect('user/changepassword');
            } else {
                // cek apakah new password sama dengan current password
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    The New Password cannot be sama as your Current Password!</div>');
                    redirect('user/changepassword'); 
                } else {
                    // enkrip new password
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user'); 
                    
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                    Password Changed!</div>');
                    redirect('user/changepassword'); 
                }
            }
        }

    }

}