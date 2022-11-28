<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Wall extends CI_Controller
{

    public function index()
    {
        $user_messages = $this->message->get_messages();

        $inbox = array();
        foreach($user_messages as $user_message)
        {
            $message_id = $user_message["message_id"];
            $comment = $this->comment->get_comments_from_message_id($user_message['message_id']);
            $user_message["comment"] = $comment;
            $user_message["user_id"] = $this->message->get_user_id($user_message['message_id']);
            $inbox[]=$user_message;
        }

        $param = array("first_name"=>$this->session->userdata('first_name'), "inbox"=>$inbox, "message_id"=> $message_id);
        $this->load->view('wall/show',$param);
    }

    public function add_message()
    {
        $result = $this->message->validate_message();

        if($result != "success")
        {
            $this->session->set_flashdata('input_errors', $result);
        }
        else
        {
            if($this->session->userdata('user_id') == null)
            {
                redirect("users/signin");
            }
            else
            {
                $this->message->add_message($this->input->post('message_input'));
            }
        }
        redirect("wall");
    }

    public function add_comment()
    {
        $result = $this->comment->validate_comment();

        if($result != "success")
        {
            $this->session->set_flashdata('input_errors', validation_errors());
        }
        else
        {
            if($this->session->userdata('user_id')==null)
            {
                redirect("users/signin");
            }
            else
            {
                $this->comment->add_comment($this->input->post());
            }
        }
        redirect("wall");
    }


}



?>