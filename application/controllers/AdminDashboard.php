<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/9/17
 * Time: 5:39 PM
 */
class AdminDashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if (! $this->ion_auth->is_admin())
        {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        //template
        // header
        $this->load->view('admin/themes/header');
        // nav, top menu
        $this->load->view('admin/themes/nav');
        //nav, sidebar
        $this->load->view('admin/themes/sidebar');
        // groups index content
        $this->load->view('admin/dashboard');
        //footer
        $this->load->view('admin/themes/footer');

    }

}