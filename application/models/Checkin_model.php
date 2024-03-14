<?php
class Checkin_model extends CI_Model
{
    function add_ons_no()
    {
        $year = date('Y');

        $prefix = "AO-";

        $query =  $this->db->query("SELECT max(add_ons) as max_add_ons_code FROM check_in where add_ons LIKE '{$prefix}%'");
        $result = $query->row();


        if ($result->max_add_ons_code) {
            $next_add_ons_code = ++$result->max_add_ons_code;
        } else {
            $next_add_ons_code = $prefix . '00001';
        }
        return $next_add_ons_code;
    }

    function sales_ref_no()
    {
        $year = date('Y');

        $prefix = "RS-";

        $query =  $this->db->query("SELECT max(room_sales_no) as max_room_sales_code FROM room_sales where room_sales_no LIKE '{$prefix}%'");
        $result = $query->row();


        if ($result->max_room_sales_code) {
            $next_room_sales_code = ++$result->max_room_sales_code;
        } else {
            $next_room_sales_code = $prefix . '00001';
        }
        return $next_room_sales_code;
    }

    function checkin_room()
    {
        // Get the product names, quantities, and prices from the form
        $product_names = $this->input->post('product_names');
        $product_quantities = $this->input->post('product_quantities');
        $product_prices = $this->input->post('product_prices');

        // Check if the first row is empty
        if (empty($product_names[0]) || empty($product_prices[0])) {
            // If the first row is empty, remove it from the arrays
            array_shift($product_names);
            array_shift($product_quantities);
            array_shift($product_prices);
        }

        // Calculate total amount by summing room price and product prices considering quantities
        $room_price = $this->input->post('room_price');
        $product_total = 0;
        foreach ($product_prices as $index => $price) {
            $product_total += $price * $product_quantities[$index];
        }
        $total_amount = $room_price + $product_total;

        // Insert check-in data including total amount
        $check_in_data = [
            'add_ons' => $this->input->post('add_ons'),
            'room_no' => $this->input->post('room_no'),
            'room_hour' => $this->input->post('room_hour'),
            'room_price' => $room_price,
            'prepared_by' => $this->input->post('prepared_by'),
            'date' => $this->input->post('date'),
            'total_amount' => $total_amount,
            'status' => 'occupied',
        ];

        $this->db->insert('check_in', $check_in_data);
        $check_in_id = $this->db->insert_id();

        // Update room status to 'occupied'
        $room_no = $this->input->post('room_no');
        $this->update_room_status($room_no);

        // Insert add-ons data
        foreach ($product_names as $index => $product_name) {
            $data = [
                'add_ons_no' => $check_in_id,
                'product_name' => $product_name,
                'product_price' => $product_prices[$index],
                'product_quantity' => $product_quantities[$index],
            ];
            $this->db->insert('add_ons', $data);
        }

        return $check_in_id;
    }

    public function update_checkin()
    {
        $check_in_id = (int) $this->input->post('check_in_id');
        $product_names = $this->input->post('product_names');
        $product_quantities = $this->input->post('product_quantities');
        $product_prices = $this->input->post('product_prices');

        // Check if the first row is empty
        if (empty($product_names[0]) || empty($product_prices[0])) {
            // If the first row is empty, remove it from the arrays
            array_shift($product_names);
            array_shift($product_quantities);
            array_shift($product_prices);
        }

        // Retrieve existing total amount from the database
        $existing_total_amount = $this->db->select('total_amount')->where('check_in_id', $check_in_id)->get('check_in')->row()->total_amount;

        // Calculate total amount for newly added products only
        $new_product_total = 0;
        foreach ($product_prices as $index => $price) {
            // Check if the product is newly added
            $result = $this->db->where('add_ons_no', $check_in_id)->where('product_name', $product_names[$index])->get('add_ons');
            if ($result->num_rows() == 0) {
                // If the product is newly added, calculate its amount
                $new_product_total += is_numeric($price) && is_numeric($product_quantities[$index]) ? $price * $product_quantities[$index] : 0;
            }
        }

        // Calculate updated total amount
        $updated_total_amount = $existing_total_amount + $new_product_total;

        // Update the purchase order with the new total cost and supplier id
        $checkin = [
            'total_amount' => $updated_total_amount
        ];

        $this->db->where('check_in_id', $check_in_id);
        $this->db->update('check_in', $checkin);

        // Loop through the array of product data and update existing records or insert new ones
        foreach ($product_names as $index => $product_name) {
            $data = [
                'add_ons_no' => $check_in_id, // Use appropriate identifier for add-ons
                'product_name' => $product_name,
                'product_quantity' => $product_quantities[$index],
                'product_price' => $product_prices[$index]
            ];

            $this->db->where('add_ons_no', $check_in_id);
            $this->db->where('product_name', $product_name);
            $result = $this->db->get('add_ons');

            if ($result->num_rows() > 0) {
                // If the product already exists, update the existing record
                $this->db->where('add_ons_no', $check_in_id);
                $this->db->where('product_name', $product_name);
                $this->db->update('add_ons', $data);
            } else {
                // If the product does not exist, insert a new record
                $this->db->insert('add_ons', $data);
            }
        }

        return $check_in_id;
    }

