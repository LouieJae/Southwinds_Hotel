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

    function get_sales_by_room($date_from, $date_to)
    {
        $this->db->select('room_no, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $this->db->group_by('room_no'); // Group by room_id to get total sales for each room
        $query = $this->db->get()->result();
        return $query;
    }

    function get_sales_by_month($date_from, $date_to)
    {
        $this->db->select('room_no, MONTH(date) as month, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $this->db->group_by('room_no, MONTH(date)');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_daily_sales($date)
    {
        $this->db->select('room_no, SUM(total_amount) as daily_total_sales, DAYNAME(date) as day');
        $this->db->from('room_sales');
        $this->db->where('date', $date);
        $this->db->group_by('room_no');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_daily_sales_per_room($date)
    {
        $this->db->select('room_no, SUM(total_amount) as daily_total_sales_per_room, ');
        $this->db->from('room_sales');
        $this->db->where('date', $date);
        $this->db->group_by('room_no');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_monthly_sales($year_month)
    {
        $this->db->select('MONTH(date) as month, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where("DATE_FORMAT(date, '%Y-%m') = '$year_month'");
        $this->db->group_by('MONTH(date)');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_monthly_sales_per_room($year_month)
    {
        $this->db->select('room_no, MONTH(date) as month, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where("DATE_FORMAT(date, '%Y-%m') = '$year_month'");
        $this->db->group_by('room_no');
        $query = $this->db->get()->result();
        return $query;
    }
}
