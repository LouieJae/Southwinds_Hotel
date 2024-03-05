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
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/room_accommodations', $this->data);
        $this->load->view('Bookings/footer');
    }
    public function inventory()
    {
        $this->load->model('product_model');
        $this->data['product_code'] = $this->product_model->product_code();
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/inventory', $this->data);
        $this->load->view('Bookings/footer');
    }
    public function reports()
    {
        $this->load->view('Bookings/header');
        $this->load->view('Bookings/reports');
        $this->load->view('Bookings/footer');
    }
}