<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/6/17
 * Time: 3:55 PM
 */
class Groups extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->set_flashdata('message');
        //list the user
        $this->data['groups'] = $this->db->get('groups')->result();

        //template
        // header
        $this->load->view('admin/themes/header');
        // nav, top menu
        $this->load->view('admin/themes/nav');
        //nav, sidebar
        $this->load->view('admin/themes/sidebar');
        // groups index content
        $this->load->view('groups/index', $this->data);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function create()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        //validate input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'),
            'required|alpha_dash');
        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group(
                strtolower($this->input->post('group_name')),
                $this->input->post('description')
            );
            if ($new_group_id) {
                //check to see if we are creating group
                //redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('groups', 'refresh');
            }
        } else {
            //display the create group form
            //set the flashdata error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() :
                ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );

            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            //template
            // header
            $this->load->view('admin/themes/header');
            // nav, top menu
            $this->load->view('admin/themes/nav');
            //nav, sidebar
            $this->load->view('admin/themes/sidebar');
            // groups index content
            $this->load->view('groups/create', $this->data);
            //footer
            $this->load->view('admin/themes/footer');
        }
    }

    public function edit($id)
    {
        //fail if no id group given
        if (!$id || empty($id)) {
            redirect('groups', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        $group = $this->ion_auth->group($id)->row();

        //validate input
        $this->form_validation->set_rules('group_name', 'Group Name', 'required|alpha_dash');
        $this->form_validation->set_rules('group_description', 'Group Description', 'required');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() == TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'],
                    $_POST['group_description']);
                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect('groups', 'refresh');
            }
        }
        //set the flashdata error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() :
            ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );

        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('description', $group->description),
        );

        //template
        // header
        $this->load->view('admin/themes/header');
        // nav, top menu
        $this->load->view('admin/themes/nav');
        //nav, sidebar
        $this->load->view('admin/themes/sidebar');
        // groups index content
        $this->load->view('groups/edit', $this->data);
        //footer
        $this->load->view('admin/themes/footer');
    }


}