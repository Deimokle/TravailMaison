<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail extends CI_Controller
{

    /**
     * BO
     */
    public function index()
    {
        redirect("mail/listing");
        $this->load->view('bo/templates/foot', $data);
        $this->load->view('bo/templates/head', $data);
    }

    /**
     * BO
     */
    public function listing()
    {

        $this->load->model("mail_model");
        $data['title']    = "Ecrivez votre mail";
        $data['all_mail'] = $this->mail_model->get_all();
        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/admin/mail_listing_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    /**
     * BO
     */
    public function add()
    {

        $this->load->model('mail_model');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="btn btn-warning">', '</div>');

        $this->form_validation->set_rules('nom', 'Nom', 'required|trim');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|trim');
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required|trim');

        if ($this->form_validation->run() !== FALSE)
        {
            $postdata["nom"]      = $this->input->post('nom');
            $postdata["prenom"]   = $this->input->post('prenom');
            $postdata["civilite"] = $this->input->post('civilite');
            $postdata["email"]    = $this->input->post('email');
            $postdata["mdp"]      = do_hash($this->input->post('mdp'));
            $this->mail_model->insert($postdata);
            redirect('admin/listing');
        }

        $data['title'] = "Envoyez un mail";
        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/admin/admin_form_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    /**
     * BO
     * @param integer $mail_id
     */
    public function edit($mail_id)
    {

        $this->load->model('mail_model');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('form_validation');

        $admin = $this->mail_model->get_by(array('id' => $mail_id));
        if (!$admin)
            show_404();

        $this->form_validation->set_rules('nom', 'Nom', 'required|trim');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|trim');
        $this->form_validation->set_rules('civilite', 'Civilité', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        if ($this->input->post('password') != "")
            $this->form_validation->set_rules('mdp', 'Mot de passe', 'required|trim');

        if ($this->form_validation->run() !== FALSE)
        {
            $postdata["nom"]      = $this->input->post('nom');
            $postdata["prenom"]   = $this->input->post('prenom');
            $postdata["civilite"] = $this->input->post('civilite');
            $postdata["email"]    = $this->input->post('email');

            if ($this->input->post('mdp') != "")
                $postdata["mdp"] = do_hash($this->input->post('mdp'));

            $this->mail_model->update($mail_id, $postdata);
            redirect('admin/listing');
        }


        $data["admin"] = $admin;
        $data['title'] = 'Modifier un administrateur';
        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/admin/admin_form_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    /**
     * BO
     * @param integer $mail_id
     */
    public function del_confirm($mail_id)
    {

        $this->load->model('mail_model');

        $admin = $this->mail_model->get_by(array('id' => $mail_id));
        if (!$admin)
            show_404();


        $data["admin"] = $admin;
        $data["title"] = 'Supprimer un administrateur';
        $this->load->view('bo/templates/head', $data);
        $this->load->view('bo/admin/admin_del_confirm_view', $data);
        $this->load->view('bo/templates/foot', $data);
    }

    /**
     * BO
     * @param integer $mail_id
     */
    public function del($mail_id)
    {

        $this->load->model('mail_model');

        $admin = $this->mail_model->get_by(array('id' => $mail_id));
        if (!$admin)
            show_404();

        $this->mail_model->delete($mail_id);
        redirect('admin/listing');
    }

}