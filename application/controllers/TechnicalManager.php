<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/6/17
 * Time: 3:36 PM
 */
class TechnicalManager extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(! $this->ion_auth->in_group('technical_manager'))
        {
            redirect('Login', 'refresh');
        }
    }

    public function index()
    {
        $this->data['title'] = "Technical Manager";
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->load->view('tech_manager/dashboard', $this->data);
    }

}