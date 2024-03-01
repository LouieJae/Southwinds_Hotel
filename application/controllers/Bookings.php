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
}
