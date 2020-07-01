<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculos_model extends CI_Model {

    public function setGetVeiculo($slug = FALSE)
    {
        if ($slug === FALSE) {
            $data = array(
                'marca_veic' => $this->input->post('veiculo_marca'),
                'modelo_ano_veic' => $this->input->post('veiculo_modelo'),
                'ano_veic' => $this->input->post('veiculo_ano'),
                'chassi_veic' => $this->input->post('veiculo_chassi'),
                'poltronas_veic' => $this->input->post('veiculo_poltrona'),
                'placa_veic' => $this->input->post('veiculo_placa'),
                'status_carro_veic' => $this->input->post('veiculo_tipo_carro'),
            );
            return $this->db->insert('veiculos', $data);
        }

        $query = $this->db->get_where('veiculos', array('id_veic' => $slug));
        return $query;
    }

}

/* End of file Veiculos_model.php */
