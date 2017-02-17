<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service_Level extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('/', 'refresh');
        }
        $this->is_admin = $this->ion_auth->is_admin();
        $user = $this->ion_auth->user()->row();
        $this->logged_in_name = $user->first_name;
        $this->load->model('ServiceLevelModel', 'model');
    }

    public function index()
    {
        $data = array(
            'table_url' => base_url('service_level/ajax_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('service_level/index', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $sl) {
            $no++;
            $row = array();
            $action = '<a href="'.base_url('service_level/update/'.$sl->service_level_id).'" class="btn btn-warning">Update</a> <a href="javascript:;" data-href="'.base_url('service_level/delete/'.$sl->service_level_id).'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger delete-confirmation">Delete</a>';

            $row[] = $no;
            $row[] = $sl->service_level;
            $row[] = $sl->mom;
            $row[] = $sl->bom;
            $row[] = $sl->doc;
            $row[] = $sl->demo;
            $row[] = $sl->installation;
            $row[] = $sl->maintenance;
            $row[] = $sl->support;
            $row[] = $sl->sla;
            $row[] = $action;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all(),
            "recordsFiltered" => $this->model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Service Level',
            'mode' => 'create',
        );

        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('service_level', 'Service Level', 'required');
            $this->form_validation->set_rules('mom', 'MoM', 'required|numeric');
            $this->form_validation->set_rules('bom', 'BoM', 'required|numeric');
            $this->form_validation->set_rules('doc', 'Doc', 'required|numeric');
            $this->form_validation->set_rules('demo', 'Demo', 'required|numeric');
            $this->form_validation->set_rules('installation', 'Installation', 'required|numeric');
            $this->form_validation->set_rules('maintenance', 'Maintenance', 'required|numeric');
            $this->form_validation->set_rules('support', 'Support', 'required|numeric');
            $this->form_validation->set_rules('sla', 'SLA (Day)', 'required|numeric|numeric');

            if ($this->form_validation->run() === FALSE) {
                $data['message'] = validation_errors();
            } else {
                $form_data = array(
                    'service_level' => $this->input->post('service_level'),
                    'mom' => $this->input->post('mom'),
                    'bom' => $this->input->post('bom'),
                    'doc' => $this->input->post('doc'),
                    'demo' => $this->input->post('demo'),
                    'installation' => $this->input->post('installation'),
                    'maintenance' => $this->input->post('maintenance'),
                    'support' => $this->input->post('support'),
                    'sla' => $this->input->post('sla'),
                );

                if ($this->model->create($form_data)) {
                    redirect(base_url('service_level'));
                } else {
                    $data['message'] = 'Terdapat kesalahan saat menyimpan data';
                }
            }
        }

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('service_level/form', $data);
        $this->load->view('admin/themes/footer');
    }

    public function update($id = null)
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('service_level', 'Service Level', 'required');
            $this->form_validation->set_rules('mom', 'MoM', 'required|numeric');
            $this->form_validation->set_rules('bom', 'BoM', 'required|numeric');
            $this->form_validation->set_rules('doc', 'Doc', 'required|numeric');
            $this->form_validation->set_rules('demo', 'Demo', 'required|numeric');
            $this->form_validation->set_rules('installation', 'Installation', 'required|numeric');
            $this->form_validation->set_rules('maintenance', 'Maintenance', 'required|numeric');
            $this->form_validation->set_rules('support', 'Support', 'required|numeric');
            $this->form_validation->set_rules('sla', 'SLA (Day)', 'required|numeric');

            if ($this->form_validation->run() === FALSE) {
                $data['message'] = validation_errors();
            } else {
                $form_data = array(
                    'service_level' => $this->input->post('service_level'),
                    'mom' => $this->input->post('mom'),
                    'bom' => $this->input->post('bom'),
                    'doc' => $this->input->post('doc'),
                    'demo' => $this->input->post('demo'),
                    'installation' => $this->input->post('installation'),
                    'maintenance' => $this->input->post('maintenance'),
                    'support' => $this->input->post('support'),
                    'sla' => $this->input->post('sla'),
                );
                if ($this->model->update($this->input->post('service_level_id'), $form_data)) {
                    redirect(base_url('service_level'));
                } else {
                    $data['message'] = 'Terdapat kesalahan saat menyimpan data';
                }
            }
        }

        $form_data = $this->model->get($id);
        if ($form_data === FALSE) {
            redirect(base_url('service_level'));
        }

        $data = array(
            'title' => 'Update Service Level',
            'mode' => 'update',
            'service_level_id' => $id,
            'service_level' => $form_data->service_level,
            'mom' => $form_data->mom,
            'bom' => $form_data->bom,
            'doc' => $form_data->doc,
            'demo' => $form_data->demo,
            'installation' => $form_data->installation,
            'maintenance' => $form_data->maintenance,
            'support' => $form_data->support,
            'sla' => $form_data->sla,
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('service_level/form', $data);
        $this->load->view('admin/themes/footer');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        redirect(base_url('service_level'));
    }
}