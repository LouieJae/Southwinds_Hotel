<?php

class Product_model extends CI_Model
{

    function product_code()
    {
        $year = date('Y');

        $prefix = "P-";

        $query =  $this->db->query("SELECT max(product_code) as max_product_code FROM product where product_code LIKE '{$prefix}%'");
        $result = $query->row();


        if ($result->max_product_code) {
            $next_product_code = ++$result->max_product_code;
        } else {
            $next_product_code = $prefix . '0001';
        }
        return $next_product_code;
    }

    public function insertproduct()
    {
        // Get the logged-in user's information from the session
        $user = ucfirst($this->session->userdata('UserLoginSession')['username']);

        // Debugging statement to check if the method is being called
        // echo "insertproduct method is called.";

        $product_code = (string) $this->input->post('product_code');
        $product_name = (string) $this->input->post('product_name');
        $product_category = (string) $this->input->post('product_category');
        $product_price = $this->input->post('product_price');
        $product_uom = (string) $this->input->post('product_uom');
        $product_status = $this->input->post('product_status');
        $minimum_quantity = $this->input->post('minimum_quantity');
        $beginning_quantity = $this->input->post('beginning_quantity');

        // Debugging statement to check the data being received
        // var_dump($product_code, $product_name, $product_category, $product_price, $product_uom, $minimum_quantity, $maximum_quantity);

        $data = array(
            'product_code' => $product_code,
            'product_name' => $product_name,
            'product_category' => $product_category,
            'product_price' => $product_price,
            'product_uom' => $product_uom,
            'product_status' => $product_status,
            'minimum_quantity' => $minimum_quantity,
            'beginning_quantity' => $beginning_quantity,
            'product_quantity' => $beginning_quantity,
        );

        $response = $this->db->insert('product', $data);

        if ($response) {
            // Insert activity log
            $activity_log = array(
                'user' => $user,
                'activity' => 'Inserted new product: ' . $product_name,
            );
            $this->db->insert('activity_logs', $activity_log);

            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }



    function get_all_product_table()
    {
        $this->db->where('isDelete', 'no');
        $query = $this->db->get('product');
        $result = $query->result();

        return $result;
    }

    function get_all_product()
    {
        $this->db->where('product_status', '1');
        $this->db->where('isDelete', 'no');
        $query = $this->db->get('product');
        $result = $query->result();

        return $result;
    }

    public function insert_added_product_category()
    {
        // Get the logged-in user's information from the session
        $user = ucfirst($this->session->userdata('UserLoginSession')['username']);

        $product_category = (string) $this->input->post('product_category1');
        // Debugging statement to check the data being received
        // var_dump($product_category);
        $data = array(
            'product_category' => $product_category,
        );

        $response = $this->db->insert('product_category', $data);

        if ($response) {
            // Insert activity log
            $activity_log = array(
                'user' => $user,
                'activity' => 'Inserted new product category: ' . $product_category,
            );
            $this->db->insert('activity_logs', $activity_log);

            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function get_all_product_category()
    {

        $query = $this->db->get('product_category');
        $procat = $query->result();

        return $procat;
    }

    function get_product($product_id, $product_name = null)
    {
        if ($product_name !== null) {
            // If product name is provided, exclude it from the query
            $this->db->where('product_name !=', $product_name);
        }
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product');
        $row = $query->row();

        return $row;
    }
    public function insert_received_quantity()
    {
        // Get the logged-in user's information from the session and capitalize the username
        $user = ucfirst($this->session->userdata('UserLoginSession')['username']);

        $product_id = (int) $this->input->post('product_id');
        $product_quantity = (int) $this->input->post('product_quantity');

        $this->db->select('product_quantity, beginning_quantity, product_name');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product');
        $row = $query->row();

        if ($row) {
            $current_quantity = $row->product_quantity;
            $beginning_quantity = $row->beginning_quantity;
            $product_name = $row->product_name;

            $new_quantity = $current_quantity + $product_quantity;

            if ($new_quantity > $beginning_quantity) {
                $this->db->set('product_quantity', $new_quantity);
                $this->db->set('beginning_quantity', $new_quantity);
            } else {
                $this->db->set('product_quantity', $new_quantity);
            }

            $this->db->where('product_id', $product_id);
            $response = $this->db->update('product');

            if ($response) {
                // Insert activity log with the product name
                $activity_log = array(
                    'user' => $user,
                    'activity' => 'Inserted received quantity for product: ' . $product_name,
                );
                $this->db->insert('activity_logs', $activity_log);

                return $new_quantity;
            } else {
                return FALSE;
            }
        } else {
            return FALSE; // Product not found
        }
    }


    public function update_product($product_id)
    {
        // Get the logged-in user's information from the session
        $user = ucfirst($this->session->userdata('UserLoginSession')['username']);

        // Debugging statement to check if the method is being called
        // echo "editproduct method is called.";

        $product_code = (string) $this->input->post('product_code');
        $product_name = (string) $this->input->post('product_name');
        $product_category = (string) $this->input->post('product_category');
        $product_price = $this->input->post('product_price');
        $product_uom = (string) $this->input->post('product_uom');
        $product_status = $this->input->post('product_status');
        $minimum_quantity = $this->input->post('minimum_quantity');
        $beginning_quantity = $this->input->post('beginning_quantity');

        // Debugging statement to check the data being received
        // var_dump($product_code, $product_name, $product_category, $product_price, $product_uom, $minimum_quantity, $maximum_quantity);

        $data = array(
            'product_code' => $product_code,
            'product_name' => $product_name,
            'product_category' => $product_category,
            'product_price' => $product_price,
            'product_uom' => $product_uom,
            'product_status' => $product_status,
            'minimum_quantity' => $minimum_quantity,
            'beginning_quantity' => $beginning_quantity,
        );

        $this->db->where('product_id', $product_id);
        $response = $this->db->update('product', $data);

        if ($response) {
            // Insert activity log
            $activity_log = array(
                'user' => $user,
                'activity' => 'Updated product: ' . $product_name,
            );
            $this->db->insert('activity_logs', $activity_log);

            return $product_id;
        } else {
            return FALSE;
        }
    }

    function delete_product($product_id)
    {
        // Get the logged-in user's information from the session
        $user = ucfirst($this->session->userdata('UserLoginSession')['username']);

        // Fetch product information
        $this->db->select('product_name');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('product');
        $product = $query->row();

        if ($product) {
            $product_name = $product->product_name;

            // Mark the product as deleted
            $data = array(
                'isDelete' => 'yes'
            );
            $this->db->where('product_id', $product_id);
            $response = $this->db->update('product', $data);

            if ($response) {
                // Insert activity log
                $activity_log = array(
                    'user' => $user,
                    'activity' => 'Deleted product: ' . $product_name,
                );
                $this->db->insert('activity_logs', $activity_log);

                return $product_id;
            } else {
                return false;
            }
        } else {
            // Product not found
            return false;
        }
    }
}
