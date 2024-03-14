<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bookings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Exclude the index and login_submit methods from session check
        if ($this->router->fetch_method() != 'index' && $this->router->fetch_method() != 'login_submit') {
            $this->check_session(); // Call the session check method
        }
    }

    // Method to check session
    private function check_session()
    {
        // Check if the 'UserLoginSession' session data exists
        if (!$this->session->userdata('UserLoginSession')) {
            // If session data doesn't exist, redirect to login page
            redirect(base_url('bookings'));
        }
    }

    public function index()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->userdata('UserLoginSession')) {
            redirect(base_url('bookings/dashboard'));
        } else {
            // Load the login page
            $this->load->view('Bookings/login');
        }
    }

    function login_submit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $this->load->model('user_model');
                $status = $this->user_model->checkPassword($password, $username);
                if ($status != false) {
                    $username = $status->username;

                    $session_data = array(
                        'username' => $username,
                    );

                    $this->session->set_userdata('UserLoginSession', $session_data);

                    redirect(base_url('bookings/dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Username or Password is Wrong');
                    redirect(base_url('bookings/'));
                }
            } else {
                $this->session->set_flashdata('error', 'Fill all the required fields');
                redirect(base_url('bookings/'));
            }
        }
    }

    function logout()
    {
        // Destroy session and redirect to login page
        $this->session->sess_destroy();
        redirect(base_url('bookings'));
    }


    public function dashboard()
    {
        $this->load->model('room_model');
        $this->data['get_total_rooms'] = $this->room_model->get_total_rooms();
        $this->data['get_total_available_rooms'] = $this->room_model->get_total_available_rooms();
        $this->data['get_total_occupied_rooms'] = $this->room_model->get_total_occupied_rooms();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/dashboard', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function room_accommodations()
    {
        $this->load->model('room_model');
        $this->data['get_all_room'] = $this->room_model->get_all_room();
        $this->load->model('product_model');
        $this->data['products'] = $this->product_model->get_all_product();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/room_accommodations', $this->data);
        $this->load->view('Bookings/footer');
    }




    public function product()
    {
        $this->load->model('product_model');
        $this->data['products'] = $this->product_model->get_all_product();
        $this->data['product_code'] = $this->product_model->product_code();
        $this->data['procat'] = $this->product_model->get_all_product_category();
        $this->load->model('uom_model');
        $this->data['uom'] = $this->uom_model->get_all_uom();
        $this->load->view('Bookings/header');
        $this->load->view('bookings/product', $this->data);
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
                redirect('bookings/product');
            } else {
                // Form validation failed, set session flashdata for debugging
                $debug_info = array(
                    'form_data' => $this->input->post(),
                    'validation_errors' => validation_errors()
                );
                $this->session->set_flashdata('debug_info', $debug_info);
                redirect('bookings/product');
            }
        }
    }


    function add_product_category_submit()
    {
        $this->load->view('Bookings/add_product_category');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_category1', 'Product Category Name', 'trim|required|is_unique[product_category.product_category]', array('is_unique' => 'The Product Category is already taken.'));

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
                redirect('bookings/product');
            } else {
                // Form validation failed, set session flashdata for debugging
                $debug_info = array(
                    'form_data' => $this->input->post(),
                    'validation_errors' => validation_errors()
                );
                $this->session->set_flashdata('debug_info', $debug_info);
                redirect('bookings/product');
            }
        }
    }


    function add_uom_submit()
    {

        $this->load->view('Bookings/add_uom');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('uom', 'Unit of Measure', 'trim|required|is_unique[uom.uom]', array('is_unique' => 'The Unit of Measure is already taken.'));

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
                redirect('bookings/product');
            } else {
                // Form validation failed, set session flashdata for debugging
                $debug_info = array(
                    'form_data' => $this->input->post(),
                    'validation_errors' => validation_errors()
                );
                $this->session->set_flashdata('debug_info', $debug_info);
                redirect('bookings/product');
            }
        }
    }

    function receive_quantity($product_id)
    {
        $this->receive_quantity_submit();
        $this->load->model('product_model');
        $this->data['product'] = $this->product_model->get_product($product_id);
        $this->load->view('bookings/receiving', $this->data);
    }

    function receive_quantity_submit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_quantity', 'Product Quantity', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                $this->load->model('product_model');
                $response = $this->product_model->insert_received_quantity();
                if ($response) {
                    $success_message = 'Quantity added successfully.';
                    $this->session->set_flashdata('success', $success_message);
                } else {
                    $error_message = 'Quantity was not added successfully.';
                    $this->session->set_flashdata('error', $error_message);
                }
                redirect('bookings/product');
            }
        }
    }

    function edit_product($product_id)
    {
        $this->edit_product_submit($product_id);
        $this->load->model('product_model');
        $this->data['product'] = $this->product_model->get_product($product_id);
        $this->data['product_code'] = $this->product_model->product_code();
        $this->data['procat'] = $this->product_model->get_all_product_category();
        $this->load->model('uom_model');
        $this->data['uom'] = $this->uom_model->get_all_uom();
        $this->load->view('Bookings/edit_product', $this->data);
    }

    function edit_product_submit($product_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
            $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
            $this->form_validation->set_rules('product_uom', 'Product UoM', 'trim|required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');
            $this->form_validation->set_rules('beginning_quantity', 'Beginning Quantity', 'trim|required');
            $this->form_validation->set_rules('product_status', 'Product Status', 'trim');
            $this->form_validation->set_rules('minimum_quantity', 'Minimum Quantity', 'trim|required');


            if ($this->form_validation->run() != FALSE) {
                // Form validation successful, proceed with insertion
                $this->load->model('product_model');
                $response = $this->product_model->update_product($product_id);

                if ($response) {
                    $success_message = 'Product updated successfully.';
                    $this->session->set_flashdata('success', $success_message);
                } else {
                    $error_message = 'Product was not updated.';
                    $this->session->set_flashdata('error', $error_message);
                }
                redirect('bookings/product');
            } else {
                // Form validation failed, set session flashdata for debugging
                $debug_info = array(
                    'form_data' => $this->input->post(),
                    'validation_errors' => validation_errors()
                );
                $this->session->set_flashdata('debug_info', $debug_info);
                redirect('bookings/product');
            }
        }
    }

    function delete_product($product_id)
    {
        $this->load->model('product_model');
        $response = $this->product_model->delete_product($product_id);

        if ($response) {
            $success_message = 'Product deleted successfully.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'Product was not deleted successfully.';
            $this->session->set_flashdata('error', $error_message);
        }

        redirect('bookings/product');
    }

    public function reports()
    {
        $this->load->model('room_model');
        $this->data['room'] = $this->room_model->get_all_room();
        $this->load->model('report_model');

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the values from the form
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');

            // Pass the values to the model and retrieve the sales data
            $this->data['sales_data'] = $this->report_model->get_sales_by_day_of_week($date_from, $date_to);
            $this->data['total'] = $this->report_model->get_sales_by_room($date_from, $date_to);
            $this->data['month_data'] = $this->report_model->get_sales_by_month($date_from, $date_to);
        } else {
            // If the form is not submitted, set default values or handle accordingly
            $date_from = ''; // Set default or handle as needed
            $date_to = ''; // Set default or handle as needed
            $this->data['sales_data'] = array(); // Initialize sales data array
            $this->data['total'] = array();
            $this->data['month_data'] = array();
        }

        // Load the view with the necessary data
        $this->load->view('Bookings/header');
        $this->load->view('bookings/reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    /*public function total_reports()
    {
        $this->load->model('report_model');aaaaaa
        $this->data['room'] = $this->report_model->get_all_room();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');

            $this->data['total'] = $this->report_model->get_sales_by_date_range($date_from, $date_to);
        } else {
            $date_from = '';
            $date_to = '';
            $this->data['total'] = array();
        }
    }*/

    public function daily_reports()
    {
        $this->load->model('room_model');
        $this->data['room'] = $this->room_model->get_all_room();
        $this->load->model('report_model');

        // Set the start date to March 1, 2024
        $start_date = new DateTime('2024-03-01'); // Change this depending on the starting day of operations
        $end_date = new DateTime(); // Current date

        // Array to store daily sales
        $daily_sales = array();

        // Loop through each day from start date until today
        while ($start_date <= $end_date) {
            $date = $start_date->format('Y-m-d');

            // Fetch daily sales for the current date
            $daily_sales[$date] = $this->report_model->get_daily_sales($date);

            // Move to the next day
            $start_date->modify('+1 day');
        }

        // Pass daily sales data to the view
        $this->data['daily_sales'] = $daily_sales;

        $this->load->view('Bookings/header');
        $this->load->view('bookings/daily_reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function view_daily_reports($date)
    {
        $this->load->model('room_model');
        $this->data['room'] = $this->room_model->get_all_room();
        $this->load->model('report_model');
        $this->data['daily_room'] = $this->report_model->get_daily_sales_per_room($date);
        $this->data['date'] = $date;
        $this->load->view('Bookings/header');
        $this->load->view('bookings/room_daily_reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function view_monthly_reports($year_month)
    {
        $this->load->model('room_model');
        $this->data['room'] = $this->room_model->get_all_room();
        $this->load->model('report_model');
        $this->data['monthly_room'] = $this->report_model->get_monthly_sales_per_room($year_month);
        $this->data['date'] = $year_month;
        $this->load->view('Bookings/header');
        $this->load->view('bookings/room_monthly_reports', $this->data);
        $this->load->view('Bookings/footer');
    }


    public function per_room_reports()
    {
        $this->load->model('room_model');
        $this->data['room'] = $this->room_model->get_all_room();
        $this->load->model('report_model');

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the values from the form
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');

            $this->data['total'] = $this->report_model->get_sales_by_room($date_from, $date_to);
        } else {
            // If the form is not submitted, set default values or handle accordingly
            $date_from = ''; // Set default or handle as needed
            $date_to = ''; // Set default or handle as needed

            $this->data['total'] = array();
        }

        $this->load->view('Bookings/header');
        $this->load->view('bookings/per_room_reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function monthly_reports()
    {
        $this->load->model('room_model');
        $this->data['room'] = $this->room_model->get_all_room();
        $this->load->model('report_model');

        // Set the start date to the beginning of the year
        $start_date = new DateTime(date('2022') . '-01-01');
        $end_date = new DateTime(); // Current date

        // Array to store monthly sales
        $monthly_sales = array();

        // Loop through each month from the start date until today
        while ($start_date <= $end_date) {
            $year_month = $start_date->format('Y-m');

            // Fetch monthly sales for the current month
            $monthly_sales[$year_month] = $this->report_model->get_monthly_sales($year_month);

            // Move to the next month
            $start_date->modify('+1 month');
        }

        // Pass monthly sales data to the view
        $this->data['monthly_sales'] = $monthly_sales;

        $this->load->view('Bookings/header');
        $this->load->view('bookings/monthly_reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    function check_in_submit()
    {
        $this->load->model('room_model');
        $this->data['get_all_room'] = $this->room_model->get_all_room();

        $this->load->model('check_in_model');
        $response = $this->check_in_model->insert_checkin();

        if ($response) {
            $success_message = 'CheckIn updated successfully.';
            $this->session->set_flashdata('success', $success_message);
            redirect('bookings/room_accommodations');
        } else {
            $error_message = 'Product was not updated.';
            $this->session->set_flashdata('error', $error_message);
            redirect('bookings/product');
        }
    }
}
