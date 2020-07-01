<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AgenciaController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agencia_model');
    }

    public function addAgencia()
    {
        $this->form_validation->set_rules('nome_ag', 'NOME DA AGÊNCIA', 'required|is_unique[agencias.nome_ag]');
        $this->form_validation->set_rules('telefone_ag', 'TELEFONE', 'required');
        $this->form_validation->set_rules('email_ag', 'EMAIL DA AGÊNCIA', 'required|valid_email');
        $this->form_validation->set_rules('selectUf_ag', 'UF', 'required');
        $this->form_validation->set_rules('cidade_ag', 'CIDADE', 'required');
        $this->form_validation->set_rules('bairro_ag', 'BAIRRO', 'required');
        $this->form_validation->set_rules('endereco_ag', 'ENDEREÇO', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $this->Agencia_model->setGetAgencia();
            echo json_encode(['success' => 'Agência adicionada com sucesso.']);
        }
    }

    /**get agencias */
    public function get_all_agencias()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $query = $this->db->select('*')
            ->from('agencias')
            ->join('cidade', 'cidade.id = agencias.cidade_ag')
            ->get();
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                $r->nome_ag,
                $r->telefone_ag,
                $r->email_ag,
                $r->nome,
                '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opções
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="viewDadosAg dropdown-item" id="' . $r->id_ag . '">
                            <i class="material-icons"> visibility </i>&nbsp;Visualizar
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="delete_ag dropdown-item"id="' . $r->id_ag . '">
                            <i class="material-icons"> delete_forever </i>&nbsp;Deletar
                        </a>
                    </div>
                </div>',
            );
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }

    /**select agencias */
    public function select_all_agencias()
    {
        $result = $this->db->get("agencias")->result();
        echo json_encode($result);
    }

    /**pega dados agencia */
    public function visualiza_agencia(int $id)
    {
        $output = array();
        $data = $this->Agencia_model->setGetAgencia($id);
        foreach ($data->result() as $row) {
            $output['vw_up_nome'] = $row->nome_ag;
            $output['vw_up_estado'] = $row->estado_ag;
            $output['vw_up_cidade'] = $row->cidade_ag;
            $output['vw_up_bairro'] = $row->bairro_ag;
            $output['vw_up_endereco'] = $row->endereco_ag;
            $output['vw_up_telefone'] = $row->telefone_ag;
            $output['vw_up_email'] = $row->email_ag;
        }
        echo json_encode($output);
    }

    /**altera dados da agencia */
    public function altera_agencia(int $id)
    {
        $this->form_validation->set_rules('vw_up_nome', 'NOME DA AGÊNCIA', 'required');
        $this->form_validation->set_rules('vw_up_telefone', 'TELEFONE', 'required');
        $this->form_validation->set_rules('vw_up_email', 'EMAIL DA AGÊNCIA', 'required|valid_email');
        $this->form_validation->set_rules('vw_up_estado', 'UF', 'required');
        $this->form_validation->set_rules('vw_up_cidade', 'CIDADE', 'required');
        $this->form_validation->set_rules('vw_up_bairro', 'BAIRRO', 'required');
        $this->form_validation->set_rules('vw_up_endereco', 'ENDEREÇO', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $data = array(
                'nome_ag' => $this->input->post('vw_up_nome'),
                'estado_ag' => $this->input->post('vw_up_estado'),
                'cidade_ag' => $this->input->post('vw_up_cidade'),
                'bairro_ag' => $this->input->post('vw_up_bairro'),
                'endereco_ag' => $this->input->post('vw_up_endereco'),
                'telefone_ag' => $this->input->post('vw_up_telefone'),
                'email_ag' => $this->input->post('vw_up_email')
            );
            $this->db->update('agencias', $data, array('id_ag' => $id));
            echo json_encode(['success' => 'Agência alterada com sucesso.']);
        }
    }

    /**delete agencia */
    public function delete_agencia(int $id)
    {
        $this->db->delete('agencias', array('id_ag' => $id));
        echo 'Agência deletada com sucesso!';
    }

    /**soma todos os ujsuarios */
    public function somaTodasAgencias()
    {
        $query = $this->db->query('SELECT COUNT(id_ag) AS total_agencias FROM agencias');
        $row = $query->row();
        echo $row->total_agencias;
    }
}

/* End of file AgenciaController.php */
