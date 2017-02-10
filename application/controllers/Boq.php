<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/6/17
 * Time: 3:39 PM
 */

class Boq extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(! $this->ion_auth->in_group('BOQ'))
        {
            redirect('Login', 'refresh');
        }
    }

    public function index()
    {
        $this->data['title'] = "BOQ";
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->load->view('boq/dashboard', $this->data);
    }
}