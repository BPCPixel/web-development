<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // Cargamos el modelo (el archivo que creaste antes en minúsculas)
        $this->load->model('tienda_model'); 
    }

    public function index()
    {
        // Intentamos obtener productos. Si falla la conexión, mandamos un array vacío
        // para que el foreach de la vista no explote.
        try {
            $data['productos'] = $this->tienda_model->obtener_productos();
        } catch (Exception $e) {
            $data['productos'] = array();
        }

        $this->load->view('index', $data);
    }

    public function carrito()
    {
        $this->load->view('carrito');
    }
}