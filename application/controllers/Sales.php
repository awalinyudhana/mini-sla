<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/6/17
 * Time: 3:38 PM
 */

class Sales extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(! $this->ion_auth->in_group('sales'))
        {
            redirect('Login', 'refresh');
        }
    }

    public function index()
    {
        $this->data['title'] = "Sales";
        $this->data['user'] = $this->ion_auth->user()->row();
        $this->load->view('sales/dashboard', $this->data);
    }
}