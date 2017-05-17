<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                redirect('users', 'refresh');
            }
            else
            {
                redirect('Boq', 'refresh');
            }
        }

    }

    // log the user in
    public function index()
    {

        //validate form input
        $this->form_validation->set_rules(
            'username', str_replace(':', '', 'Username'),
            'required'
        );
        $this->form_validation->set_rules(
            'password', str_replace(':', '', 'Password'),
            'required'
        );

        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('users', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        // the user is not logging in so display the login page
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->load->view('login', $this->data);
    }
}