<?php

class Uom_model extends CI_Model
{

    public function insert_added_uom()
    {
        // Get the logged-in user's information from the session
        $user = ucfirst($this->session->userdata('UserLoginSession')['username']);

        $uom = (string) $this->input->post('uom');
        // Debugging statement to check the data being received
        // var_dump($uom);
        $data = array(
            'uom' => $uom,
        );

        $response = $this->db->insert('uom', $data);

        if ($response) {
            // Insert activity log
            $activity_log = array(
                'user' => $user,
                'activity' => 'Inserted new Unit of Measurement (UOM): ' . $uom,
            );
            $this->db->insert('activity_logs', $activity_log);

            return array(
                'uom_id' => $this->db->insert_id(),
                'uom_name' => $uom
            );
        } else {
            return FALSE;
        }
    }

    function get_all_uom()
    {

        $query = $this->db->get('uom');
        $uom = $query->result();

        return $uom;
    }
}
