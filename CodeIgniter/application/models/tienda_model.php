<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_model extends CI_Model {

    // Obtiene todos los productos para la página principal
    public function obtener_productos() {
        $query = $this->db->get('productos');
        return $query->result_array();
    }

    // Guardar la venta
    public function insertar_venta($data) {
        $this->db->insert('ventas', $data);
        return $this->db->insert_id(); // Retorna el ID de la venta generada
    }

    // Guardar los detalles de la venta
    public function insertar_detalle($data) {
        $this->db->insert('detalles_ventas', $data);
    }
}