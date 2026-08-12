<?php
class Bookings extends Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
    }

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        $data = [
            'title' => 'Bookings page',
            'description' => 'Innebandybokning 3.0'
            ];

        $this->view('bookings/index', $data);
    }
}
