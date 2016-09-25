<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paddle extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('paddle_model');
        $this->authcheck->check_is_admin();
    }

    public function index($catalogue_id)
    {

        $data['title']        = "Gestion Paddle";
        $data['paddles']      = $this->paddle_model->get_all();
        $data['catalogue_id'] = $catalogue_id;

        $this->load->view('bo/include/header_admin', $data);
        $this->load->view('bo/include/menu_admin', $data);
        $this->load->view('bo/paddle/paddle_index_view', $data);
        $this->load->view('bo/include/footer_admin', $data);
    }

    public function add($catalogue_id)
    {
        $this->form_validation->set_rules('num_paddle', 'Num_paddle', 'required|trim');
        $this->form_validation->set_rules('source', 'Source', 'required|trim');
        $this->form_validation->set_rules('client_code', 'Client_code', 'required|trim');
        $this->form_validation->set_rules('client_id', 'Client', 'trim');
        $this->form_validation->set_rules('nom_temp', 'Nom_temp', 'required|trim');
        $this->form_validation->set_rules('email', 'Email   ', 'required|trim');

        if ($this->form_validation->run() !== FALSE)
        {
            $postdata["catalogue_id"] = $catalogue_id;
            $postdata["num_paddle"]   = $this->input->post('num_paddle');
            $postdata["source"]       = $this->input->post('source');
            $postdata["client_code"]  = $this->input->post('client_code');
            $postdata["nom_temp"]     = $this->input->post('nom_temp');
            $postdata["email"]        = $this->input->post('email');

            $paddle_id = $this->paddle_model->insert($postdata);
        }

        redirect(site_url('paddle/index/'.$catalogue_id));
    }

    public function edit($catalogue_id)
    {
        $this->form_validation->set_rules('num_paddle', 'Num_paddle', 'required|trim');
        $this->form_validation->set_rules('source', 'Source', 'required|trim');
        $this->form_validation->set_rules('client_code', 'Client_code', 'required|trim');
        $this->form_validation->set_rules('client_id', 'Client', 'trim');
        $this->form_validation->set_rules('nom_temp', 'Nom_temp', 'required|trim');
        $this->form_validation->set_rules('email', 'Email   ', 'required|trim');
        $this->form_validation->set_rules('id', 'Id', 'required|trim');

        if ($this->form_validation->run() !== FALSE)
        {
            $postdata["catalogue_id"] = $catalogue_id;
            $postdata["num_paddle"]   = $this->input->post('num_paddle');
            $postdata["source"]       = $this->input->post('source');
            $postdata["client_code"]  = $this->input->post('client_code');
            $postdata["nom_temp"]     = $this->input->post('nom_temp');
            $postdata["email"]        = $this->input->post('email');

            $paddle_id = $this->input->post('id');
            $this->paddle_model->update($paddle_id, $postdata);
        }
        else
        {
            $this->session->set_flashdata('error_validation', validation_errors());
        }


        redirect(site_url('paddle/index/'.$catalogue_id));
    }

    public function del()
    {
        $paddle_id = $this->input->post('id');

        $paddle = $this->paddle_model->get_by(array('id' => $paddle_id));
        if (!$paddle)
            show_404();

        $this->paddle_model->delete($paddle_id);
        redirect('paddle/add/'.$paddle->catalogue_id);
    }

    public function listing()
    {

        $this->load->model('client_model');
        $this->load->model('catalogue_model');


        $client_id = $this->input->post('id');

        $client_id      = $this->client_model->get_all();
        $data['client'] = $client_id;
    }

}