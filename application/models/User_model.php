<?php
class User_model extends CI_Model
{

    function checkPassword($password, $username)
    {
        $query = $this->db->query("SELECT * FROM user WHERE password = '$password' AND username = '$username'");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}
?>