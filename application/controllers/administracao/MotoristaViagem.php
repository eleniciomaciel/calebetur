<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MotoristaViagem extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dynamic_model', 'dynamic_dependent_model');
    }

    public function index($id)
    {
        $converte_data = date("Y-m-d", strtotime($id));
        $this->db->select('*');
        $this->db->from('programacao_carro_viagem');
        $this->db->join('veiculos', 'veiculos.id_veic = programacao_carro_viagem.fk_carro_vc');
        $this->db->where('data_saida_vc', $converte_data);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }

    /**lista todos os motoristas */
    public function getAllMotorista()
    {

        $output = '';
        $data = $this->db->get_where('users_gestores', array('us_nivel' => 'Motorista'));
        $output .= '
        <select class="form-control" name="selectMyMotor" id="selectMyMotor">
            <option value="" selected disabled>Selecione aqui...</option>
        ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                    <option class="text-dark" value="' . $row->us_id . '">' . $row->us_nome . '</option>
            ';
            }
        }
        $output .= '</select>';
        echo $output;
    }

    /**selecione a chave da viagem */
    public function selectKey($key)
    {
        $converte_data = date("Y-m-d", strtotime($key));
        $this->db->select('*');
        $this->db->from('programacao_carro_viagem');
        $this->db->where('data_saida_vc', $converte_data);
        $result = $this->db->get()->result();
        echo json_encode($result);
    }

    /**seleciona a chave da viagem */
    public function addMotorNaViagem()
    {
        $this->form_validation->set_rules('selectDate', 'Data', 'required');
        $this->form_validation->set_rules('pl_car_trip', 'Placa', 'required');
        $this->form_validation->set_rules('selectMyMotor', 'Motorista', 'required');
        $this->form_validation->set_rules(
            'valor_key_tip',
            'chave da viagem',
            'required|is_unique[motorista_agenda_viagem.token_da_agenda_viagem_mtv]',
            array('is_unique' => 'Ops! Desculpe, mas essa viagem já foi agendada.')
        );
        $this->form_validation->set_rules('agenda_moto_obs', 'observação', 'min_length[5]|max_length[500]');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $this->dynamic_dependent_model->add_agenda_motor();
            echo json_encode(['success' => 'Agenda do motorista crida com sucesso.']);
        }
    }

    /**lista viagens agendadas */
    public function get_agendaViagensMotoristas()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
                                ->from('motorista_agenda_viagem')
                                ->join('users_gestores', 'users_gestores.us_id = motorista_agenda_viagem.fk_id_motorista_mtv')
                                ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = motorista_agenda_viagem.token_da_agenda_viagem_mtv')
                                ->join('veiculos', 'veiculos.id_veic = programacao_carro_viagem.fk_carro_vc')
                                ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
                                ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
                                ->get();
        
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                $r->us_nome,
                date("d/m/Y", strtotime($r->data_saida_vc)),
                $r->placa_veic,
                $r->my_city_sai,
                $r->my_city_ch,
                '<div class="dropdown show">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                    </a>
                
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="view_card_code_viagem_motor dropdown-item" href="'.site_url('lista-qrcode-viagem-motorista/').$r->id_mtv.'/'.$r->controle_key_vc.'"  target="_blank">
                        <i class="fa fa-qrcode"></i>&nbsp;QR Code viagem
                    </a>
                    <!--<a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>-->
                    <a class="deleteUserMotorNaViagem dropdown-item" href="#" id="'.$r->id_mtv.'">
                        <i class="fa fa-trash"></i>&nbsp;Deletar
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

    /**lista card */
    public function listaCardViagem($id, $key)
    {
        $query['dados_viagem'] = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
                                ->from('motorista_agenda_viagem')
                                ->join('users_gestores', 'users_gestores.us_id = motorista_agenda_viagem.fk_id_motorista_mtv')
                                ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = motorista_agenda_viagem.token_da_agenda_viagem_mtv')
                                ->join('veiculos', 'veiculos.id_veic = programacao_carro_viagem.fk_carro_vc')
                                ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
                                ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
                                ->where('id_mtv', $id)
                                ->get()->result();

        $this->load->library('ciqrcode');
        $qr_image = rand() . '.png';
        $params['data'] = site_url('car-viagem/' . $key);
        $params['level'] = 'H';
        $params['size'] = 8;
        $params['savename'] = FCPATH . "uploads/qr_image/" . $qr_image;
        if ($this->ciqrcode->generate($params)) {
            $query['img_url_qd'] = $qr_image;
        }
        $this->load->view('adm/relatorios/qr_code_agenda_viagem_motor', $query);
    }

    /**lista dados da viagem */
    public function CardViagem( $key)
    {
        $query['dados_viagem'] = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
                                    ->from('clientes_poltronas_carro_viagem')
                                    ->join('users_gestores', 'users_gestores.us_id = clientes_poltronas_carro_viagem.fk_agente_cpcv')
                                    ->join('veiculos', 'veiculos.id_veic = clientes_poltronas_carro_viagem.fk_carro_viagem_cpcv')
                                    ->join('cliente_passageiro', 'cliente_passageiro.id_cl = clientes_poltronas_carro_viagem.fk_cliente_cpcv')
                                    ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
                                    ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
                                    ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
                                    ->where('controle_key_vc', $key)
                                    ->order_by('poltrona_carro_cpcv', 'ASC')
                                    ->get()->result();

        $query['total_g'] = $this->db->select('COUNT(fk_cliente_cpcv) as total_users')
        ->from('clientes_poltronas_carro_viagem')
        ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
        ->where('controle_key_vc', $key)
        ->get()->result();

        $query['nome_motor'] = $this->db->select('*, my_motor.us_nome AS eu_dirijo')
        ->from('motorista_agenda_viagem')
        ->join('users_gestores as my_motor', 'my_motor.us_id = motorista_agenda_viagem.fk_id_motorista_mtv')
        ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = motorista_agenda_viagem.token_da_agenda_viagem_mtv')
        ->where('controle_key_vc', $key)
        ->get()->result();
        $this->load->view('adm/relatorios/card_agenda_viagem_motor', $query);
    }

    /**deleta motorista viagem */
    public function deletaMotoristaViagem(int $id)
    {
        $this->db->delete('motorista_agenda_viagem', array('id_mtv' => $id));
        echo 'Viagem do motorista deletada com sucesso!';
    }

    /**informações do passageiro na viagem */
    public function listaInformacoesPassageiros(int $id)
    {
        $output = array();  
        $data = $this->db->select('*')
                        ->from('clientes_poltronas_carro_viagem')
                        ->join('cliente_passageiro', 'cliente_passageiro.id_cl = clientes_poltronas_carro_viagem.fk_cliente_cpcv')
                        ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = clientes_poltronas_carro_viagem.fk_id_programacao_carro_viagem_cpcv')
                        ->join('agencias', 'agencias.id_ag = clientes_poltronas_carro_viagem.fk_agencia_cpcv')
                        ->where('id_cpcv', $id)
                        ->get();
        foreach($data->result() as $row)  
        {  
             $output['pas_nome'] = $row->fk_nome_ciente_cl;  
             $output['pass_tel'] = $row->data_telefone_contato_cl;  
             $output['pass_poltrona'] = $row->poltrona_carro_cpcv;  
             $output['pass_status_poltrona'] = $row->status_poltrona_cpcv == '2' ? 'Ocupada':'Reservada';  
             $output['pass_saida'] = $row->cliente_saida_cpcv;  
             $output['pass_destino'] = $row->cliente_destino_cpcv;  
             $output['pass_observacao'] = $row->observacao_cliente_cpcv;  
             $output['pass_ststuas_embarque'] = $row->embarcado_cpcv;  
             $output['pass_cpf'] = $row->cpf_cl;  
             $output['pass_rg'] = $row->rg_cl;  
             $output['pass_data_saida'] = date("d/m/Y", strtotime($row->data_saida_vc)).' '.date("H:i", strtotime($row->hora_saida_vc));  
             $output['pass_agencia'] = $row->nome_ag;      
        }  
        echo json_encode($output);  
    }
}

/* End of file MotoristaViagem.php */
