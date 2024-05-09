<?php
class User_model extends CI_Model
{

    function checkPassword($password, $username)
    {
        $query = $this->db->query("SELECT * FROM user WHERE password = '$password' AND username = '$username'");
        if ($query->num_rows() == 1) {
            // Get the user's information
            $user = $query->row();

            // Capitalize the first letter of the username
            $username = ucfirst($username);

            // Log the login activity
            $activity_log = array(
                'user' => $username,
                'activity' => 'Logged in',
            );
            $this->db->insert('activity_logs', $activity_log);

            return $user;
        } else {
            return false;
        }
    }

    public function get_activity()
    {
        $query = $this->db->get('activity_logs');
        return $query->result();
    }
}
