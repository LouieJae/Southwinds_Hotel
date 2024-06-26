<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bookings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
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
            redirect(base_url('Bookings'));
        }
    }

    public function index()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->userdata('UserLoginSession')) {
            redirect(base_url('Bookings/dashboard'));
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
                $user = $this->user_model->checkPassword($password, $username);
                if ($user) {
                    $session_data = array(
                        'username' => $user->username,
                        'roles' => $user->roles // Assuming 'roles' is a field in your user table
                    );

                    $this->session->set_userdata('UserLoginSession', $session_data);

                    redirect(base_url('Bookings/dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Username or Password is Wrong');
                    redirect(base_url('Bookings/'));
                }
            } else {
                $this->session->set_flashdata('error', 'Fill all the required fields');
                redirect(base_url('Bookings/'));
            }
        }
    }

    function logout()
    {
        // Destroy session and redirect to login page
        $this->session->sess_destroy();
        redirect(base_url('Bookings'));
    }

    public function dashboard()
    {
        // Load necessary models
        $this->load->model('room_model');
        $this->load->model('report_model');

        // Retrieve existing data
        $this->data['get_total_rooms'] = $this->room_model->get_total_rooms();
        $this->data['get_total_available_rooms'] = $this->room_model->get_total_available_rooms();
        $this->data['get_total_occupied_rooms'] = $this->room_model->get_total_occupied_rooms();
        $this->data['get_total_housekeeping_rooms'] = $this->room_model->get_total_housekeeping_rooms();

        // Retrieve last seven days sales data
        $last_seven_days_sales = $this->report_model->get_last_seven_days_sales();

        // Process sales data for chart
        $chart_labels = array();
        $sales_data = array();
        $current_date = date('Y-m-d');

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days", strtotime($current_date)));

            $day_name = date('l', strtotime($date));
            $chart_labels[] = $day_name . ' (' . date('M d', strtotime($date)) . ')';

            $sales_for_date = 0;
            foreach ($last_seven_days_sales as $sale) {
                if ($sale->date === $date) {
                    $sales_for_date = $sale->daily_total_sales;
                    break;
                }
            }

            $sales_data[] = $sales_for_date;
        }

        $this->data['rooms_needing_attention'] = $this->room_model->getRoomsNeedAttention();

        // Load views
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/dashboard', array(
            'chart_labels' => $chart_labels,
            'sales_data' => $sales_data,
            'data' => $this->data,
            'rooms_needing_attention' => $this->data['rooms_needing_attention']
        ));
        $this->load->view('Bookings/footer');
    }

    public function room_accommodations()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('room_model');
        $this->data['get_all_room'] = $this->room_model->get_all_room();
        $this->load->model('product_model');
        $this->data['products'] = $this->product_model->get_all_product();
        $this->load->model('checkin_model');
        $this->data['add_ons_no'] = $this->checkin_model->add_ons_no();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/room_accommodations', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function product()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('product_model');
        $this->data['products'] = $this->product_model->get_all_product_table();
        $this->data['product_code'] = $this->product_model->product_code();
        $this->data['procat'] = $this->product_model->get_all_product_category();
        $this->load->model('uom_model');
        $this->data['uom'] = $this->uom_model->get_all_uom();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/product', $this->data);
        $this->load->view('Bookings/footer');
    }

    function add_product_submit()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
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
                $error_message = 'The Product Name already exists.';
                $this->session->set_flashdata('error', $error_message);
                redirect('Bookings/product');
            }
        }
    }

    function checkin_submit()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('room_model');
        $this->data['get_all_room'] = $this->room_model->get_all_room();
        $this->load->model('product_model');
        $this->data['products'] = $this->product_model->get_all_product();
        $this->load->view('Bookings/roomModals', $this->data);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->load->model('checkin_model');
            $response = $this->checkin_model->checkin_room();

            if (is_string($response)) {
                // Quantity exceeds available quantity
                $available_quantity = $this->checkin_model->get_available_quantity($response);
                $error_message = 'Checkin was not added. Quantity exceeds available quantity for product: ' . $response . '. Available quantity: ' . $available_quantity;
                $this->session->set_flashdata('error', $error_message);
            } else {
                // Check-in successful
                $success_message = 'Checkin added successfully.';
                $this->session->set_flashdata('success', $success_message);
            }
            redirect('Bookings/room_accommodations');
        }
    }

    function add_on()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('checkin_model');
        $this->load->model('room_model');
        $this->data['checkins'] = $this->checkin_model->get_all_checkin();
        $this->data['get_all_room'] = $this->room_model->get_all_room();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/add_on', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function add_ons($check_in_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('product_model');
        $this->load->model('room_model');
        $this->load->model('checkin_model');
        $this->data['checkin'] = $this->checkin_model->get_checkin($check_in_id);
        $this->data['view'] = $this->checkin_model->view_all_addons($check_in_id);
        $this->data['get_all_room'] = $this->room_model->get_all_room();
        $this->data['products'] = $this->product_model->get_all_product();
        // Load view for adding add-ons
        $this->load->view('Bookings/addOnsModals', $this->data);
    }

    function add_ons_submit($check_in_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->model('checkin_model');
            $response = $this->checkin_model->update_checkin($check_in_id);

            if ($response === false) {
                // Quantity exceeds available quantity
                $available_quantity = $this->checkin_model->get_available_quantity($response);
                $error_message = 'Add ons was not added. Quantity exceeds available quantity for product: ' . $response . '. Available quantity: ' . $available_quantity;
                $this->session->set_flashdata('error', $error_message);
            } else {
                // Check-in successful
                $success_message = 'Add ons added successfully.';
                $this->session->set_flashdata('success', $success_message);
            }
            redirect('Bookings/add_on');
        }
    }

    public function check_out($check_in_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('product_model');
        $this->load->model('room_model');
        $this->load->model('checkin_model');
        $this->data['checkout'] = $this->checkin_model->get_checkout($check_in_id);
        $this->data['room_sales_no'] = $this->checkin_model->sales_ref_no();
        $this->data['checkout_no'] = $this->checkin_model->checkout_no();
        $this->data['view'] = $this->checkin_model->view_all_addons($check_in_id);
        $this->data['get_all_room'] = $this->room_model->get_all_room();
        $this->data['products'] = $this->product_model->get_all_product();
        // Load view for adding add-ons
        $this->load->view('Bookings/checkoutModal', $this->data);
    }

    function check_out_submit($check_in_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->load->model('checkin_model');
            $response = $this->checkin_model->check_out($check_in_id);

            if ($response) {
                $success_message = 'Add ons added successfully.';
                $this->session->set_flashdata('success', $success_message);
            } else {
                $error_message = 'Add ons added was not added.';
                $this->session->set_flashdata('error', $error_message);
            }
            redirect('Bookings/add_on');
        }
    }

    function update_available($check_in_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('checkin_model');
        $response = $this->checkin_model->update_available($check_in_id);

        if ($response) {
            $success_message = 'Room is done housekeeping.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'Room was not done housekeeping.';
            $this->session->set_flashdata('error', $error_message);
        }

        redirect('Bookings/room_accommodations');
    }

    function add_product_category_submit()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
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
                redirect('Bookings/product');
            } else {
                $error_message = 'This Product Category already exists.';
                $this->session->set_flashdata('error', $error_message);
                redirect('Bookings/product');
            }
        }
    }


    function add_uom_submit()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
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
                redirect('Bookings/product');
            } else {
                $error_message = 'This Unit of Measure already exists.';
                $this->session->set_flashdata('error', $error_message);
                redirect('Bookings/product');
            }
        }
    }

    function receive_quantity($product_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->receive_quantity_submit();
        $this->load->model('product_model');
        $this->data['product'] = $this->product_model->get_product($product_id);
        $this->load->view('Bookings/receiving', $this->data);
    }

    function receive_quantity_submit()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
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
                redirect('Bookings/product');
            }
        }
    }

    function edit_product($product_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_FRONT_DESK) {
            redirect('bookings/dashboard');
        }
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
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_FRONT_DESK) {
            redirect('bookings/dashboard');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
            // Modify the validation rule for product name
            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|callback_unique_product_name[' . $product_id . ']');
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
                redirect('Bookings/product');
            } else {
                $error_message = 'The form contains errors.';
                $this->session->set_flashdata('error', $error_message);
                redirect('Bookings/product');
            }
        }
    }

    function unique_product_name($product_name, $product_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('product_model');
        $existing_product = $this->product_model->get_product($product_id, $product_name);

        // If no product found with the given name or the found product's ID matches the current product being edited, return true
        if (!$existing_product) {
            return true;
        } else {
            // Product name is already taken by another product
            $this->form_validation->set_message('unique_product_name', 'The Product Name is already taken.');
            return false;
        }
    }

    function delete_product($product_id)
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_FRONT_DESK) {
            redirect('bookings/dashboard');
        }
        $this->load->model('product_model');
        $response = $this->product_model->delete_product($product_id);

        if ($response) {
            $success_message = 'Product deleted successfully.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'Product was not deleted successfully.';
            $this->session->set_flashdata('error', $error_message);
        }

        redirect('Bookings/product');
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
        $this->load->view('Bookings/reports', $this->data);
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
        $this->load->view('Bookings/daily_reports', $this->data);
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
        $this->load->view('Bookings/room_daily_reports', $this->data);
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
        $this->load->view('Bookings/room_monthly_reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    public function view_daily_breakdowns($date, $room_no)
    {
        $this->load->model('report_model');
        $this->data['breakdowns'] = $this->report_model->get_room_no_and_date($date, $room_no);
        $this->data['date'] = $date;
        $this->data['room_no'] = $room_no;
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/room_breakdown', $this->data);
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
        $this->load->view('Bookings/per_room_reports', $this->data);
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
        $this->load->view('Bookings/monthly_reports', $this->data);
        $this->load->view('Bookings/footer');
    }

    function check_in_submit()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }

        $this->load->model('room_model');
        $this->data['get_all_room'] = $this->room_model->get_all_room();

        $this->load->model('check_in_model');
        $response = $this->check_in_model->insert_checkin();

        if ($response) {
            $success_message = 'CheckIn updated successfully.';
            $this->session->set_flashdata('success', $success_message);
            redirect('Bookings/room_accommodations');
        } else {
            $error_message = 'Product was not updated.';
            $this->session->set_flashdata('error', $error_message);
            redirect('Bookings/product');
        }
    }
    public function activity_logs()
    {
        if ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER) {
            redirect('bookings/dashboard');
        }
        $this->load->model('user_model');
        $this->data['activity'] = $this->user_model->get_activity();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/activity_logs', $this->data);
        $this->load->view('Bookings/footer');
    }
}
