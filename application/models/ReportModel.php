<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportModel extends CI_Model
{
    var $table = 'users';
    var $column_order = array(null, 'first_name', 'point_by_device', 'point_by_customer', 'total_point');
    var $column_search = array('first_name', 'point_by_device', 'point_by_customer');
    var $order = array('full_name' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    public function _get_datatables_query($type = null, $support_user_id = null)
    {   
        $where = " AND (t.close_status='Closed' OR t.close_status IS NULL)";
        if (isset($support_user_id)) {
            $where .= " AND u.id=".$support_user_id;
        }

        if ($this->session->userdata('report_start') && $this->session->userdata('report_end')) {
            $where .= " AND t.tanggal >= '".$this->session->userdata('report_start')."' AND t.tanggal <= '".$this->session->userdata('report_end')."'";
        }

        $this->db->select("CONCAT_WS(' ',q.first_name, q.last_name) as full_name, q.point_by_device, q.point_by_customer, (q.point_by_device + q.point_by_customer) as total_point");
        $this->db->from("( SELECT u.first_name, u.last_name, CASE WHEN (t.ticket_by='by_device' and t.category='Installation') THEN sum(s.installation) WHEN (t.ticket_by='by_device' and t.category='Maintenance') THEN sum(s.maintenance) WHEN (t.ticket_by='by_device' and t.category='Support') THEN sum(s.support) ELSE 0 END AS point_by_device, CASE WHEN (t.ticket_by='by_customer' and t.category='MoM') THEN sum(s.mom) WHEN (t.ticket_by='by_customer' and t.category='BoM') THEN sum(s.bom) WHEN (t.ticket_by='by_customer' and t.category='Demo') THEN sum(s.demo) WHEN (t.ticket_by='by_customer' and t.category='Doc') THEN sum(s.doc) ELSE 0 END AS point_by_customer FROM users u LEFT join ticket_users tu on tu.user_id=u.id left join ticket t on t.ticket_id=tu.ticket_id left join boq_detail bd on bd.boq_detail_id=t.boq_detail_id left join boq b on b.boq_id=bd.boq_id left join service_level s on s.service_level_id=b.service_level_id JOIN users_groups ug ON ug.user_id =u.id JOIN groups g ON g.id=ug.group_id WHERE g.name='technical' ".$where." GROUP BY u.id) q");

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

    public function get_technical_score_data()
    {
        $where = " AND (t.close_status='Closed' OR t.close_status IS NULL)";

        if ($this->ion_auth->in_group('technical')) {
            $support_user_id = $this->ion_auth->user()->row()->id;
            $where .= " AND u.id=".$support_user_id;
        }

        if ($this->session->userdata('report_start') && $this->session->userdata('report_end')) {
            $where .= " AND t.tanggal >= '".$this->session->userdata('report_start')."' AND t.tanggal <= '".$this->session->userdata('report_end')."'";
        }

        $this->db->select("CONCAT_WS(' ',q.first_name, q.last_name) as full_name, q.point_by_device, q.point_by_customer, (q.point_by_device + q.point_by_customer) as total_point");
        $this->db->from("( SELECT u.first_name, u.last_name, CASE WHEN (t.ticket_by='by_device' and t.category='Installation') THEN sum(s.installation) WHEN (t.ticket_by='by_device' and t.category='Maintenance') THEN sum(s.maintenance) WHEN (t.ticket_by='by_device' and t.category='Support') THEN sum(s.support) ELSE 0 END AS point_by_device, CASE WHEN (t.ticket_by='by_customer' and t.category='MoM') THEN sum(s.mom) WHEN (t.ticket_by='by_customer' and t.category='BoM') THEN sum(s.bom) WHEN (t.ticket_by='by_customer' and t.category='Demo') THEN sum(s.demo) WHEN (t.ticket_by='by_customer' and t.category='Doc') THEN sum(s.doc) ELSE 0 END AS point_by_customer FROM users u LEFT join ticket_users tu on tu.user_id=u.id left join ticket t on t.ticket_id=tu.ticket_id left join boq_detail bd on bd.boq_detail_id=t.boq_detail_id left join boq b on b.boq_id=bd.boq_id left join service_level s on s.service_level_id=b.service_level_id JOIN users_groups ug ON ug.user_id =u.id JOIN groups g ON g.id=ug.group_id WHERE g.name='technical' ".$where." GROUP BY u.id) q");

        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $query->result();
        }
            return false;
    }

    public function get_ticket_data($category=null)
    {
        $where = '1=1';
        if ($this->session->userdata('report_start') && $this->session->userdata('report_end')) {
            $where .= " AND tanggal >= '".$this->session->userdata('report_start')."' AND tanggal <= '".$this->session->userdata('report_end')."'";
        }

        if (isset($category)) {
            $where .= " AND category='".$category."'";
        }

        $this->db->where($where);

        $this->db->select("COUNT(ticket_id) as jumlah, YEAR(tanggal) as tahun, MONTH(tanggal) as bulan");
        $this->db->from("ticket");
        $this->db->group_by("month(tanggal)");
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return $query->result();
        }
            return false;
    }
}