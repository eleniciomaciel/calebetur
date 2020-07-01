<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{

    protected $usuarios_tabel = 'users_gestores';

    public function login($email, $password){

        $query = $this->db->get_where($this->usuarios_tabel, array('us_login'=>$email, 'us_senha'=> md5($password), 'us_status'=> '1'));
        return $query->row_array();
    }

    public function get_set_usuarios($slug = FALSE)
    {
        if ($slug === FALSE) {
            $data_cad = date("Y-m-d");
            $data = array(
                'us_nome'       => $this->input->post('ges_nome', TRUE),
                'us_telefone'   => $this->input->post('ges_telefone', TRUE),
                'us_email'      => $this->input->post('ges_email', TRUE),
                'us_endereco'   => $this->input->post('ges_endereco', TRUE),
                'us_cidade'     => $this->input->post('city', TRUE),
                'us_estado'     => $this->input->post('selectUf', TRUE),
                'us_agencia_fk' => $this->input->post('user_agencias', TRUE),
                'us_nivel'      => $this->input->post('ges_nivel', TRUE),
                'us_data'       => $data_cad,

                'us_cnh'            => $this->input->post('mt_num_cnh', TRUE),
                'us_data_validade'  => $this->input->post('mt_data_validade_cnh', TRUE),
                'us_categoria'      => $this->input->post('mt_categoria_cnh', TRUE),
                'us_rg'             => $this->input->post('mt_rg_motor', TRUE),
                'us_cpf'            => $this->input->post('mt_cpf_motor', TRUE),
                'us_tel_emergencia' => $this->input->post('mt_tel_motor', TRUE),
                'us_banco'          => $this->input->post('mt_banco', TRUE),
                'us_tipo_conta'     => $this->input->post('mt_tipo_conta', TRUE),
                'us_nome_conta'     => $this->input->post('mt_nome_conta', TRUE),
                'us_numero_conta'   => $this->input->post('mt_numero_conta', TRUE),
                'us_opraracao_conta'=> $this->input->post('mt_conta_op', TRUE),
                'us_numero_banco'   => $this->input->post('mt_num_banco', TRUE),
                'us_observer_motor' => $this->input->post('mt_observe', TRUE),
            );
        
            return $this->db->insert($this->usuarios_tabel, $data);
        }

        $query = $this->db->get_where($this->usuarios_tabel, array('us_id' => $slug));
        return $query->result();
    }
}

/* End of file Usuarios_model.php */
