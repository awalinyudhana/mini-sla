<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(['admin','manager','technical','sales','boq']))
        {
            redirect('/', 'refresh');
        }
        $this->is_admin = $this->ion_auth->is_admin();
        $user = $this->ion_auth->user()->row();
        $this->logged_in_name = $user->first_name;
        $this->load->model('CustomerModel', 'model');
    }

    public function index()
    {
        $data = array(
            'table_url' => base_url('customer/ajax_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('customer/index', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $customer) {
            $no++;
            $row = array();
            $action = '<a href="'.base_url('customer/update/'.$customer->customer_id).'" class="btn btn-warning">Update</a> <a href="javascript:;" data-href="'.base_url('customer/delete/'.$customer->customer_id).'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger delete-confirmation">Delete</a>';

            $row[] = $no;
            $row[] = $customer->nama_customer;
            $row[] = $customer->alamat;
            $row[] = $customer->kota;
            $row[] = $customer->provinsi;
            $row[] = $customer->kode_pos;
            $row[] = $customer->pic;
            $row[] = $customer->kontak;
            $row[] = $customer->email;
            if ($this->ion_auth->in_group(['admin', 'manager']))
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
            'title' => 'Tambah Customer',
            'mode' => 'create',
        );

        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('kota', 'Kota', 'required');
            $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric');
            $this->form_validation->set_rules('pic', 'PIC', 'required');
            $this->form_validation->set_rules('kontak', 'Kontak', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() === FALSE) {
                $data['message'] = validation_errors();
            } else {
                $form_data = array(
                    'nama_customer' => $this->input->post('nama_customer'),
                    'alamat' => $this->input->post('alamat'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'kode_pos' => $this->input->post('kode_pos'),
                    'pic' => $this->input->post('pic'),
                    'kontak' => $this->input->post('kontak'),
                    'email' => $this->input->post('email'),
                );

                if ($this->model->create($form_data)) {
                    redirect(base_url('customer'));
                } else {
                    $data['message'] = 'Terdapat kesalahan saat menyimpan data';
                }
            }
        }

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('customer/form', $data);
        $this->load->view('admin/themes/footer');
    }

    public function update($id = null)
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('kota', 'Kota', 'required');
            $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric');
            $this->form_validation->set_rules('pic', 'PIC', 'required');
            $this->form_validation->set_rules('kontak', 'Kontak', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() === FALSE) {
                $data['message'] = validation_errors();
            } else {
                $form_data = array(
                    'nama_customer' => $this->input->post('nama_customer'),
                    'alamat' => $this->input->post('alamat'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'kode_pos' => $this->input->post('kode_pos'),
                    'pic' => $this->input->post('pic'),
                    'kontak' => $this->input->post('kontak'),
                    'email' => $this->input->post('email'),
                );
                if ($this->model->update($this->input->post('customer_id'), $form_data)) {
                    redirect(base_url('customer'));
                } else {
                    $data['message'] = 'Terdapat kesalahan saat menyimpan data';
                }
            }
        }

        $form_data = $this->model->get($id);
        if ($form_data === FALSE) {
            redirect(base_url('customer'));
        }

        $data = array(
            'title' => 'Update Customer',
            'mode' => 'update',
            'customer_id' => $id,
            'nama_customer' => $form_data->nama_customer,
            'alamat' => $form_data->alamat,
            'kota' => $form_data->kota,
            'provinsi' => $form_data->provinsi,
            'kode_pos' => $form_data->kode_pos,
            'pic' => $form_data->pic,
            'kontak' => $form_data->kontak,
            'email' => $form_data->email,
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('customer/form', $data);
        $this->load->view('admin/themes/footer');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        redirect(base_url('customer'));
    }
}