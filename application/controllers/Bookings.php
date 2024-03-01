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
    public function room_accomodations()
    {
        $this->load->view('Bookings/room_accomodations');
    }
}
