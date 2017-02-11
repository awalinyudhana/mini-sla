<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/6/17
 * Time: 3:38 PM
 */
class Technical extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(! $this->ion_auth->in_group('technical'))
        {
            redirect('Login', 'refresh');
        }
    }

    public function index()
    {
        $this->data['title'] = "Technical";
        $this->data['group_of'] = "Technical";
        $this->data['user'] = $this->ion_auth->user()->row();


        $this->load->view('technical/dashboard', $this->data);
    }
}