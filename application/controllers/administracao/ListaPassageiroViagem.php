<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ListaPassageiroViagem extends CI_Controller
{

    public function getPassageirosViagem_programada()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $query = $this->db->select('*')
            ->from('clientes_poltronas_carro_viagem')
            ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
            ->join('cliente_passageiro', 'cliente_passageiro.id_cl = clientes_poltronas_carro_viagem.fk_cliente_cpcv')
            ->join('veiculos', 'veiculos.id_veic = clientes_poltronas_carro_viagem.fk_carro_viagem_cpcv')
            ->get();


        $data = [];


        foreach ($query->result() as $r) {
            $data[] = array(

                date("d/m/Y", strtotime($r->data_saida_vc)),
                $r->fk_nome_ciente_cl,
                $r->placa_veic,
                $r->cliente_destino_cpcv,
                ($r->status_poltrona_cpcv == 0) ? '<span class="badge badge-danger">Vazia</span>' : (($r->status_poltrona_cpcv == 1) ? '<span class="badge badge-warning">Agendada</span>' : '<span class="badge badge-success">Ocupada</span>'),
                '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu">
                        <a href="#"  class="clienteAgendadaViagem dropdown-item" id="' . $r->id_cpcv . '">
                            <i class="material-icons"> how_to_reg </i>&nbsp;Cliente/Viagem
                        </a>
                        <a class="dropdown-item" href="' . site_url('ticket-cliente-viagem/' . $r->id_cpcv) . '" target="_blank">
                            <i class="material-icons"> receipt </i>&nbsp;Ticket
                        </a>
                        <a class="bagagemUsuario dropdown-item" href="#" id="' . $r->id_cpcv . '">
                            <i class="material-icons"> business_center </i>&nbsp;Bagagens
                        </a>
                    <div class="dropdown-divider"></div>
                        <a class="cancelaViagemPassageiro dropdown-item" href="#" id="' . $r->id_cpcv . '">
                            <i class="material-icons"> power_settings_new </i>&nbsp;Cancelar/Viagem
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

    /**cliente dados viagem */
    public function getClienteAgendadaViagem(int $id)
    {
        $output = array();
        $data = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
            ->from('clientes_poltronas_carro_viagem')
            ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
            ->join('cliente_passageiro', 'cliente_passageiro.id_cl = clientes_poltronas_carro_viagem.fk_cliente_cpcv')
            ->join('veiculos', 'veiculos.id_veic = clientes_poltronas_carro_viagem.fk_carro_viagem_cpcv')
            ->join('users_gestores', 'users_gestores.us_id = clientes_poltronas_carro_viagem.fk_agente_cpcv')
            ->join('agencias', 'agencias.id_ag = clientes_poltronas_carro_viagem.fk_agencia_cpcv')
            ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
            ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
            ->where('id_cpcv', $id)
            ->get()->result();
        foreach ($data as $row) {
            $output['cli_Viagem_cliente'] = $row->fk_nome_ciente_cl;
            $output['cli_Viagem_cidade_destino_carro'] = $row->my_city_sai;
            $output['cli_Viagem_cidade_chegada_carro'] = $row->my_city_ch;
            $output['cli_Viagem_cliente_saida'] = $row->cliente_saida_cpcv;
            $output['cli_Viagem_cliente_chegada'] = $row->cliente_destino_cpcv;
            $output['cli_Viagem_placa_carro'] = $row->placa_veic;
            $output['cli_Viagem_data_saida'] = date("d/m/Y", strtotime($row->data_saida_vc));
            $output['cli_Viagem_hora_saida'] = date("H:i", strtotime($row->hora_saida_vc));
            $output['cli_Viagem_agencia_cadastro'] = $row->nome_ag;
            $output['cli_Viagem_agencia_agente'] = $row->us_nome;
            $output['cli_Viagem_poltrona'] = $row->poltrona_carro_cpcv;
            $output['cli_Viagem_data_cadastro'] = date("d/m/Y H:i:s", strtotime($row->data_cadastro_cpcv));
            $output['cli_Viagem_poltrona_status'] = ($row->status_poltrona_cpcv == 0) ? 'Vazia' : (($row->status_poltrona_cpcv == 1) ? 'Agendada' : 'Ocupada');
            $output['cli_Viagem_observaçãoes'] = $row->observacao_cliente_cpcv;
        }
        echo json_encode($output);
    }

    /**adiciona bagagem */
    public function addBagagemUsuario()
    {
        $this->form_validation->set_rules('desc_bgg[]', 'Descrição da bagagem', 'required|max_length[100]');
        $this->form_validation->set_rules('cod_bgg[]', 'código da bagagem', 'required|max_length[30]|is_unique[bagagem_cliente_viagem.codigo_bagagem_cb]');
        $this->form_validation->set_rules('qtd_bgg[]', 'Quantidade', 'required|integer|max_length[5]');
        $this->form_validation->set_rules('valor_bgg[]', 'Valor', 'required|decimal|max_length[10]');
        $this->form_validation->set_rules('id_bgg', 'id da viagem', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $data = array();
            for ($i = 0; $i < count($this->input->post('desc_bgg')); $i++) {
                $data[] = array(
                    'descricao_bagagem_cb' => $this->input->post('desc_bgg')[$i],
                    'codigo_bagagem_cb' => $this->input->post('cod_bgg')[$i],
                    'fk_id_viagem_poltrona' => $this->input->post('id_bgg'),
                    'qtd_bagagem_cb' => $this->input->post('qtd_bgg')[$i],
                    'valor_bagagem_cb' => $this->input->post('valor_bgg')[$i],
                );
            }
            $this->db->insert_batch('bagagem_cliente_viagem', $data);
            echo json_encode(['success' => 'Bagagens adicionada com sucesso.']);
        }
    }

    /**lista bagagem do usuário */
    public function listaBagaensClienteViagem(int $id)
    {
        $output = '';

        $data = $this->db->select('*')
                        ->from('bagagem_cliente_viagem')
                        ->join('clientes_poltronas_carro_viagem', 'clientes_poltronas_carro_viagem.id_cpcv = bagagem_cliente_viagem.fk_id_viagem_poltrona')
                        ->where('id_cpcv', $id)
                        ->get();
        $output .= '
        <table class="table" id="lista_bagagem_viagem" style="width: 100%;">
        <thead class=" text-primary">
            <tr>
                <th>Quantidade</th>
                <th>Descrição</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Opção</th>
            </tr>
        </thead>
        <tbody>
  ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                    <tr>
                        <td>' . $row->qtd_bagagem_cb . '</td>
                        <td>' . $row->descricao_bagagem_cb . '</td>
                        <td>' . $row->codigo_bagagem_cb . '</td>
                        <td>R$ ' . number_format($row->valor_bagagem_cb, 2, ',', '.'). '</td>
                        <td>
                        <button class="del_bagagem btn btn-warning" id="'.$row->id_cb.'">
                            <i class="material-icons">warning</i> Deletar
                            <div class="ripple-container"></div>
                        </button>
                        </td>
                    </tr>
                    ';
            }
        } else {
            $output .= '<tr>
       <td colspan="5" class="text-center">Sem bagagem registrada no momento.</td>
      </tr>';
        }
        $output .= '</tbody>
            </table>';
        echo $output;
    }

    /**cancela viagem */
    public function cancelaClienteViagem(int $id)
    {
        $data = array(
            'embarcado_cpcv' => 'Não',
            'status_poltrona_cpcv' => '0',
            'valor_poltrona_cpcv' => '0,00',
        );

        $this->db->update('clientes_poltronas_carro_viagem', $data, array('id_cpcv' => $id));
        $this->deleteItensBagagem($id);
        echo 'Viagem cancelada com sucesso!';
    }

    /**deleta bagagem da viagem */
    public function deleteItensBagagem($id)
    {
       return $this->db->delete('bagagem_cliente_viagem', array('fk_id_viagem_poltrona' => $id));
    }

    /**deleta uma bagaem */
    public function deletaClienteViagemBagagem(int $id)
    {
        $this->db->delete('bagagem_cliente_viagem', array('id_cb' => $id));
        echo 'Bagagem deletada com sucesso!';
    }
}

/* End of file ListaPassageiroViagem.php */
