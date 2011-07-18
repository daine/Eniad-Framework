<?php
class homeController extends E_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load_view('home');
    }
}
