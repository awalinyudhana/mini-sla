<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TicketListModel extends CI_Model
{
    var $table = 'ticket';
    var $column_order = array(null, 'ticket_id', 'tanggal', 'judul', 'nama_customer', 'nama_perangkat', 'request_by', 'close_status', 'approved_status', 'category');
    var $column_search = array('ticket_id', 'tanggal', 'judul', 'nama_customer', 'nama_perangkat', 'request_by', 'close_status', 'approved_status', 'category');
    var $order = array('t.ticket_id' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    public function _get_datatables_query($type = null, $support_user_id = null)
    {   
        $where = '';
        if (isset($type) && $type == 'closed') {
            $where .= "t.close_status='Closed'";
        } else if (isset($type) && $type == 'overdue') { 
            $where .= "t.close_status='Closed' AND (datediff(t.close_date,t.tanggal) > s.sla)";
            if ($this->session->userdata('report_start') && $this->session->userdata('report_end')) {
                $where .= " AND t.tanggal >= '".$this->session->userdata('report_start')."' AND t.tanggal <= '".$this->session->userdata('report_end')."'";
            }
        } else {
            $where .= "t.close_status='Open'";
        }

        if (isset($support_user_id)) {
            $where .= " AND tu.user_id=".$support_user_id;
        }
        $this->db->where($where);

        $this->db->select('*')
                 ->from('ticket t')
                 ->join('customer c', 'c.customer_id = t.customer_id')
                 ->join('boq_detail bd', 'bd.boq_detail_id = t.boq_detail_id', 'left')
                 ->join('boq b', 'b.boq_id = bd.boq_id', 'left')
                 ->join('service_level s', 's.service_level_id = b.service_level_id', 'left')
                 ->join('perangkat p', 'p.perangkat_id = bd.perangkat_id', 'left');

        if (isset($support_user_id)) {
            $this->db->join('ticket_users tu', 'tu.ticket_id = t.ticket_id');
        }

        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if($_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($type = null, $support_user_id = null)
    {
        $this->_get_datatables_query($type, $support_user_id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered($type = null, $support_user_id = null)
    {
        $this->_get_datatables_query($type, $support_user_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($type = null, $support_user_id = null)
    {
        // $this->db->from($this->table);
        $this->_get_datatables_query($type, $support_user_id);
        $this->db->get();
        return $this->db->count_all_results();
    }

    public function get_ticket_data($ticket_id)
    {
        $this->db->from('ticket t');
        $this->db->join('users u','u.id = t.user_id');
        $this->db->where('ticket_id', $ticket_id);
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $row;
        }
            return false;
    }

    public function get_progress_data($ticket_id)
    {
        $this->db->select('*');
        $this->db->from('ticket_response t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->where('t.ticket_id', $ticket_id);

        return $this->db->get()->result();
    }

    public function save_progress($data)
    {
        $this->db->trans_start();
        $this->db->insert('ticket_response', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            return true;
        }
            return false;
    }

    public function get_overdue_data()
    {
        $where = '';
        $where .= "t.close_status='Closed' AND (datediff(t.close_date,t.tanggal) > s.sla)";
        if ($this->session->userdata('report_start') && $this->session->userdata('report_end')) {
            $where .= "AND t.tanggal >= '".$this->session->userdata('report_start')."' AND t.tanggal <= '".$this->session->userdata('report_end')."'";
        }

        if ($this->ion_auth->in_group('technical')) {
            $support_user_id = $this->ion_auth->user()->row()->id;
            $where .= " AND tu.user_id=".$support_user_id;
        }

        $this->db->where($where);

        $this->db->select('*')
                 ->from('ticket t')
                 ->join('customer c', 'c.customer_id = t.customer_id')
                 ->join('boq_detail bd', 'bd.boq_detail_id = t.boq_detail_id', 'left')
                 ->join('boq b', 'b.boq_id = bd.boq_id', 'left')
                 ->join('service_level s', 's.service_level_id = b.service_level_id', 'left')
                 ->join('perangkat p', 'p.perangkat_id = bd.perangkat_id', 'left');
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $query->result();
        }
            return false;
    }
}