<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_model extends CI_Model {

    public function add_agenda_motor()
    {
        $data = array(
            'fk_id_carro_viagem_mtv' => $this->input->post('pl_car_trip', TRUE),
            'fk_id_motorista_mtv' => $this->input->post('selectMyMotor', TRUE),
            'token_da_agenda_viagem_mtv' => $this->input->post('valor_key_tip', TRUE),
            'observacao_ao_motorista_mtv' => $this->input->post('agenda_moto_obs')
        );
    
        return $this->db->insert('motorista_agenda_viagem', $data);
    }

}

/* End of file Dynamic_model.php */
