<?php

class User extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
    }

    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $address = $this->input->post('address');

            $data = array(
                'username' => $username,
                'email'    => $email,
                'mobile'   => $mobile,
                'address'  => $address,
            );

            $status = $this->user_model->insertUser($data);
            if ($status == true)
            {
                $this->session->set_flashdata('success','Successfully Added');
                redirect(base_url('user/add'));
            }    
            else 
            {
                $this->session->set_flashdata('error','Error');
                $this->load->view('user/add_user');
            }    
        }    
        else
        {
            $this->load->view('user/add_user');
        }
    }

    function index()
    {
        $data['users'] = $this->user_model->getAllUsers(); 
        $this->load->view('user/index',$data);
    }

    function edit($id)
    {
        // ✅ FIXED: use getUserById instead of getUsers
        $data['user'] = $this->user_model->getUserById($id); 
        $data['id'] = $id;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $address = $this->input->post('address');

            $updateData = array(
                'username' => $username,
                'email'    => $email,
                'mobile'   => $mobile,
                'address'  => $address,
            );

            $status = $this->user_model->updateUser($updateData, $id);
            if ($status == true)
            {
                $this->session->set_flashdata('success','Successfully updated');
                redirect(base_url('user/edit/'.$id)); 
            }    
            else 
            {
                $this->session->set_flashdata('error','Error');
                $this->load->view('user/edit_user', $data); 
            }    
        }
        else
        {
            $this->load->view('user/edit_user', $data); 
        }
    }   
    
    function delete($id)
    {
        if(is_numeric($id))
        {
            $status = $this->user_model->deleteUser($id);
            if ($status == true) {
                $this->session->set_flashdata('deleted','successfully Deleted');
                redirect(base_url('user/index/'));
            } else {
                $this->session->set_flashdata('error', 'Error');
                redirect(base_url('user/index/'));
            }
            
        }

    }

}
