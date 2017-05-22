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
        $this->load->model('ReportModel', 'model');
    }

    public function ajax_list($type = null, $support_user_id = null)
    {
        if ($this->ion_auth->in_group(['technical']) && !$this->ion_auth->in_group(['manager'])) {
            $support_user_id = $this->ion_auth->get_user_id();
        }

        $list = $this->model->get_datatables($type, $support_user_id);

        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $item) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $item->full_name;
            $row[] = $item->point_by_device;
            $row[] = $item->point_by_customer;
            $row[] = $item->total_point;

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

    public function technical_score($start='',$end='')
    {
        
        $this->session->unset_userdata('report_start');
        $this->session->unset_userdata('report_end');

        if ($start!='' && $end!='') {
            $this->session->set_userdata('report_start', $start);
            $this->session->set_userdata('report_end', $end);
        }

        $data = array(
            'title' => 'Technical Score',
            'table_url' => base_url('Report/ajax_list'),
            'type' => '',
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('report/list', $data);
        $this->load->view('admin/themes/footer');
    }

    public function print_technical_score()
    {
        $this->load->library('Pdf');

        $overdue_data = $this->model->get_technical_score_data();

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Technical Score');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetTopMargin(10);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('KAYREACH SYSTEM');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $report_data_html = "";
        $no = 1;
        foreach ($overdue_data as $key => $value) {
            $report_data_html .= '
            <tr>
                <td>'.$no.'</td>
                <td>'.$value->full_name.'</td>
                <td>'.$value->point_by_device.'</td>
                <td>'.$value->point_by_customer.'</td>
                <td>'.$value->total_point.'</td>
            </tr>
            ';
            $no++;
        }

        $html ='
            <h3>Technical Score</h3>
            <table border="1" cellpadding="4">
                <thead>
                    <tr>
                        <th><strong>No</strong></th>
                        <th><strong>Nama Teknisi</strong></th>
                        <th><strong>Point By Device</strong></th>
                        <th><strong>Point By Customer</strong></th>
                        <th><strong>Total Point</strong></th>
                    </tr>
                </thead>
                <tbody>
                    '.$report_data_html.'
                </tbody>
            </table>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Technical Score.pdf', 'I');
    }

    public function ticket_graph($start='',$end='')
    {
        $this->session->unset_userdata('report_start');
        $this->session->unset_userdata('report_end');

        if ($start!='' && $end!='') {
            $this->session->set_userdata('report_start', $start);
            $this->session->set_userdata('report_end', $end);
        }

        $ticket_data = $this->model->get_ticket_data();
        
        $data = array(
            'title' => 'Ticket Report',
            'data' => $ticket_data,
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('report/graph', $data);
        $this->load->view('admin/themes/footer');
    }

    public function ticket_graph_by_category($category=null,$start='',$end='')
    {
        $this->session->unset_userdata('report_start');
        $this->session->unset_userdata('report_end');

        if ($start!='' && $end!='') {
            $this->session->set_userdata('report_start', $start);
            $this->session->set_userdata('report_end', $end);
        }

        $ticket_data = $this->model->get_ticket_data($category);

        $data = array(
            'title' => 'Ticket Report',
            'data' => $ticket_data,
            'type' => 'category',
            'category' => $category
        );

        $this->load->view('admin/themes/header');
        $this->load->view('admin/themes/nav');
        $this->load->view('admin/themes/sidebar');
        $this->load->view('report/graph', $data);
        $this->load->view('admin/themes/footer');
    }
}