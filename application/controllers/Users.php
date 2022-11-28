<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Users extends CI_Controller
{

    public function index()
    {
        $current_user_id = $this->session->userdata('user_id');

        if(!$current_user_id)
        {
            $this->load->view('templates/header');
            $this->load->view('users/signin');
        }
        else
        {
            redirect("wall");
        }
        
    }

    public function signin()
    {
        $current_user_id = $this->session->userdata('user_id');

        if(!$current_user_id)
        {
            $this->load->view('templates/header');
            $this->load->view('users/signin');
        }
        else
        {
            redirect("wall");
        }
    }

    public function register()
    {
        $current_user_id = $this->session->userdata('user_id');

        if(!$current_user_id)
        {
            $this->load->view('templates/header');
            $this->load->view('users/register');
        }
        else
        {
            redirect("wall");
        }
    }

    public function logoff()
    {
        $this->session->ses_destroy();
        redirect("/");
    }

    public function process_signin()
    {
        $result = $this->user->validate_signin_form();
        if($result != "success")
        {
            $this->session->set_flashdata('input_erros'. $result);
            redirect("/");
        }
        else
        {
            $email = $this->input->post('email');
            $user = $this->user->get_user_by_email($email);

            $result = $this->user->validate_signin_match($user, md5($this->input->post('password')));
            
            if($result == "success")
            {
                $this->session->set_userdata(array('user_id'=>$user['id'], 'first_name'=>$user['first_name']));
                redirect("wall");
            }
            else
            {
                $this->session->set_flashdata('input_errors', $result);
            }
        }
    }

    public function process_registration()
    {
        $email = $this->input->post('email');
        $result = $this->user->validate_registration($email);

        if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect('register');
        }
        else
        {
            $form_data = $this->input->post();
            $this->user->create_user($form_data);

            $new_user = $this->user->get_user_by_email($form_data['email']);
            $this->session->set_userdata(array('user_id' => $new_user['id'], 'first_name' => $new_user['first_name']));
            redirect("wall");
        }
    }
    

}



?>