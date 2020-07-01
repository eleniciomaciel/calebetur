<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CarroViagemController extends CI_Controller
{
    
    public function selecCarros()
    {
        $result = $this->db->get("veiculos")->result();
        echo json_encode($result);
    }

    public function selecCidades()
    {
        $this->db->select('*');
        $this->db->from('localidades');
        $this->db->join('cidade', 'cidade.id = localidades.cidade_loc');
        $result = $query = $this->db->get()->result();
        echo json_encode($result);
    }

    public function carroAgendaViagem()
    {
        $this->form_validation->set_rules('select_veiculo', 'CARRO', 'required|callback_unique_viagem');
        $this->form_validation->set_rules('select_cidades_saidas', 'SAÍDA', 'required');
        $this->form_validation->set_rules('select_cidades_destino', 'DESTINO', 'required|callback_check_equal_less[' . $this->input->post('select_cidades_saidas') . ']');
        $this->form_validation->set_rules('car_viag_local', 'LOCAL', 'required');
        $this->form_validation->set_rules('car_viag_data', 'DATA', 'required');
        $this->form_validation->set_rules('car_viag_hora_saida', 'HORA', 'required');
        $this->form_validation->set_rules('car_viag_observe', 'obervação da viagem', 'min_length[10]|max_length[500]');
        if ($this->form_validation->run()) {

            $transationID = $this->generate_uuid();

            $data = array(
                'fk_carro_vc'           => $this->input->post('select_veiculo', TRUE),
                'fk_usuario_agente_vc'  => $this->input->post('agente_id', TRUE),
                'fk_agencia_vc'         => $this->input->post('agencia_id', TRUE),
                'fk_cidade_vc'          => $this->input->post('select_cidades_saidas', TRUE),
                'fk_cidade_destino_vc'  => $this->input->post('select_cidades_destino', TRUE),
                'local_saida_vc'        => $this->input->post('car_viag_local', TRUE),
                'data_saida_vc'         => $this->input->post('car_viag_data', TRUE),
                'hora_saida_vc'         => $this->input->post('car_viag_hora_saida', TRUE),
                'controle_key_vc'       => $transationID,
                'observacao_vc'         => $this->input->post('car_viag_observe', TRUE)
            );

            $carro = $this->input->post('select_veiculo', TRUE);
            $agente = $this->input->post('fk_usuario_agente_vc', TRUE);
            $agencia = $this->input->post('fk_agencia_vc', TRUE);

            $this->db->insert('programacao_carro_viagem', $data);
            $this->geraPoltronasDaViagem($carro, $agente, $agencia);
            $array = array(
                'success' => 'Viagem agendada com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'select_veiculo_error' => form_error('select_veiculo'),
                'select_cidades_saidas_error' => form_error('select_cidades_saidas'),
                'select_cidades_destino_error' => form_error('select_cidades_destino'),
                'car_viag_local_error' => form_error('car_viag_local'),
                'car_viag_data_error' => form_error('car_viag_data'),
                'car_viag_hora_saida_error' => form_error('car_viag_hora_saida'),
                'car_viag_observe_error' => form_error('car_viag_observe'),
            );
        }

        echo json_encode($array);
    }

    /**gera código randonico alfabeto */
    public function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
    
    }
    /**gera poltronas data viagem */
        
    public function geraPoltronasDaViagem($id, $agente, $agencia)
    {
        $query = $this->db->query('SELECT MAX(id_vc) as maximo_id FROM programacao_carro_viagem WHERE fk_carro_vc = "'.$id.'"');
        $row = $query->row();

        for ($i=0; $i <= 50; $i++) 
        {   
            $data[$i]['fk_carro_viagem_cpcv'] = $id;
            $data[$i]['fk_id_programacao_carro_viagem_cpcv'] = $row->maximo_id;
            $data[$i]['fk_agente_cpcv'] = $agente;
            $data[$i]['fk_agencia_cpcv'] = $agencia;
            $data[$i]['poltrona_carro_cpcv'] = $i;
            $data[$i]['status_poltrona_cpcv'] = '0';
        }
         
         $this->db->insert_batch('clientes_poltronas_carro_viagem', $data); 
    }
    /**verificando se estão indo duas cidades iguais */
    public function check_equal_less($second_field, $first_field)
    {
        if ($second_field == $first_field) {
            $this->form_validation->set_message('check_equal_less', 'As cidades estão iguais.');
            return false;
        }
        return true;
    }

    /**verificando se dois capos já foram cadastrados iguais ex.: carro e datas */
    public function unique_viagem()
    {
        $firstname = $this->input->post('select_veiculo');
        $lastname = $this->input->post('car_viag_data');

        $check = $this->db->get_where('programacao_carro_viagem', array('fk_carro_vc' => $firstname, 'data_saida_vc' => $lastname), 1);

        if ($check->num_rows() > 0) {
            $this->form_validation->set_message('unique_viagem', 'Há uma viagem marcada para essa data com este carro.');
            return FALSE;
        }
        return TRUE;
    }

    /**lista carros marcado para viagem */
    public function getCarroViagemProgramacao()
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
                $r->local_saida_vc,
                '<div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Ações
                </button>
                <div class="dropdown-menu">
                    <a class="viewProgramCarViagem dropdown-item" href="#" id="'.$r->id_vc.'">
                        <i class="material-icons"> touch_app </i>&nbsp;Visualizar
                    </a>
                  <div class="dropdown-divider"></div>
                  <a class="addEncomendasDaViagem dropdown-item" href="#" id="'.$r->id_vc.'">
                        <i class="material-icons"> category </i>&nbsp;Encomendas
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

    /**visualiza dados viagem do carro */
    public function viewCarProgramViagem(int $id)
    {
        $output = array();  
           $data = $this->db->get_where('programacao_carro_viagem', array('id_vc' => $id)); 

           foreach($data->result() as $row)  
           {  
                $output['progrm_car_fk_carro']      = $row->fk_carro_vc;  
                $output['progrm_car_fk_agente']     = $row->fk_usuario_agente_vc;  
                $output['progrm_car_agencia']       = $row->fk_agencia_vc;  
                $output['progrm_car_fk_cidade_s']   = $row->fk_cidade_vc;  
                $output['progrm_car_fk_cidades_d']  = $row->fk_cidade_destino_vc;  
                $output['progrm_car_local_saida']   = $row->local_saida_vc;  
                $output['progrm_car_data_saida']    = $row->data_saida_vc;  
                $output['progrm_car_hora_saida']    = $row->hora_saida_vc;  
                $output['progrm_car_observacao']    = $row->observacao_vc;  
           }  
           echo json_encode($output); 
    }

    /**altera dados viagem do carro */
    public function alteraDadosViagem_car(int $id)
    {
        $this->form_validation->set_rules('progrm_car_fk_carro', 'carro da viagem', 'required');
        $this->form_validation->set_rules('progrm_car_fk_cidade_s', 'cidade de saída', 'required');
        $this->form_validation->set_rules('progrm_car_fk_cidades_d', 'Cidade destino', 'required');
        $this->form_validation->set_rules('progrm_car_local_saida', 'local da saída', 'required');
        $this->form_validation->set_rules('progrm_car_data_saida', 'data saída', 'required');
        $this->form_validation->set_rules('progrm_car_hora_saida', 'Hora saída', 'required');
        $this->form_validation->set_rules('progrm_car_observacao', 'Observação', 'required');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $data = array(
                'fk_carro_vc'           => $this->input->post('progrm_car_fk_carro', TRUE),
                'fk_cidade_vc'          => $this->input->post('progrm_car_fk_cidade_s', TRUE),
                'fk_cidade_destino_vc'  => $this->input->post('progrm_car_fk_cidades_d', TRUE),
                'local_saida_vc'        => $this->input->post('progrm_car_local_saida', TRUE),
                'data_saida_vc'         => $this->input->post('progrm_car_data_saida', TRUE),
                'hora_saida_vc'         => $this->input->post('progrm_car_hora_saida', TRUE),
                'observacao_vc'         => $this->input->post('progrm_car_observacao', TRUE)
            );

            $this->db->update('programacao_carro_viagem', $data, array('id_vc' => $id));
           echo json_encode(['success'=>'Dados da viagem do carro alterado com sucesso.']);
        }
    }

    /**seleciona cadeiras do carro */
    public function selectDadosCadeiraViagem(int $id)
    {
        $output = '';
        $query = '';

        if($this->input->post('query'))
        {
         $query = $this->input->post('query');
        }
        $data = $this->db->select('*')
                            ->from('clientes_poltronas_carro_viagem')
                            ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
                            ->where('id_vc', $id)
                            ->order_by('poltrona_carro_cpcv', 'ASC')
                            ->get();

                            $output .= '
                            <div clas=""row-fuid>
  ';
        if($data->num_rows() > 0)
        {
        $contador =0;
         foreach($data->result() as $row)
         {
            $contador ++;
             if ($contador % 4 == 0) {

                $output .= '
                        
                        <button type="button" class="viewPoltronaViagem btn btn-primary" id="'.$row->id_cpcv.'">
                            <i class="material-icons"> event_seat </i>';
                    if ($row->status_poltrona_cpcv == 0) {
                        $output .= ' 
                        <span class="badge badge-danger">'.$row->poltrona_carro_cpcv.'</span>
                        ';
                    }elseif($row->status_poltrona_cpcv == 1){
                        $output .= ' 
                        <span class="badge badge-warning">'.$row->poltrona_carro_cpcv.'</span>
                        ';
                    } else {
                        $output .= ' 
                        <span class="badge badge-success">'.$row->poltrona_carro_cpcv.'</span>
                        ';
                    }
                    $output .= ' 

                        </button><br>';
             } else {
                $output .= '
                        <button type="button" class="viewPoltronaViagem btn btn-primary" id="'.$row->id_cpcv.'">
                        <i class="material-icons"> event_seat </i>';
                        if ($row->status_poltrona_cpcv == 0) {
                            $output .= ' 
                            <span class="badge badge-danger">'.$row->poltrona_carro_cpcv.'</span>
                            ';
                        }elseif($row->status_poltrona_cpcv == 1){
                            $output .= ' 
                            <span class="badge badge-warning">'.$row->poltrona_carro_cpcv.'</span>
                            ';
                        } else {
                            $output .= ' 
                            <span class="badge badge-success">'.$row->poltrona_carro_cpcv.'</span>
                            ';
                        }
                        $output .= ' 
    
                            </button>
              ';
             }
         }
        }
        $output .= '
        </div>
';
        echo $output;
    }

    /**lista tabela ajax */
    public function selectPoltronaCarViagem(int $id){
        $output = array();   
           $data = $this->db->select('*')
                        ->from('clientes_poltronas_carro_viagem')
                        ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
                        ->where('id_cpcv', $id)
                        ->get();
           foreach($data->result() as $row)  
           {  
                $output['polt_car_v_cliente']      = $row->fk_cliente_cpcv;  
                $output['polt_car_v_vendedor']      = $row->nome_vendedor_cliente_cpcv;  
                $output['polt_car_v_poltrona']      = $row->poltrona_carro_cpcv;  
                $output['polt_car_v_status_p']      = $row->status_poltrona_cpcv;   
                $output['polt_car_v_type_pay']      = $row->tipo_pagamento_cpcv;   
                $output['polt_car_v_parcelas']      = $row->parcelas_cpcv;   
                $output['polt_car_v_local_sa']      = $row->cliente_saida_cpcv;   
                $output['polt_car_v_local_destino'] = $row->cliente_destino_cpcv;   
                $output['polt_car_v_observacao']    = $row->observacao_cliente_cpcv;   
                $output['polt_car_v_calor']    = $row->valor_poltrona_cpcv;   
           }  
           echo json_encode($output); 
    }

    /**busca cliente cadastrado */
    public function addUserPoltronaCar()
    {
        $this->form_validation->set_rules('polt_car_v_cliente', 'Passageiro', 'required');
        $this->form_validation->set_rules('polt_car_v_vendedor', 'Vendedor externo', 'max_length[50]');
        $this->form_validation->set_rules('polt_car_v_status_p', 'Status', 'required');
        $this->form_validation->set_rules('polt_car_v_type_pay', 'Tipo de pagamento', 'required');
        $this->form_validation->set_rules('polt_car_v_parcelas', 'Parcelas', 'required');
        $this->form_validation->set_rules('polt_car_v_valor', 'Valor da passagem', 'required|decimal',
        array('decimal' => 'O %s dever conter algo como 150.99')
        );
        $this->form_validation->set_rules('polt_car_v_local_sa', 'Local de saída', 'required|max_length[100]');
        $this->form_validation->set_rules('polt_car_v_local_destino', 'Local de destino', 'required|max_length[100]');
        $this->form_validation->set_rules('polt_car_v_observacao', 'Observações', 'min_length[10]|max_length[200]');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $id = $this->input->post('id_pot', TRUE);
            $data = array(
                
                'fk_cliente_cpcv' => $this->input->post('polt_car_v_cliente', TRUE),
                'nome_vendedor_cliente_cpcv' => $this->input->post('polt_car_v_vendedor', TRUE),
                'fk_agente_cpcv' => $this->input->post('polt_car_v_id_agente', TRUE),
                'fk_agencia_cpcv' => $this->input->post('polt_car_v_id_agencia', TRUE),
                'status_poltrona_cpcv' => $this->input->post('polt_car_v_status_p', TRUE),
                'tipo_pagamento_cpcv' => $this->input->post('polt_car_v_type_pay', TRUE),
                'parcelas_cpcv' => $this->input->post('polt_car_v_parcelas', TRUE),
                'cliente_saida_cpcv' => $this->input->post('polt_car_v_local_sa', TRUE),
                'cliente_destino_cpcv' => $this->input->post('polt_car_v_local_destino', TRUE),
                'observacao_cliente_cpcv' => $this->input->post('polt_car_v_observacao', TRUE),
                'valor_poltrona_cpcv' => $this->input->post('polt_car_v_valor', TRUE),
            );
        
            $this->db->update('clientes_poltronas_carro_viagem', $data, array('id_cpcv' => $id));
           echo json_encode(['success'=>'Cliente adicionado com sucesso.']);
        }

    }

    /**seleciona usuarios clientes */
    public function clientes()
    {
        $this->db->select('*');
        $this->db->from('cliente_passageiro');
        $result = $query = $this->db->get()->result();
        echo json_encode($result);
    }

    /**gera ticket cliente */
    public function ticket_cliente_viagem(int $id)
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
                        ->where('id_cl', $id)
                        ->get()->result();

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

    /**somando todas as viagens realizadas */
    public function somaViagens()
    {
        $query = $this->db->query('SELECT id_vc FROM programacao_carro_viagem');
        echo $query->num_rows();
    }

}

/* End of file CarroViagemController.php */
