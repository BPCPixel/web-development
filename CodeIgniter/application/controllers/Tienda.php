<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function carrito()
    {
        $this->load->view('carrito');
    }
}