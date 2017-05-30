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
            'table_url' => base_url('Ticket_List/ajax_list/hasaction'),
            'type' => 'hasaction',
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function all() {
        $data = array(
            'title' => 'List All Tickets',
            'table_url' => base_url('Ticket_List/ajax_list'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ajax_list($type = null, $support_user_id = null)
    {
        if ($this->ion_auth->in_group(['technical']) && !$this->ion_auth->in_group(['manager'])) {
            $support_user_id = $this->ion_auth->get_user_id();
        }

//        $list = $this->model->get_datatables($type, $support_user_id);
        $list = $this->model->get_datatables($type);

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
                $action = '<a href="'.base_url('Ticket_List/view/'.$item->ticket_id).'" class="btn btn-info">View</a>';
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

//            if ($type == 'hasaction' || $type == 'overdue') {
                $row[] = $action;
//            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all($type, $support_user_id),
            "recordsFiltered" => $this->model->count_filtered($type, $support_user_id),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function view($ticket_id)
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
                'message' => $message,
            );
        } else {
            $data = array(
                'ticket_data' => $ticket_data,
                'customer_data' => $customer_data,
                'progress_data' => $progress_data,
                'list_support' => $list_support,
                'available_support' => $available_support,
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
                redirect('Ticket_List/add_progress/'.$this->input->post('ticket_id'));
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
                        redirect('Ticket_List/add_progress/'.$this->input->post('ticket_id'));
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
                redirect(base_url('Ticket_List/'));
            }


            redirect(base_url('Ticket_List/view/'.$this->input->post('ticket_id')));
        }
        redirect(base_url('Ticket_List'));
    }

    public function closed()
    {
        $data = array(
            'title' => 'List Ticket',
            'table_url' => base_url('Ticket_List/ajax_list/closed'),
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function overdue($start='',$end='')
    {
        $this->session->unset_userdata('report_start');
        $this->session->unset_userdata('report_end');

        if ($start!='' && $end!='') {
            $this->session->set_userdata('report_start', $start);
            $this->session->set_userdata('report_end', $end);
        }

        $data = array(
            'title' => 'List Ticket Overdue',
            'table_url' => base_url('Ticket_List/ajax_list/overdue'),
            'type' => 'overdue',
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('ticket/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function print_overdue()
    {
        $this->load->library('Pdf');

        $overdue_data = $this->model->get_overdue_data();

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Overdue Ticket');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetTopMargin(10);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('KAYREACH SYSTEM');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $ticket_data_html = "";
        $no = 1;
        foreach ($overdue_data as $key => $value) {
            $ticket_data_html .= '
            <tr>
                <td>'.$no.'</td>
                <td>'.$value->ticket_id.'</td>
                <td>'.$value->tanggal.'</td>
                <td>'.$value->judul.'</td>
                <td>'.$value->nama_customer.'</td>
                <td>'.$value->nama_perangkat.'</td>
                <td>'.$value->category.'</td>
                <td>'.$value->request_by.'</td>
                <td>'.$value->close_status.'</td>
                <td>'.$value->approved_status.'</td>
            </tr>
            ';
            $no++;
        }

        $html ='
            <h3>Overdue Ticket</h3>
            <table border="1" cellpadding="4">
                <thead>
                    <tr>
                        <th><strong>No</strong></th>
                        <th><strong>No. Ticket</strong></th>
                        <th><strong>Tanggal</strong></th>
                        <th><strong>Judul</strong></th>
                        <th><strong>Customer</strong></th>
                        <th><strong>Perangkat</strong></th>
                        <th><strong>Kategori</strong></th>
                        <th><strong>Request By</strong></th>
                        <th><strong>Status Teknisi</strong></th>
                        <th><strong>Persetujuan Pemimpin</strong></th>
                    </tr>
                </thead>
                <tbody>
                    '.$ticket_data_html.'
                </tbody>
            </table>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Overdue Ticket.pdf', 'I');

    }

    public function approve_ticket($ticket_id)
    {
        $ticket_form_data = array(
            'close_status' => 'Closed',
            'close_date' => date('Y-m-d'),
            'approved_status' => 'Approved',
            'approved_date' => date('Y-m-d'),
        );

        $this->ticket_model->update_ticket($ticket_id, $ticket_form_data);
        redirect(base_url('Ticket_List/closed'));
    }

    public function decline_ticket() {
        $ticket_form_data = array(
            'close_status' => 'Open',
            'close_date' => null,
            'note' => $this->input->post('note'),
        );

        $this->ticket_model->update_ticket($this->input->post('ticket_id'), $ticket_form_data);
        redirect(base_url('Ticket_List'));
    }
}