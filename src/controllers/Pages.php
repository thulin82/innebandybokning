<?php
    class Pages extends Controller {
        public function __construct(){

        }

        public function index(){
            $data = [
                'title' => 'Index',
                'description' => 'Innebandybokning 3.0'
            ];

            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About',
                'description' => 'Denna sida är byggd med hjälp av <a href="http://getbootstrap.com/">bootstrap.</a> (v4.7.0)
                <br>Källkoden finns på <a href="https://github.com/thulin82/innebandybokning">GitHub</a>
                <br>&copy; Markus Thulin 2012-'
            ];
            $this->view('pages/about', $data);
        }
    }
