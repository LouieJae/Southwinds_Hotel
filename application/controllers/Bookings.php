<?php
class Bookings extends CI_Controller
{
    public function index()
    {
        $this->load->view('Bookings/login');
    }
    public function dashboard()
    {
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/dashboard');
        $this->load->view('Bookings/footer');
    }

    public function room_accommodations()
    {
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/room_accommodations');
        $this->load->view('Bookings/footer');
    }

    public function product()
    {
        $this->load->model('product_model');
        $this->data['products'] = $this->product_model->get_all_product();
        $this->load->model('uom_model');
        $this->data['uom'] = $this->uom_model->get_all_uom();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/product', $this->data);
        $this->load->view('Bookings/footer');
    }

    function add_product_submit()
    {
        $this->load->model('product_model');
        $this->data['product_code'] = $this->product_model->product_code();
        $this->data['procat'] = $this->product_model->get_all_product_category();
        $this->load->model('uom_model');
        $this->data['uom'] = $this->uom_model->get_all_uom();
        $this->load->view('Bookings/add_product', $this->data);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required|is_unique[product.product_code]');
            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|is_unique[product.product_name]', array('is_unique' => 'The Product Name is already taken.'));
            $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
            $this->form_validation->set_rules('product_uom', 'Product UoM', 'trim|required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');
            $this->form_validation->set_rules('beginning_quantity', 'Beginning Quantity', 'trim|required');
            $this->form_validation->set_rules('product_status', 'Product Status', 'trim');
            $this->form_validation->set_rules('minimum_quantity', 'Minimum Quantity', 'trim|required');


            if ($this->form_validation->run() != FALSE) {
                // Form validation successful, proceed with insertion
                $this->load->model('product_model');
                $response = $this->product_model->insertproduct();

                if ($response) {
                    $success_message = 'Product added successfully.';
                    $this->session->set_flashdata('success', $success_message);
                } else {
                    $error_message = 'Product was not added.';
                    $this->session->set_flashdata('error', $error_message);
                }
                redirect('Bookings/product');
            } else {
                // Form validation failed, set session flashdata for debugging
                $debug_info = array(
                    'form_data' => $this->input->post(),
                    'validation_errors' => validation_errors()
                );
                $this->session->set_flashdata('debug_info', $debug_info);
                redirect('Bookings/product');
            }
        }
    }


    function add_product_category_submit()
    {
        $this->load->view('Bookings/add_product_category');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_category1', 'Product Category Name', 'trim|required|is_unique[product_category.product_category]');

            if ($this->form_validation->run() != FALSE) {
                $this->load->model('product_model');
                $response = $this->product_model->insert_added_product_category();
                if ($response) {
                    $success_message = 'Product category added successfully.';
                    $this->session->set_flashdata('success', $success_message);
                } else {
                    $error_message = 'Product category was not added successfully.';
                    $this->session->set_flashdata('error', $error_message);
                }
                redirect('Bookings/product');
            }
        }
    }


    function add_uom_submit()
    {

        $this->load->view('Bookings/add_uom');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('uom', 'Unit of Measure', 'trim|required|is_unique[uom.uom]');

            if ($this->form_validation->run() != FALSE) {
                $this->load->model('uom_model');
                $response = $this->uom_model->insert_added_uom();
                if ($response) {
                    $success_message = 'Unit of Measure added successfully.';
                    $this->session->set_flashdata('success', $success_message);
                } else {
                    $error_message = 'Unit of Measure was not added successfully.';
                    $this->session->set_flashdata('error', $error_message);
                }
                redirect('Bookings/product');
            }
        }
    }

    function receive_quantity($product_id)
    {
        $this->receive_quantity_submit();
        $this->load->model('product_model');
        $this->data['product'] = $this->product_model->get_product($product_id);
        $this->load->view('Bookings/receiving', $this->data);
    }

    function receive_quantity_submit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_quantity', 'Product Quantity', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                $this->load->model('uom_model');
                $response = $this->uom_model->insert_added_uom();
                if ($response) {
                    $success_message = 'Unit of Measure added successfully.';
                    $this->session->set_flashdata('success', $success_message);
                } else {
                    $error_message = 'Unit of Measure was not added successfully.';
                    $this->session->set_flashdata('error', $error_message);
                }
                redirect('Bookings/product');
            }
        }
    }
}
