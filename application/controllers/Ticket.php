<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");

class Ticket extends CI_Controller
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
        $this->load->model('TicketModel', 'model');
    }

    public function index()
    {
        redirect(base_url('ticket/by_device'));
    }

    public function by_device()
    {
        $data = array(
            'title' => 'New Ticket By Device For Technical',
            'type' => 'by_device',
            'table_url' => base_url('ticket/ajax_detail_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/select', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_detail_list()
    {
        $list = $this->model->get_datatables('boq_detail');
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $item) {
            $no++;
            $row = array();
            $action = '<a href="'.base_url('ticket/create/by_device/'.$item->boq_detail_id).'" class="btn btn-info">Create</a>';

            $row[] = $no;
            $row[] = $item->serial_number;
            $row[] = $item->nama_perangkat;
            $row[] = $item->nama_customer;
            $row[] = $item->boq_id;
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

    public function by_customer()
    {
        $data = array(
            'title' => 'New Ticket By Customer For Technical',
            'type' => 'by_customer',
            'table_url' => base_url('ticket/ajax_customer_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/select', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_customer_list()
    {
        $list = $this->model->get_datatables('customer');
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $item) {
            $no++;
            $row = array();
            $action = '<a href="'.base_url('ticket/create/by_customer/'.$item->customer_id).'" class="btn btn-info">Create</a>';

            $row[] = $no;
            $row[] = $item->nama_customer;
            $row[] = $item->alamat;
            $row[] = $item->kota;
            $row[] = $item->provinsi;
            $row[] = $item->pic;
            $row[] = $item->kontak;
            $row[] = $item->email;
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

    public function create($type, $id = null)
    {
        if (isset($_POST) && !empty($_POST)) {
            // var_dump($this->input->post());
            if(!empty($_FILES['documents']['name'])) {
                $files_count = count($_FILES['documents']['name']);
                $file_item = $_FILES['documents'];
                for ($i = 0; $i < $files_count; $i++) {
                    $_FILES['document']['name'] = $file_item['name'][$i];
                    $_FILES['document']['type'] = $file_item['type'][$i];
                    $_FILES['document']['tmp_name'] = $file_item['tmp_name'][$i];
                    $_FILES['document']['error'] = $file_item['error'][$i];
                    $_FILES['document']['size'] = $file_item['size'][$i];

                    if (isset($_FILES['document']['size']) && ($_FILES['document']['size'] > 0)) {
                        $upload_path = './uploads/tickets';
                        $config['upload_path'] = $upload_path;
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = '8192';
                        $config['encrypt_name'] = true;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('document') === false )
                            return [
                                'status' => false,
                                'message' => $this->upload->display_errors()
                            ];

                        $file_data = $this->upload->data();
                        $uploaded_data[$i] = $file_data['file_name'];
                    }
                }
            }

            $technician_data = $this->input->post('technician');
            foreach ($technician_data as $key => $value) {
                if ($value == 'none') {
                    unset($technician_data[$key]);
                }
            }

            if ($type == 'by_device') {
                $boq_detail_data = $this->model->get_boq_detail($this->input->post('boq_detail_id'));
                $boq_data = $this->model->get_boq($boq_detail_data->boq_id);
                $boq_customer_id = $boq_data->customer_id;
                
                $form_data = array(
                    'ticket_by' => $type,
                    'boq_detail_id' => $this->input->post('boq_detail_id'),
                    'customer_id' => $boq_customer_id,
                    'tanggal' => date("Y-m-d"),
                    'judul' => $this->input->post('judul'),
                    'request_by' => $this->input->post('request_by'),
                    'category' => $this->input->post('category'),
                    'documents' => implode(";", $uploaded_data),
                    'technician' => implode(";", $technician_data),
                    'deskripsi' => $this->input->post('deskripsi')
                );
            } else if ($type == 'by_customer') {
                $form_data = array(
                    'ticket_by' => $type,
                    'customer_id' => $this->input->post('customer_id'),
                    'tanggal' => date("Y-m-d"),
                    'judul' => $this->input->post('judul'),
                    'request_by' => $this->input->post('request_by'),
                    'category' => $this->input->post('category'),
                    'documents' => implode(";", $uploaded_data),
                    'technician' => implode(";", $technician_data),
                    'deskripsi' => $this->input->post('deskripsi')
                );
            } 

            if ($this->model->create_ticket($form_data)) {
                redirect(base_url('ticket/'.$type));
            } else {
                $data['message'] = 'Terdapat kesalahan saat menyimpan data';
            }
            return false;
        }

        if ($type == 'by_device') {
            $boq_detail_id = $id;
            $boq_detail_data = $this->model->get_boq_detail($boq_detail_id);
            $boq_data = $this->model->get_boq($boq_detail_data->boq_id);
            $customer_data = $this->model->get_customer($boq_data->customer_id);

            $data = array(
                'title' => 'New Ticket Detail',
                'type' => $type,
                'boq_detail_data' => $boq_detail_data,
                'boq_data' => $boq_data,
                'customer_data' => $customer_data,
            );
        } else if ($type == 'by_customer') {
            $customer_id = $id;
            $customer_data = $this->model->get_customer($customer_id);

            $data = array(
                'title' => 'New Ticket Detail',
                'type' => $type,
                'customer_data' => $customer_data,
            );
        }

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/create', $data);
        $this->load->view('admin/themes/footer');
    }
}