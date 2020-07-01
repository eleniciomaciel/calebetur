<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class E_ticketController extends CI_Controller {

    public function e_ticketViagem(int $id)
    {
        $data['dd_clinete'] = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
                        ->from('clientes_poltronas_carro_viagem')
                        ->join('veiculos', 'veiculos.id_veic = clientes_poltronas_carro_viagem.fk_carro_viagem_cpcv')
                        ->join('cliente_passageiro', 'cliente_passageiro.id_cl = clientes_poltronas_carro_viagem.fk_cliente_cpcv')
                        ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
                        ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
                        ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
                        ->join('users_gestores', 'users_gestores.us_id = clientes_poltronas_carro_viagem.fk_agente_cpcv')
                        ->join('agencias', 'agencias.id_ag = clientes_poltronas_carro_viagem.fk_agencia_cpcv')
                        ->where('id_cpcv', $id)
                        ->get()->result();

    $data['db_baganens'] = $this->db->select('*')
                                ->from('bagagem_cliente_viagem')
                                ->join('clientes_poltronas_carro_viagem', 'clientes_poltronas_carro_viagem.id_cpcv = bagagem_cliente_viagem.fk_id_viagem_poltrona')
                                ->where('fk_id_viagem_poltrona', $id)
                                ->get();

    $this->load->library('ciqrcode');
    $qr_image=rand().'.png';
    $params['data'] = site_url('ticket-cliente-viagem/'. $id);
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] =FCPATH."uploads/qr_image/".$qr_image;
    if($this->ciqrcode->generate($params))
    {
        $data['img_url']=$qr_image;	

    }
    $this->load->view('adm/relatorios/qr_code_cliente_viagem', $data);
    
    }

    /**ticket bagaem viagem */
    public function e_tickete_dados_encomenda($key)
    {
        $query['dd_encomendas'] = $this->db->select('*')
                ->from('encomenda_viagem')
                ->join('cliente_passageiro', 'cliente_passageiro.id_cl = encomenda_viagem.fk_id_cliente_enc')
                ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = encomenda_viagem.fk_id_carro_viagem_enc')
                ->where('key_produto_enc', $key)
                ->get()->result();

        $this->load->library('ciqrcode');
        $qr_image=rand().'.png';
        $params['data'] = site_url('e-ticket-dados-da-encomenda/'. $key);
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] =FCPATH."uploads/qr_image/".$qr_image;
        if($this->ciqrcode->generate($params))
        {
            $query['img_url_qd']=$qr_image;	
    
        }

        $this->load->view('adm/relatorios/qr_code_encomenda_viagem', $query);
    }

}

/* End of file E_ticketController.php */
