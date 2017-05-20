<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        /*
        if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
                redirect('users', 'refresh');
            }
            else
            {
                redirect('Boq', 'refresh');
            }
        }*/

    }

    // log the user in
    public function index()
    {

    }

    public function fao($type, $start)
    {

    }
}