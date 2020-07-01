<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RelatorioViagem extends CI_Controller {

    /**lista carros marcado para viagem */
    public function listaRelatorioCarroViagem()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->select('*,s.nome as cidade_s, d.nome as cidade_d')
                        ->from('programacao_carro_viagem as p')
                        ->join('veiculos', 'veiculos.id_veic = p.fk_carro_vc')
                        ->join('cidade as s', 's.id = p.fk_cidade_vc')
                        ->join('cidade as d', 'd.id = p.fk_cidade_destino_vc')
                        ->get();
        
        $data = [];

        foreach ($query->result() as $r) {

            $data[] = array(

                date("d/m/Y", strtotime($r->data_saida_vc)),
                date("H:i", strtotime($r->hora_saida_vc)),
                $r->placa_veic,
                $r->cidade_s,
                $r->cidade_d,
                $r->controle_key_vc,
                '<a href="'.site_url('visualiza-itinerario/'.$r->id_vc).'" target="_blank" class="viewProgramCarViagem btn btn-info btn-sm">
                    <i class="material-icons"> insert_drive_file </i>&nbsp;Visualizar
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

    /**clientes poltronas carro etinerario */
    public function itinerarioCarroClientes(int $id)
    {
        $data['dados_viagem'] = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
            ->from('clientes_poltronas_carro_viagem')
            ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
            ->join('cliente_passageiro', 'cliente_passageiro.id_cl = clientes_poltronas_carro_viagem.fk_cliente_cpcv')
            ->join('veiculos', 'veiculos.id_veic = clientes_poltronas_carro_viagem.fk_carro_viagem_cpcv')
            ->join('users_gestores', 'users_gestores.us_id = clientes_poltronas_carro_viagem.fk_agente_cpcv')
            ->join('agencias', 'agencias.id_ag = clientes_poltronas_carro_viagem.fk_agencia_cpcv')
            ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
            ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
            ->where('id_vc', $id)
            ->get()->result();

        $this->load->view('adm/relatorios/clientesViagens', $data);
        
    }

}

/* End of file RelatorioViagem.php */
