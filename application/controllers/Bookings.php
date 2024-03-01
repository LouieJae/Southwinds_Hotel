<?php
class Bookings extends CI_Controller
{
    public function index()
    {
        $this->load->view('Bookings/login');
    }
    public function dashboard()
    {
        $this->load->view('Bookings/dashboard');
    }
}
