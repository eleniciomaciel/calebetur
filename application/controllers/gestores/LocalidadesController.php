<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LocalidadesController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Localidades_model');
    }

    public function inseriLocalidades()
    {
        $this->form_validation->set_rules('inputStateUf', 'Estado', 'required');
        $this->form_validation->set_rules('cidade_atende', 'Cidade', 'required');
        $this->form_validation->set_rules('localAtende', 'Localidade', 'required|is_unique[localidades.local_loc]');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $this->Localidades_model->set_get_localidades();
            echo json_encode(['success' => 'Localidade adicionada com sucesso.']);
        }
    }

    public function get_localidades()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->select('*,cidade.nome as nome_c, estado.nome as uf')
            ->from('localidades')
            ->join('cidade', 'cidade.id = localidades.cidade_loc')
            ->join('estado', 'estado.id = localidades.estado_loc')
            ->get();

        $data = [];
        foreach ($query->result() as $r) {
            $data[] = array(
                $r->uf,
                $r->nome_c,
                $r->local_loc,
                '<a href="#" class="btn_del_loc btn btn-primary btn-sm" id="'.$r->id_loc.'">
                    <i class="material-icons">delete_forever</i> Deletar
                </a>'
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
    /**deleta localidades */
    public function del_localidades(int $id)
    {
        $this->Localidades_model->set_get_localidades($id);
        echo 'Localidade deletada com sucesso';
    }
}

/* End of file LocalidadesController.php */
