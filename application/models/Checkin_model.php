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

    function checkout_no()
    {
        $year = date('Y');

        $prefix = "CO-";

        $query =  $this->db->query("SELECT max(checkout_no) as max_checkout_code FROM check_out where checkout_no LIKE '{$prefix}%'");
        $result = $query->row();


        if ($result->max_checkout_code) {
            $next_checkout_code = ++$result->max_checkout_code;
        } else {
            $next_checkout_code = $prefix . '00001';
        }
        return $next_checkout_code;
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

        // Check product quantities against available quantities
        foreach ($product_names as $index => $product_name) {
            $available_quantity = $this->get_available_quantity($product_name);
            if ($product_quantities[$index] > $available_quantity) {
                // Product quantity exceeds available quantity, return the product name causing the error
                return $product_name;
            }
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
            'check_in_time' => $this->input->post('check_in_time'),
            'check_out_time' => $this->input->post('check_out_time'),
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

    // In your product_model
    function get_available_quantity($product_name)
    {
        $this->db->select('product_quantity');
        $this->db->where('product_name', $product_name);
        $query = $this->db->get('product');
        $result = $query->row();
        return ($result) ? $result->product_quantity : 0;
    }

    public function update_checkin()
    {
        $check_in_id = (int) $this->input->post('check_in_id');
        $product_names = $this->input->post('product_names');
        $check_out_time = $this->input->post('check_out_time');
        $product_quantities = $this->input->post('product_quantities');
        $product_prices = $this->input->post('product_prices');
        $room_price = $this->input->post('room_price');
        $total_amount = $this->input->post('total_amount');
        $add_hour = (int) $this->input->post('add_hour'); // Get the value from the add_hour input field

        // Retrieve existing room_hour from the database
        $existing_room_hour = $this->db->select('room_hour')->where('check_in_id', $check_in_id)->get('check_in')->row()->room_hour;

        // Add the value from add_hour to the existing room_hour
        $updated_room_hour = $existing_room_hour + $add_hour;

        // Check if the first row is empty
        if (empty($product_names[0]) || empty($product_prices[0])) {
            // If the first row is empty, remove it from the arrays
            array_shift($product_names);
            array_shift($product_quantities);
            array_shift($product_prices);
        }

        // Retrieve existing total amount from the database
        $existing_total_amount = $this->db->select('total_amount')->where('check_in_id', $check_in_id)->get('check_in')->row()->total_amount;

        // Initialize array to store existing product quantities and prices
        $existing_products = [];

        // Fetch existing products for the check-in
        $existing_products_query = $this->db->select('product_name, product_quantity, product_price')->where('add_ons_no', $check_in_id)->get('add_ons');
        foreach ($existing_products_query->result() as $row) {
            $existing_products[$row->product_name] = ['quantity' => $row->product_quantity, 'price' => $row->product_price];
        }

        // Loop through the array of product data and update existing records or insert new ones
        foreach ($product_names as $index => $product_name) {
            if (isset($existing_products[$product_name])) {
                // If the product already exists, update the existing record
                $existing_quantity = $existing_products[$product_name]['quantity'];
                $existing_price = $existing_products[$product_name]['price'];
                $new_quantity = $existing_quantity + $product_quantities[$index];
                $new_price = $existing_price + ($product_prices[$index] * $product_quantities[$index]);
                $data = [
                    'product_quantity' => $new_quantity,
                    'product_price' => $new_price
                ];

                $this->db->where('add_ons_no', $check_in_id);
                $this->db->where('product_name', $product_name);
                $this->db->update('add_ons', $data);
            } else {
                // If the product does not exist, insert a new record
                $data = [
                    'add_ons_no' => $check_in_id, // Use appropriate identifier for add-ons
                    'product_name' => $product_name,
                    'product_quantity' => $product_quantities[$index],
                    'product_price' => $product_prices[$index]
                ];

                $this->db->insert('add_ons', $data);
            }
        }

        // Update the check-in with the new total amount and updated room_hour
        $checkin = [
            'room_price' => $room_price,
            'check_out_time' => $check_out_time,
            'total_amount' => $total_amount,
            'room_hour' => $updated_room_hour // Update room_hour with the new value
        ];

        $this->db->where('check_in_id', $check_in_id);
        $this->db->update('check_in', $checkin);

        return $check_in_id;
    }

    public function check_out()
    {
        // Retrieving necessary data from the form
        $check_in_id = (int) $this->input->post('check_in_id');
        $room_sales_no = $this->input->post('room_sales_no');
        $checkout_no = $this->input->post('checkout_no');
        $room_no = $this->input->post('room_no');
        $room_price = $this->input->post('room_price');
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

        // Loop through the array of product data and update product quantities
        foreach ($product_names as $index => $product_name) {
            // Retrieve the current quantity of the product
            $current_quantity = $this->db->select('product_quantity')->where('product_name', $product_name)->get('product')->row()->product_quantity;

            // Calculate the new quantity after checkout
            $new_quantity = $current_quantity - $product_quantities[$index];

            // Update the product quantity in the database
            $this->db->where('product_name', $product_name);
            $this->db->update('product', ['product_quantity' => $new_quantity]);
        }
        $existing_total_amount = $this->db->select('total_amount')->where('check_in_id', $check_in_id)->get('check_in')->row()->total_amount;

        // Insert data into the check_out table
        $check_out_data = array(
            'checkout_no' => $checkout_no,
            'room_no' => $room_no,
            'room_price' => $room_price,
            'room_hour' => $room_hour,
            'total_amount' => $existing_total_amount, // You need to calculate the total amount based on room price and duration
            'date' => $date,
        );
        $this->db->insert('check_out', $check_out_data);

        // Get the check_out_id of the inserted row
        $check_out_id = $this->db->insert_id();

        // Insert data into add_ons_check_out table
        foreach ($product_names as $index => $product_name) {
            $add_ons_check_out_data = array(
                'add_ons_checkout_no' => $check_out_id,
                'product_name' => $product_name,
                'product_quantity' => $product_quantities[$index],
                'product_price' => $product_prices[$index]
            );
            $this->db->insert('add_ons_check_out', $add_ons_check_out_data);
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

        // Update the check_in table with the new total amount and status
        $checkin = array(
            'status' => 'housekeeping'
        );
        $this->db->where('check_in_id', $check_in_id);
        $this->db->update('check_in', $checkin);

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
            'status' => 'housekeeping'
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

    public function update_available($check_in_id)
    {
        // Get the room number associated with the check-in
        $query = $this->db->select('room_no')->from('check_in')->where('check_in_id', $check_in_id)->get();
        $result = $query->row();

        if ($result) {
            $room_no = $result->room_no;

            // Update the status of the room to 'available' in the room table
            $room_data = array(
                'status' => 'available'
            );
            $this->db->where('room_no', $room_no);
            $this->db->update('room', $room_data);

            // Update the status of the check-in to 'available' in the check_in table
            $checkin_data = array(
                'status' => 'available'
            );
            $this->db->where('check_in_id', $check_in_id);
            $this->db->update('check_in', $checkin_data);

            // Check if the updates were successful
            return $this->db->affected_rows() > 0;
        } else {
            // Check-in with the provided ID not found
            return false;
        }
    }



    public function get_all_checkin()
    {
        $this->db->where('check_in.status', 'occupied');
        $this->db->or_where('check_in.status', 'housekeeping');
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
