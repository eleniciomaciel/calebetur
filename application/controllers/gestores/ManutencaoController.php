<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ManutencaoController extends CI_Controller
{

  public function addCarManutencao()
  {
    $this->form_validation->set_rules(
      'add_car_manutencao',
      'Veículo',
      'required|is_unique[carro_para_manutencao.fk_car_m]',
      array('is_unique' => 'Este %s já foi lançado para manutenção.')
    );


    if ($this->form_validation->run() == FALSE) {
      $errors = validation_errors();
      echo json_encode(['error' => $errors]);
    } else {
      $data = array(
        'fk_car_m' => $this->input->post('add_car_manutencao')
      );

      $this->db->insert('carro_para_manutencao', $data);
      echo json_encode(['success' => 'Veículo lançado com sucesso.']);
    }
  }

  /**lista veiculos que tem serviços na manutenção */
  public function get_carrosComManutencao()
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->select('*')
      ->from('carro_para_manutencao')
      ->join('veiculos', 'veiculos.id_veic = carro_para_manutencao.fk_car_m')
      ->get();

    $data = [];

    foreach ($query->result() as $r) {
      $data[] = array(
        $r->placa_veic,
        $r->marca_veic,
        $r->modelo_ano_veic,
        $r->poltronas_veic,
        '<div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opções
                </button>
                <div class="dropdown-menu">
                  <a class="pecaManutencao dropdown-item" href="#" id="' . $r->fk_car_m . '">
                    <i class="material-icons"> build </i>&nbsp;Consultar
                  </a>

                  <a class="pecaAddManutencao dropdown-item" href="#" id="' . $r->fk_car_m. '">
                    <i class="material-icons"> fitness_center </i>&nbsp;Add peças
                  </a>

                  
                </div>
              </div>'
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

  public function get_carrosComManutencaoPecas(int $id)
  {
    $output = '';
    $query = '';

    if ($this->input->post('query')) {
      $query = $this->input->post('query');
    }
    $data = $this->db->select('*')
                      ->from('pecas_manutencao_historicos')
                      ->join('veiculos', 'veiculos.id_veic = pecas_manutencao_historicos.fk_car_pc')
                      ->where('fk_car_pc', $id)
                      ->order_by('descricao_pc', 'DESC')
                      ->get();
    $output .= '
    
  <div class="table-responsive">
    <table class="table">
        <thead class=" text-primary">
            <th>Descrição</th>
            <th>Nº da nota</th>
            <th>Qtd</th>
            <th>Valor</th>
            <th>Ações</th>
        </thead>
      <tbody>
  ';
    if ($data->num_rows() > 0) {
      //$output .= '<button type="button" class="btn btn-primary btn-lg" id="' . $data[0]['id_veic'] . '">Add peças</button>';
      foreach ($data->result() as $row) {
        $output .= '
      <tr>
        <td>' . $row->descricao_pc . '</td>
        <td>' . $row->n_nota_pc . '</td>
        <td>' . $row->quantidade_pc . '</td>
        <td>' .'R$ '. number_format($row->valor_pc, 2, ',', '.'). '</td>
        <td>
          <button type="button" class="deletePecas btn btn-primary btn-sm" id="'.$row->id_pc.'">
            <i class="material-icons"> delete_forever </i>&nbsp;Deletar
          </button>
        </td>
      </tr>
    ';
      }
    } else {
      $output .= '
                <tr>
                  <td colspan="5" class="text-center">Sem registros de peças para esse veículo</td>
                </tr>';
    }
    $output .= '
                  </tbody>
                </table>';
    echo $output;
  }
  /**lista carro com historico de peças */
  public function get_carrosAddManutencaoPecas(int $id)
  {
    $data = $this->db->select('*')
      ->from('carro_para_manutencao')
      ->join('veiculos', 'veiculos.id_veic = carro_para_manutencao.fk_car_m')
      ->where('fk_car_m', $id)
      ->get();

    $output = array();
    foreach ($data->result() as $row) {
      $output['pc_placa'] = $row->placa_veic;
      $output['pc_marca'] = $row->marca_veic;
      $output['id_caro_manutencao'] = $row->id_car_m;
    }
    echo json_encode($output);
  }

  /**adiciona peças do carro many(muitas) dynamic */
  public function add_many_piecas()
  {
    
    $this->form_validation->set_rules('addmorepecaNome', 'Descrição da peça', 'required');
    $this->form_validation->set_rules('addmoreQuantidade', 'Quantidade', 'required|integer');
    $this->form_validation->set_rules('addmorePrecos', 'Preço', 'required|decimal');
    $this->form_validation->set_rules('id_car_pecas', 'Preço', 'required');
    $this->form_validation->set_rules('id_caro_manutencao', 'Preço', 'required');
    $this->form_validation->set_rules('addNotaCompras', 'Nº da nota', 'required');

    if ($this->form_validation->run() == FALSE) {
      $errors = validation_errors();
      echo json_encode(['error' => $errors]);
    } else {

      $data = array(
        'fk_car_pc' => $this->input->post('id_car_pecas'),
        'fk_manutencao_pc' => $this->input->post('id_caro_manutencao'),
        'descricao_pc' => $this->input->post('addmorepecaNome'),
        'quantidade_pc' => $this->input->post('addmoreQuantidade'),
        'valor_pc' => $this->input->post('addmorePrecos'),
        'n_nota_pc' => $this->input->post('addNotaCompras'),
    );

     $this->db->insert('pecas_manutencao_historicos', $data);

      echo json_encode(['success' => 'Peças adicionadas com sucesso.']);
    }
  }

  /**deleta peças */
  public function delete_pecas(int $id)
  {
    $this->db->delete('pecas_manutencao_historicos', array('id_pc' => $id));
    echo 'Item deletado com sucesso';
  }
}


/* End of file ManutencaoController.php */
