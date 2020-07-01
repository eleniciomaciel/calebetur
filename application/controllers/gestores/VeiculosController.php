<?php

defined('BASEPATH') or exit('No direct script access allowed');

class VeiculosController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('Veiculos_model');
  }

  public function salvaVeiculo()
  {
    $this->form_validation->set_rules('veiculo_marca', 'MARCA', 'required|max_length[100]');
    $this->form_validation->set_rules('veiculo_modelo', 'MODELO', 'required|max_length[60]');
    $this->form_validation->set_rules('veiculo_ano', 'ANO DO VEICULO', 'required|max_length[4]');
    $this->form_validation->set_rules('veiculo_chassi', 'CHASSI', 'required|max_length[17]|is_unique[veiculos.chassi_veic]');
    $this->form_validation->set_rules('veiculo_poltrona', 'POLTRONAS', 'required|integer|max_length[2]');
    $this->form_validation->set_rules('veiculo_placa', 'PLACA', 'required|is_unique[veiculos.placa_veic]|max_length[10]');
    $this->form_validation->set_rules('veiculo_tipo_carro', 'Tipo de aquisição', 'required|in_list[Próprio,Fretado]');


    if ($this->form_validation->run() == FALSE) {
      $errors = validation_errors();
      echo json_encode(['error' => $errors]);
    } else {
      $this->Veiculos_model->setGetVeiculo();
      echo json_encode(['success' => 'Veículo adicionada com sucesso.']);
    }
  }

  /**get agencias */
  public function get_all_carros()
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $query = $this->db->get('veiculos');
    $data = [];

    foreach ($query->result() as $r) {
      $data[] = array(
        $r->ano_veic,
        $r->marca_veic,
        $r->modelo_ano_veic,
        $r->placa_veic,
        $r->chassi_veic,
        $r->status_carro_veic,
        '<div class="btn-group pull-right">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Opções
            </button>
            <div class="dropdown-menu">
              <a href="#" class="viewAlteraCar dropdown-item" id="' . $r->id_veic . '">
                <i class="material-icons"> visibility </i>&nbsp;Visualizar
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="desativaCar dropdown-item"  id="' . $r->id_veic . '">
                <i class="material-icons"> power_settings_new </i>&nbsp;Desativar
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

  /**lista dados do carro */
  public function get_car(int $id)
  {
    $output = array();
    $data = $this->Veiculos_model->setGetVeiculo($id);
    foreach ($data->result() as $row) {
      $output['car_up_marca'] = $row->marca_veic;
      $output['car_up_modelo'] = $row->modelo_ano_veic;
      $output['car_up_ano_vei'] = $row->ano_veic;
      $output['car_up_chassi'] = $row->chassi_veic;
      $output['car_up_poltronas'] = $row->poltronas_veic;
      $output['car_up_placa'] = $row->placa_veic;
      $output['car_up_status'] = $row->status_carro_veic;
    }
    echo json_encode($output);
  }

  /**altera dados do carro */
  public function alteraDadosDoCarro(int $id)
  {
    $this->form_validation->set_rules('car_up_marca', 'MARCA', 'required');
    $this->form_validation->set_rules('car_up_modelo', 'MODELO', 'required');
    $this->form_validation->set_rules('car_up_ano_vei', 'ANO', 'required');
    $this->form_validation->set_rules('car_up_chassi', 'CHASSIx', 'required');
    $this->form_validation->set_rules('car_up_poltronas', 'POLTRONASx', 'required');
    $this->form_validation->set_rules('car_up_placa', 'PLACA', 'required');
    $this->form_validation->set_rules('car_up_status', 'Tipo de aquisição', 'required|in_list[Próprio,Fretado]');


    if ($this->form_validation->run() == FALSE) {
      $errors = validation_errors();
      echo json_encode(['error' => $errors]);
    } else {
      $data = array(
        'marca_veic' => $this->input->post('car_up_marca'),
        'modelo_ano_veic' => $this->input->post('car_up_modelo'),
        'ano_veic' => $this->input->post('car_up_ano_vei'),
        'chassi_veic' => $this->input->post('car_up_chassi'),
        'poltronas_veic' => $this->input->post('car_up_poltronas'),
        'placa_veic' => $this->input->post('car_up_placa'),
        'status_carro_veic' => $this->input->post('car_up_status'),
      );
      $this->db->update('veiculos', $data, array('id_veic' => $id));
      echo json_encode(['success' => 'Dados do veículo alterada com sucesso.']);
    }
  }

  /**deleta dados carro */
  public function deletaCarro(int $id)
  {
    $this->db->delete('veiculos', array('id_veic' => $id));
    echo 'Veículo deletada com sucesso!';
  }
}

/* End of file VeiculosController.php */
