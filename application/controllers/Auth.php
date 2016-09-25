<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        redirect("auth/login");
    }

    public function loginadmin()
    {
        $this->load->library('authcheck');

        if ($this->authcheck->is_admin() == false)
        {
            $this->load->model('admin_model');
            $this->load->helper('security');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run() !== FALSE)
            {
                $password      = do_hash($this->input->post('password'));
                if ($administrator = $this->admin_model->get_by(array('email' => $this->input->post('email'), 'password' => $password)))
                {
                    $this->session->set_userdata('nom', $administrator->nom);
                    $this->session->set_userdata('prenom', $administrator->prenom);
                    $this->session->set_userdata('admin_id', true);
                    redirect('catalogue/listing');
                }
                else
                {
                    $data['error'] = 'Mauvais e-mail ou mot de passe';
                }
            }

            $data['title'] = "Identification";
            $this->load->view('bo/include/header_admin', $data);
            $this->load->view('bo/auth/auth_form_view', $data);
            $this->load->view('bo/include/footer_admin');
        }
        else
        {
            redirect('/');
        }
    }

    public function logoutadmin()
    {
        $this->session->sess_destroy();
        redirect('auth/loginadmin');
    }

    public function get_new_password_admin()
    {
        $this->load->model('admin_model');
        $this->load->helper('security');
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email');

        if ($this->form_validation->run() !== FALSE)
        {
            if ($administrator = $this->admin_model->get_by(array('email' => $this->input->post('email'))))
            {
                $new_password         = random_string('alnum', 10);
                $postdata["password"] = do_hash($new_password);
                $this->admin_model->update($administrator->id, $postdata);

                $this->email->from(" AAAAAAAAA@AAAAAAA.com", "Melodhier");
                $this->email->to($this->input->post('email'));

                $this->email->subject('Mot de passe réinitialisé');
                $this->email->message('Bonjour,<br>'
                    .'Votre mot de passe à été réinitialisé suite a votre demande.<br><br>'
                    .'Votre nouveau mot de passe est : '.$new_password
                    .'<br>');
                $this->email->send();

                redirect('auth/loginadmin');
            }
            else
            {
                echo "Mauvais E-mail";
            }
        }

        $data['title'] = "Mot de passe oublié";
        $this->load->view('bo/include/header_admin', $data);
        $this->load->view('bo/auth/auth_new_password_view', $data);
        $this->load->view('bo/include/footer_admin');
    }

    ############################################################################
    ############################################################################
    ############################################################################

    public function login()
    {
        $this->load->library('authcheck');

        if ($this->authcheck->is_client() == false)
        {
            $this->load->model('client_model');
            $this->load->helper('security');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run() !== FALSE)
            {
                $password = do_hash($this->input->post('password'));
                if ($client   = $this->client_model->get_by(array('email' => $this->input->post('email'), 'password' => $password)))
                {
                    if ($client->inscription_confirmed == 0)
                    {
                        $data["error"] = $this->lang->line("compte_non_actif")."<br><p class='text-center mt10'><a class='btn btn-default' href='".site_url('client/send_again_inscription_email/'.$client->id)."/".hash('sha256', $client->email)."'>".$this->lang->line("renvoi_email")."</a></p>";
                    }
                    else
                    {
                        $this->session->set_userdata('client_id', $client->id);
                        if ($this->session->userdata('from') != '')
                            redirect($this->session->userdata('from'));
                        else
                            redirect($this->lang->switch_uri($client->langue));
                    }
                }
                else
                {
                    $data['error'] = $this->lang->line('Mauvais e-mail ou mot de passe');
                }
            }

            $data['page_title'] = "Identification";
            $this->load->view('site/include/header', $data);
            $this->load->view('site/include/menu', $data);
            $this->load->view('site/auth/auth_form_view', $data);
            $this->load->view('site/include/footer', $data);
        }
        else
        {
            redirect('/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function get_new_password()
    {
        $this->load->model('client_model');
        $this->load->helper('security');
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email');

        if ($this->form_validation->run() !== FALSE)
        {
            if ($client = $this->client_model->get_by(array('email' => $this->input->post('email'))))
            {
                $new_password         = random_string('alnum', 10);
                $postdata["password"] = do_hash($new_password);
                $this->client_model->update($client->id, $postdata);

                $data["new_password"] = $new_password;
                $emaildata["content"] = $this->load->view('site/auth/auth_new_password_email_view', $data, TRUE);
                $emailcontent         = $this->load->view('site/include/template_email_view', $emaildata, TRUE);

                $this->email->from(" AAAAAAAAA@AAAAAAA.com", "Melodhier");
                $this->email->to($this->input->post('email'));
                $this->email->subject($this->lang->line('Mot de passe réinitialisé'));
                $this->email->message($emailcontent);
                $this->email->send();

                $this->session->set_flashdata('message', "<p class='alert alert-success text-center'>".$this->lang->line("new_pass_send")."</p>");
                redirect('auth/login');
            }
            else
            {
                $this->session->set_flashdata('message', "<p class='alert alert-danger text-center'>".$this->lang->line("Mauvais E-mail")."</p>");
            }
        }

        $data['page_title'] = "Réinitialiser mon mot de passe";
        $this->load->view('site/include/header', $data);
        $this->load->view('site/include/menu', $data);
        $this->load->view('site/auth/auth_new_password_view', $data);
        $this->load->view('site/include/footer', $data);
    }

    /**
     * FRONT Appelé par la vac
     * Renvoi l'id du client si il est confirmé
     */
    public function get_user_id()
    {
        if ($this->session->client_id)
        {
            $this->load->model("client_model");
            $client = $this->client_model->get_by(array("id" => $this->session->client_id, "confirmed" => 1));
        }

        if ($client)
        {
            echo json_encode(array(
                    'CID'   => $client->id,
                    'error' => 0
            ));
        }
        else
            echo json_encode(array(
                    'CID'   => -1,
                    'error' => 1
            ));
    }

    /**
     * FRONT Appelé par la vac
     */
    public function get_lang()
    {
        echo json_encode(array(
                'LANG'  => $this->lang->lang(),
                'error' => 0
        ));
    }

}