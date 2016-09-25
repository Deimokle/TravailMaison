<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resident extends CI_Controller
{

    /**
     * BO
     */
    public function listing()
    {
        $this->load->model("resident_model");

        $data['title']        = "Liste des residents";
        $data['all_resident'] = $this->resident_model->get_all();

        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/resident/resident_listing_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    public function add()
    {

        $this->load->model("resident_model");
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nom', 'Nom', 'required|trim');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|trim');

        if ($this->form_validation->run() !== FALSE)
        {

            $postdata["nom"]      = $this->input->post('nom');
            $postdata["prenom"]   = $this->input->post('prenom');
            $postdata["email"]    = $this->input->post('email');
            $postdata["civilite"] = $this->input->post('civilite');
            $this->resident_model->insert($postdata);
            redirect('resident/listing');
        }



        $data['title'] = "Création d'un resident";

        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/resident/resident_form_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    /**
     * BO
     * @param integer $acivilite_id
     */
    public function edit($resident_id)
    {
        $this->load->model("resident_model");
        $this->load->library('form_validation');

        $resident = $this->resident_model->get_by(array('id' => $resident_id));

        if (!$resident)
            show_404();

        $this->form_validation->set_rules('nom', 'Nom', 'required|trim');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|trim');
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() !== FALSE)
        {
            $postdata["nom"]      = $this->input->post('nom');
            $postdata["prenom"]   = $this->input->post('prenom');
            $postdata["civilite"] = $this->input->post('civilite');
            $postdata["email"]    = $this->input->post('email');

            $this->resident_model->update($resident_id, $postdata);
        }

        $data['title']    = "Gestion du resident ".$resident->nom." ".$resident->prenom;
        $data['resident'] = $resident;

        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/resident/resident_form_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    /**
     * BO
     * @param integer $admin_id
     */
    public function del($resident_id)
    {

        $this->load->model('resident_model');

        $resident = $this->resident_model->get_by(array('id' => $resident_id));
        if (!$resident)
            show_404();

        $this->admin_model->delete($resident_id);
        redirect('resident/form');
    }

}