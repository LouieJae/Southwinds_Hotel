<?php
class Room_model extends CI_Model
{
    public function get_all_room()
    {
        $query = $this->db->get('room');
        return $query->result();
    }

    public function get_total_rooms()
    {
        return $this->db->count_all('room');
    }

    public function get_total_available_rooms()
    {
        $this->db->where('status', 'available');
        return $this->db->count_all_results('room');
    }

    public function get_total_occupied_rooms()
    {
        $this->db->where('status', 'occupied');
        return $this->db->count_all_results('room');
    }

    public function get_total_housekeeping_rooms()
    {
        $this->db->where('status', 'housekeeping');
        return $this->db->count_all_results('room');
    }

    public function get_room_sales()
    {
        $this->db->select('*');
        $this->db->from('room');
        $query = $this->db->get()->result();
        return $query;
    }
    public function getRoomsNeedAttention()
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->where('STR_TO_DATE(check_out_time, "%Y-%m-%d %H:%i:%s") <', $currentDateTime);
        $this->db->where('status', 'occupied'); // Assuming 'occupied' status indicates the room is occupied
        $query = $this->db->get('check_in');
        return $query->result_array();
    }
}
