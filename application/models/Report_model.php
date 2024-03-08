<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{

    function get_sales_by_day_of_week($date_from, $date_to)
    {
        $this->db->select('room_id, DAYNAME(date) as day, SUM(amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $this->db->group_by('room_id, DAYNAME(date)');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_sales_by_room()
    {
        $this->db->select('room_id, SUM(amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->group_by('room_id'); // Group by room_id to get total sales for each room
        $query = $this->db->get()->result();
        return $query;
    }
}