    public function check_out()
    {
        $check_in_id = (int) $this->input->post('check_in_id');
        $room_sales_no = $this->input->post('room_sales_no');
        $room_no = $this->input->post('room_no');
        $room_hour = (int) $this->input->post('room_hour');
        $date = $this->input->post('date');
        $product_names = $this->input->post('product_names');
        $product_quantities = $this->input->post('product_quantities');
        $product_prices = $this->input->post('product_prices');

        // Check if the first row is empty
        if (empty($product_names[0]) || empty($product_prices[0])) {
            // If the first row is empty, remove it from the arrays
            array_shift($product_names);
            array_shift($product_quantities);
            array_shift($product_prices);
        }

        // Retrieve existing total amount from the database
        $existing_total_amount = $this->db->select('total_amount')->where('check_in_id', $check_in_id)->get('check_in')->row()->total_amount;
        // Insert data into room_sales table
        $room_sales_data = array(
            'room_sales_no' => $room_sales_no,
            'room_no' => $room_no,
            'hours' => $room_hour,
            'total_amount' => $existing_total_amount,
            'date' => $date
        );

        $this->db->insert('room_sales', $room_sales_data);

        // Update room status to 'available'
        $this->update_room_status1($room_no);

        // Retrieve existing total amount from the database
        $existing_total_amount = $this->db->select('total_amount')->where('check_in_id', $check_in_id)->get('check_in')->row()->total_amount;

        // Calculate total amount for newly added products only
        $new_product_total = 0;
        foreach ($product_prices as $index => $price) {
            // Check if the product is newly added
            $result = $this->db->where('add_ons_no', $check_in_id)->where('product_name', $product_names[$index])->get('add_ons');
            if ($result->num_rows() == 0) {
                // If the product is newly added, calculate its amount
                $new_product_total += is_numeric($price) && is_numeric($product_quantities[$index]) ? $price * $product_quantities[$index] : 0;
            }
        }

        // Calculate updated total amount
        $updated_total_amount = $existing_total_amount + $new_product_total;

        // Update the purchase order with the new total cost and supplier id
        $checkin = [
            'total_amount' => $updated_total_amount,
            'status' => 'available',
        ];

        $this->db->where('check_in_id', $check_in_id);
        $this->db->update('check_in', $checkin);

        // Loop through the array of product data and update existing records or insert new ones
        foreach ($product_names as $index => $product_name) {
            $data = [
                'add_ons_no' => $check_in_id, // Use appropriate identifier for add-ons
                'product_name' => $product_name,
                'product_quantity' => $product_quantities[$index],
                'product_price' => $product_prices[$index]
            ];

            $this->db->where('add_ons_no', $check_in_id);
            $this->db->where('product_name', $product_name);
            $result = $this->db->get('add_ons');

            if ($result->num_rows() > 0) {
                // If the product already exists, update the existing record
                $this->db->where('add_ons_no', $check_in_id);
                $this->db->where('product_name', $product_name);
                $this->db->update('add_ons', $data);
            } else {
                // If the product does not exist, insert a new record
                $this->db->insert('add_ons', $data);
            }
        }

        return $check_in_id;
    }

    private function update_room_status($room_no)
    {
        $data = [
            'status' => 'occupied'
        ];

        $this->db->where('room_no', $room_no);
        $this->db->update('room', $data);
    }

    private function update_room_status1($room_no)
    {
        $data = [
            'status' => 'available'
        ];

        $this->db->where('room_no', $room_no);
        $this->db->update('room', $data);
    }

    function get_checkin($check_in_id)
    {
        $this->db->where('check_in_id', $check_in_id);
        $query = $this->db->get('check_in');
        $row = $query->row();

        return $row;
    }

    function get_checkout($check_in_id)
    {
        $this->db->where('check_in_id', $check_in_id);
        $query = $this->db->get('check_in');
        $row = $query->row();

        return $row;
    }
    public function get_all_checkin()
    {
        $this->db->where('check_in.status', 'occupied');
        $query = $this->db->get('check_in');
        return $query->result();
    }

    function view_all_addons($check_in_id)
    {
        $this->db->select('AO.*, P.product_price, AO.product_quantity'); // Select only necessary fields
        $this->db->from('check_in AS che');
        $this->db->join('add_ons AS AO', 'che.check_in_id = AO.add_ons_no'); // Correct join condition
        $this->db->join('product AS P', 'AO.product_name = P.product_name');
        $this->db->where('che.check_in_id', $check_in_id); // Ensure correct filtering
        $query = $this->db->get();
        return $query->result();
    }
}
