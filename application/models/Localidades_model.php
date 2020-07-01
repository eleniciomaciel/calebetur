<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Localidades_model extends CI_Model
{

    public function set_get_localidades($slug = FALSE)
    {
        if ($slug === FALSE) {

            $data = array(
                'estado_loc' => $this->input->post('inputStateUf'),
                'cidade_loc' => $this->input->post('cidade_atende'),
                'local_loc' => $this->input->post('localAtende')
            );
            return $this->db->insert('localidades', $data);
        }

        return $this->db->delete('localidades', array('id_loc' => $slug));
    }
}

/* End of file Localidades_model.php */
