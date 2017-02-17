<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BoqModel extends CI_Model
{
    var $table = 'customer';
    var $customer_column_order = array(null, 'nama_customer', 'alamat', 'kota', 'provinsi', 'kode_pos', 'pic', 'kontak', 'email');
    var $customer_column_search = array('nama_customer', 'alamat', 'kota', 'provinsi', 'kode_pos', 'pic', 'kontak', 'email');
    var $boq_column_order = array('boq_id', 'tanggal_add', 'nama_customer', 'service_level', 'start_date_of_support', 'end_date_of_support');
    var $boq_column_search = array('boq_id', 'tanggal_add', 'nama_customer', 'service_level', 'start_date_of_support', 'end_date_of_support');
    var $boq_detail_column_order = array(null, 'part_number', 'serial_number', 'deskripsi');
    var $boq_detail_column_search = array('part_number', 'serial_number', 'deskripsi');
    var $order = array('customer_id' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    public function _get_datatables_query($boq_id = null)
    {
        $i = 0;
        $column_order = array();
        $column_search = array();

        if ($this->table == 'customer') {
            $this->db->from($this->table);
            $column_order = $this->customer_column_order;
            $column_search = $this->customer_column_search;
        } else if ($this->table == 'boq') {
            $this->db->select('b.*, sl.service_level, c.nama_customer')
                     ->from('boq b')
                     ->join('service_level sl', 'sl.service_level_id = b.service_level_id')
                     ->join('customer c', 'c.customer_id = b.customer_id');
            $column_order = $this->boq_column_order;
            $column_search = $this->boq_column_search;
            $this->order = array('boq_id' => 'asc');
        } else if ($this->table == 'boq_detail') {
            $this->db->select('bd.*, p.part_number')
                     ->from('boq_detail bd')
                     ->join('perangkat p', 'p.perangkat_id = bd.perangkat_id')
                     ->where('bd.boq_id',$boq_id);
            $column_order = $this->boq_detail_column_order;
            $column_search = $this->boq_detail_column_search;
            $this->order = array('boq_detail_id' => 'asc');
        }

        foreach ($column_search as $item) { // loop column 
            if($_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($table = null, $boq_id = null)
    {
        $this->table = $table;
        if (isset($boq_id) && $boq_id != null) {
            $this->_get_datatables_query($boq_id);
        } else {
            $this->_get_datatables_query();
        }

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function add_boq($data)
    {
        $this->db->trans_start();
        $this->db->insert('boq', $data);
        $last_insert_id = $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            return $last_insert_id;
        }
            return false;
    }

    public function add_boq_detail($data)
    {
        $this->db->trans_start();
        $this->db->insert_batch('boq_detail', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            return true;
        }
            return false;
    }

    public function get($id)
    {
        $query = $this->db->get_where($this->table, array('customer_id' => $id));
        $row = $query->row();
        if (isset($row)) {
            return $row;
        }
            return false;
    }

    public function get_boq($boq_id)
    {
        $this->db->select('b.*, sl.service_level, c.nama_customer, u.first_name, u.last_name')
                     ->from('boq b')
                     ->join('service_level sl', 'sl.service_level_id = b.service_level_id')
                     ->join('customer c', 'c.customer_id = b.customer_id')
                     ->join('users u', 'u.id = b.user_id')
                     ->where('b.boq_id', $boq_id);
        $query = $this->db->get('boq');
        $row = $query->row();
        if (isset($row)) {
            return $row;
        }
            return false;
    }

    public function get_service_level()
    {
        $query = $this->db->get('service_level');
        $row = $query->row();
        if (isset($row)) {
            return $query->result();
        }
            return false;
    }

    public function delete($id)
    {
        $this->db->delete('boq', array('boq_id' => $id));
    }

    public function delete_detail($boq_detail_id)
    {
        $this->db->delete('boq_detail', array('boq_detail_id' => $boq_detail_id));
    }
}