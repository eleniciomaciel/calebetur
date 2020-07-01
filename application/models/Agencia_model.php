<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Agencia_model extends CI_Model
{

    public function setGetAgencia($slug = FALSE)
    {
        if ($slug === FALSE) {
            $data = array(
                'nome_ag' => $this->input->post('nome_ag'),
                'estado_ag' => $this->input->post('selectUf_ag'),
                'cidade_ag' => $this->input->post('cidade_ag'),
                'bairro_ag' => $this->input->post('bairro_ag'),
                'endereco_ag' => $this->input->post('endereco_ag'),
                'telefone_ag' => $this->input->post('telefone_ag'),
                'email_ag' => $this->input->post('email_ag')
            );
            return $this->db->insert('agencias', $data);
        }

        $query = $this->db->get_where('agencias', array('id_ag' => $slug));
        return $query;
    }
}

/* End of file Agencia_model.php */
