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
    //per room
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
    // daily sales
    public function get_daily_sales($date)
    {
        $this->db->select('room_no, SUM(total_amount) as daily_total_sales, DAYNAME(date) as day');
        $this->db->from('room_sales');
        $this->db->where('date', $date);
        $this->db->group_by('room_no');
        $query = $this->db->get()->result();
        return $query;
    }
    // daily sales per room
    public function get_daily_sales_per_room($date)
    {
        $this->db->select('room_no, SUM(total_amount) as daily_total_sales_per_room, ');
        $this->db->from('room_sales');
        $this->db->where('date', $date);
        $this->db->group_by('room_no');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_room_no_and_date($date, $room_no)
    {
        $this->db->select('*');
        $this->db->from('check_out AS co');
        $this->db->join('add_ons_check_out AS aoc', 'co.check_out_id = aoc.add_ons_checkout_no', 'left');
        $this->db->where('co.date', $date);
        $this->db->where('co.room_no', $room_no);
        $query = $this->db->get();
        return $query->result();
    }

    public function view_breakdowns($id)
    {
        $this->db->select('*');
        $this->db->from('check_out AS co');
        $this->db->join('add_ons_check_out AS aoc', 'co.check_out_id = aoc.check_out_id');
        $this->db->join('add_ons_check_out AS aoc', 'co.check_out_id = aoc.check_out_id');
        $query = $this->db->get();
        return $query->result();
    }



    // monthly sales
    public function get_monthly_sales($year_month)
    {
        $this->db->select('MONTH(date) as month, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where("DATE_FORMAT(date, '%Y-%m') = '$year_month'");
        $this->db->group_by('MONTH(date)');
        $query = $this->db->get()->result();
        return $query;
    }
    // monthly sales per room
    function get_monthly_sales_per_room($year_month)
    {
        $this->db->select('room_no, MONTH(date) as month, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where("DATE_FORMAT(date, '%Y-%m') = '$year_month'");
        $this->db->group_by('room_no');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_total_sales_per_year($year)
    {
        $this->db->select('YEAR(date) as year, SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where("DATE_FORMAT(date, '%Y') = '$year'");
        $this->db->group_by('year');
        $query = $this->db->get()->result_array(); // Return result as array
        return $query;
    }

    // total sales per month
    public function get_total_sales_per_month($year, $month)
    {
        $this->db->select('SUM(total_amount) as total_sales');
        $this->db->from('room_sales');
        $this->db->where('YEAR(date)', $year);
        $this->db->where('MONTH(date)', $month);
        $query = $this->db->get()->result_array(); // Return result as array
        return $query;
    }

    public function get_last_seven_days_sales()
    {
        // Get the current date
        $current_date = date('Y-m-d');

        // Calculate the date seven days ago
        $seven_days_ago = date('Y-m-d', strtotime('-7 days', strtotime($current_date)));

        $this->db->select('DATE(date) as date, SUM(total_amount) as daily_total_sales');
        $this->db->from('room_sales');
        $this->db->where('date >=', $seven_days_ago);
        $this->db->where('date <=', $current_date);
        $this->db->group_by('DATE(date)');
        $query = $this->db->get()->result();

        return $query;
    }
}
