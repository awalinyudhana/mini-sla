<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perangkat extends CI_Controller
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
        $this->load->model('PerangkatModel', 'model');
    }

    public function index()
    {
        $data = array(
            'table_url' => base_url('perangkat/ajax_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('perangkat/index', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_list($type = null)
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $perangkat) {
            $no++;
            $row = array();

            if ($type == 'modal') {
                $detail = json_encode($perangkat);
                $action = "<a href='javascript:;' data-detail='$detail' class='btn btn-success pilih'>Pilih</a>";
            } else {
                $action = '<a href="'.base_url('perangkat/update/'.$perangkat->perangkat_id).'" class="btn btn-warning">Update</a> <a href="javascript:;" data-href="'.base_url('perangkat/delete/'.$perangkat->perangkat_id).'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger delete-confirmation">Delete</a>';
            }

            $row[] = $no;
            $row[] = $perangkat->part_number;
            $row[] = $perangkat->brand;
            $row[] = $perangkat->nama_perangkat;
            $row[] = $perangkat->type;
            $row[] = $perangkat->status;
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
            'title' => 'Tambah Perangkat',
            'mode' => 'create',
        );

        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('part_number', 'Part Number', 'required');
            $this->form_validation->set_rules('brand', 'Brand', 'required');
            $this->form_validation->set_rules('nama_perangkat', 'Nama Perangkat', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['message'] = validation_errors();
            } else {
                $form_data = array(
                    'part_number' => $this->input->post('part_number'),
                    'brand' => $this->input->post('brand'),
                    'nama_perangkat' => $this->input->post('nama_perangkat'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                );

                if ($this->model->create($form_data)) {
                    redirect(base_url('perangkat'));
                } else {
                    $data['message'] = 'Terdapat kesalahan saat menyimpan data';
                }
            }
        }

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('perangkat/form', $data);
        $this->load->view('admin/themes/footer');
    }

    public function update($id = null)
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('part_number', 'Part Number', 'required');
            $this->form_validation->set_rules('brand', 'Brand', 'required');
            $this->form_validation->set_rules('nama_perangkat', 'Nama Perangkat', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['message'] = validation_errors();
            } else {
                $form_data = array(
                    'part_number' => $this->input->post('part_number'),
                    'brand' => $this->input->post('brand'),
                    'nama_perangkat' => $this->input->post('nama_perangkat'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                );
                if ($this->model->update($this->input->post('perangkat_id'), $form_data)) {
                    redirect(base_url('perangkat'));
                } else {
                    $data['message'] = 'Terdapat kesalahan saat menyimpan data';
                }
            }
        }

        $form_data = $this->model->get($id);
        if ($form_data === FALSE) {
            redirect(base_url('perangkat'));
        }

        $data = array(
            'title' => 'Update Perangkat',
            'mode' => 'update',
            'perangkat_id' => $id,
            'part_number' => $form_data->part_number,
            'brand' => $form_data->brand,
            'nama_perangkat' => $form_data->nama_perangkat,
            'type' => $form_data->type,
            'status' => $form_data->status,
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('perangkat/form', $data);
        $this->load->view('admin/themes/footer');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        redirect(base_url('perangkat'));
    }
}