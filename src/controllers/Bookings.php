<?php
    class Bookings extends Controller {
        public function __construct(){
            if(!isLoggedIn()) {
                redirect('users/login');
            }
        }
        public function index() {
            $data = [
                'title' => 'Bookings page',
                'description' => 'Innebandybokning 3.0'
            ];

            $this->view('bookings/index', $data);
        }
    }
