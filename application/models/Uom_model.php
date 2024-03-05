<?php

class Uom_model extends CI_Model
{

    public function insert_added_uom()
    {

        $uom = (string) $this->input->post('uom');
        var_dump($uom);
        $data = array(
            'uom' => $uom,
        );

        $response = $this->db->insert('uom', $data);

        if ($response) {
            return $this->db->insert_id();
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
