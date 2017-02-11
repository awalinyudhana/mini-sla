<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");

class Ticket_List extends CI_Controller
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
        $this->load->model('TicketListModel', 'model');
        $this->load->model('TicketModel', 'ticket_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'List Ticket',
            'table_url' => base_url('ticket_list/ajax_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $item) {
            $no++;
            $row = array();
            if ($item->approved_status == 'Waiting') {
            $action = '<a href="'.base_url('ticket_list/view/'.$item->ticket_id).'" class="btn btn-info">View</a> <a href="'.base_url('ticket_list/add_progress/'.$item->ticket_id).'" class="btn btn-success">Add Progress</a>';
            } else {
                $action = '<a href="'.base_url('ticket_list/view/'.$item->ticket_id).'" class="btn btn-info">View</a>';
            }

            $row[] = $no;
            $row[] = $item->ticket_id;
            $row[] = $item->tanggal;
            $row[] = $item->judul;
            $row[] = $item->nama_customer;
            $row[] = $item->request_by;
            $row[] = $item->close_status;
            $row[] = $item->approved_status;
            $row[] = $item->category;
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

    public function view($ticket_id)
    {
        $ticket_data = $this->model->get_ticket_data($ticket_id);
        $customer_data = $this->ticket_model->get_customer($ticket_data->customer_id);
        $progress_data = $this->model->get_progress_data($ticket_id);
        if ($ticket_data->boq_detail_id != null) {
            $boq_detail_data = $this->ticket_model->get_boq_detail($ticket_data->boq_detail_id);
            $boq_data = $this->ticket_model->get_boq($boq_detail_data->boq_id);

            $data = array(
                'ticket_data' => $ticket_data,
                'customer_data' => $customer_data,
                'boq_data' => $boq_data,
                'boq_detail_data' => $boq_detail_data,
                'progress_data' => $progress_data,
            );
        } else {
            $data = array(
                'ticket_data' => $ticket_data,
                'customer_data' => $customer_data,
                'progress_data' => $progress_data,
            );
        }

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/view', $data);
        $this->load->view('admin/themes/footer');
    }

    public function add_progress($ticket_id)
    {
        $ticket_data = $this->model->get_ticket_data($ticket_id);
        $customer_data = $this->ticket_model->get_customer($ticket_data->customer_id);
        $progress_data = $this->model->get_progress_data($ticket_id);
        if ($ticket_data->boq_detail_id != null) {
            $boq_detail_data = $this->ticket_model->get_boq_detail($ticket_data->boq_detail_id);
            $boq_data = $this->ticket_model->get_boq($boq_detail_data->boq_id);

            $data = array(
                'ticket_data' => $ticket_data,
                'customer_data' => $customer_data,
                'boq_data' => $boq_data,
                'boq_detail_data' => $boq_detail_data,
                'progress_data' => $progress_data,
            );
        } else {
            $data = array(
                'ticket_data' => $ticket_data,
                'customer_data' => $customer_data,
                'progress_data' => $progress_data,
            );
        }

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/add_progress', $data);
        $this->load->view('admin/themes/footer');
    }

    public function save_progress()
    {
        if (isset($_POST) && !empty($_POST)) {
            $form_data = array(
                ''
            );
        }
    }
}