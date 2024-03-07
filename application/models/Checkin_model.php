<?php
class Checkin_model extends CI_Model
{
    public function checkin_room()
    {
        $room_no = (string) $this->input->post('room_no');
        $room_price = (string) $this->input->post('room_price');
        $add_ons = (string) $this->input->post('add_ons');
        $prepared_by = $this->input->post('prepared_by');
        $date = (string) $this->input->post('date');

        $data = array(
            'room_no' => $room_no,
            'room_price' => $room_price,
            'add_ons' => $add_ons,
            'prepared_by' => $prepared_by,
            'date' => $date,
            'status' => 'occupied',
        );

        var_dump($data);

        $response = $this->db->insert('check_in', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
}
