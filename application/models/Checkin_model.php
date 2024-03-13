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


    private function update_room_status($room_no)
    {
        $data = [
            'status' => 'occupied'
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
    public function get_all_checkin()
    {
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
