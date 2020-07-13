<?php
    class Pages extends Controller {
        public function __construct(){

        }

        public function index(){
            $data = [
                'title' => 'Welcome to index page'
            ];

            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'Welcome to about page'
            ];
            $this->view('pages/about', $data);
        }
    }
