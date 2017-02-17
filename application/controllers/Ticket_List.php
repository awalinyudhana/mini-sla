<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");

class Ticket_List extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

//        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
//        {
//            // redirect('/', 'refresh');
//        }
//        $this->is_admin = $this->ion_auth->is_admin();
//        $user = $this->ion_auth->user()->row();
//        $this->logged_in_name = $user->first_name;
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

    public function ajax_list($type = null)
    {
        if (isset($type) && $type == 'closed') {
            $list = $this->model->get_datatables('closed');
        } else {
            $list = $this->model->get_datatables();
        }
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $item) {
            $no++;
            $row = array();
//            if (isset($type) && $type == 'closed') {
//                $action = '<a href="'.base_url('ticket_list/view/'.$item->ticket_id.'/approve').'" class="btn btn-info">View</a>';
//            } else if ($item->close_status == 'Open') {
//                $action = '<a href="'.base_url('ticket_list/view/'.$item->ticket_id).'" class="btn btn-info">View</a>
// <a href="'.base_url('ticket_list/add_progress/'.$item->ticket_id).'" class="btn btn-success">Add Progress</a>';
//            } else {
                $action = '<a href="'.base_url('ticket_list/view/'.$item->ticket_id).'" class="btn btn-info">View</a>';
//            }

            $row[] = $no;
            $row[] = $item->ticket_id;
            $row[] = $item->tanggal;
            $row[] = $item->judul;
            $row[] = $item->nama_customer;
            $row[] = $item->nama_perangkat;
            $row[] = $item->category;
            $row[] = $item->request_by;
            $row[] = $item->close_status;
            $row[] = $item->approved_status;
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

    public function view($ticket_id, $type = null)
    {
        $message = null;
        if($this->input->post()) {
            $technician_data = array_unique($this->input->post('teknisi'));
            foreach ($technician_data as $key => $value) {
                if ($value != 0)
                    $this->ticket_model->insert_ticket_users($ticket_id, $value);
            }
            $message = 'daftar support berhasil di update';
        }
        $ticket_data = $this->model->get_ticket_data($ticket_id);
        $customer_data = $this->ticket_model->get_customer($ticket_data->customer_id);
        $available_support = $this->ticket_model->get_available_support_by_ticket($ticket_id);
        $list_support = $this->ticket_model->get_list_support_by_ticket($ticket_id);
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
                'list_support' => $list_support,
                'available_support' => $available_support,
                'type' => $type,
                'message' => $message,
            );
        } else {
            $data = array(
                'ticket_data' => $ticket_data,
                'customer_data' => $customer_data,
                'progress_data' => $progress_data,
                'list_support' => $list_support,
                'available_support' => $available_support,
                'type' => $type,
                'message' => $message,
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
        $user = $this->db->get_where('users',['id'=>$this->ion_auth->get_user_id()])->row();

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
                'message' => $this->session->flashdata('message'),
                'user' => $user,
            );
        } else {
            $data = array(
                'ticket_data' => $ticket_data,
                'message' => $this->session->flashdata('message'),
                'customer_data' => $customer_data,
                'user' => $user,
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
            $this->form_validation->set_rules('ticket_id', 'Ticket', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('progress', 'Progress', 'required');
            $this->form_validation->set_rules('result', 'Result', 'required');
            $this->form_validation->set_rules('description', 'Deskripsi', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('message', validation_errors());
                redirect('ticket_list/add_progress/'.$this->input->post('ticket_id'));
            }
            $response_form_data = array(
                'ticket_id' => $this->input->post('ticket_id'),
                'tanggal' => $this->input->post('tanggal').' '.date("H:i:s"),
                'progress' => $this->input->post('progress'),
                'result' => $this->input->post('result'),
                'description' => $this->input->post('description'),
                'user_id' => $this->ion_auth->get_user_id(),
            );

            $this->model->save_progress($response_form_data);

            // If Close Ticket
            if ($this->input->post('submit_type') == 'close_ticket') {
                $file_name = null;
                if ($_FILES['document']['size'] > 0 && !empty($_FILES['document']['name']))
                {
                    $config['upload_path']          = './uploads/tickets/';
                    $config['allowed_types']        = '*';
                    $config['max_size']             = 8062;
                    $config['overwrite']             = false;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('document'))
                    {

                        $this->session->set_flashdata('message', $this->upload->display_errors());
                        redirect('ticket_list/add_progress/'.$this->input->post('ticket_id'));
                        return false;
                    }

                    $file_name = $this->upload->data()['file_name'];

                }

                $ticket_form_data = array(
                    'close_status' => 'Closed',
                    'close_date' => date('Y-m-d'),
                    'report_attachment' =>$file_name,
                );

                $this->ticket_model->update_ticket($this->input->post('ticket_id'), $ticket_form_data);
                redirect(base_url('ticket_list/'));
            }


            redirect(base_url('ticket_list/view/'.$this->input->post('ticket_id')));
        }
        redirect(base_url('ticket_list'));
    }

    public function closed()
    {
        $data = array(
            'title' => 'List Ticket',
            'table_url' => base_url('ticket_list/ajax_list/closed'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function approve_ticket($ticket_id)
    {
        $ticket_form_data = array(
            'approved_status' => 'Approved',
            'approved_date' => date('Y-m-d'),
        );

        $this->ticket_model->update_ticket($ticket_id, $ticket_form_data);
        redirect(base_url('ticket_list/closed'));
    }
}