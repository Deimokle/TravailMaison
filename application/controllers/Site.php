<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller
{

    /**
     * FRONT
     */
    public function index()
    {
        $data['page_title'] = "Melodhier Admin accueil";
        $this->load->view('site/include/header', $data);
        $this->load->view('site/include/menu', $data);
        $this->load->view('site/homepage_view', $data);
        $this->load->view('site/include/footer', $data);
    }

    public function set_display($mode)
    {
        $this->session->set_userdata("display", $mode);
    }

    /**
     * FRONT (ajax)
     * @return string
     */
    public function get_display()
    {
        echo $this->session->userdata("display");
        return;
    }

    public function get_localtime()
    {
        echo date("M d H:i:s Y");
    }

}