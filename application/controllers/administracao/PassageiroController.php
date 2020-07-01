<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PassageiroController extends CI_Controller {

    public function seleciona_cidadesDoEstado($id) { 
        $result = $this->db->where("estado",$id)->get("cidade")->result();
        echo json_encode($result);
    }

    public function addPassageiro()
    {
        $this->form_validation->set_rules('inputNomeCliente', 'NOME', 'required|is_unique[cliente_passageiro.fk_nome_ciente_cl]');
        $this->form_validation->set_rules('inputTelCliente', 'TELEFONE', 'required|exact_length[15]');
        $this->form_validation->set_rules('inputTelContato', 'TELEFONE DO CONTATO', 'required|exact_length[15]');
        $this->form_validation->set_rules('select_estados', 'ESTADO', 'required');
        $this->form_validation->set_rules('cidade_cliente', 'CIDADE', 'required');
        $this->form_validation->set_rules('inpuCliente_rg', 'RG', 'required|max_length[15]|integer|is_unique[cliente_passageiro.rg_cl]');
        $this->form_validation->set_rules('inputCliente_cf', 'CPF', 'required|exact_length[14]|is_unique[cliente_passageiro.cpf_cl]');
        $this->form_validation->set_rules('inputCliente_nc', 'DATA DE NASCIMENTO', 'required');
        $this->form_validation->set_rules('cliente_observe', 'OBSERVAÇÃO', 'min_length[10]|max_length[500]');
        $this->form_validation->set_rules('cliente_agente_id', 'AGENTE', 'required');
        $this->form_validation->set_rules('cliente_agencia_id', 'AGENCIA DO AGENTE', 'required');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $data = array(
                'fk_nome_ciente_cl'         => $this->input->post('inputNomeCliente', TRUE),
                'fk_usuario_agente_cl'      => $this->input->post('cliente_agente_id', TRUE),
                'fk_agencia_cl'             => $this->input->post('cliente_agencia_id', TRUE),
                'fk_cidade_cl'              => $this->input->post('cidade_cliente', TRUE),
                'fk_estado_cl'              => $this->input->post('select_estados', TRUE),
                'local_telefone_pessoal_cl' => $this->input->post('inputTelCliente', TRUE),
                'data_telefone_contato_cl'  => $this->input->post('inputTelContato', TRUE),
                'rg_cl'                     => $this->input->post('inpuCliente_rg', TRUE),
                'cpf_cl'                    => $this->input->post('inputCliente_cf', TRUE),
                'nascimento_cl'             => $this->input->post('inputCliente_nc', TRUE),
                'observacao_cl'             => $this->input->post('cliente_observe', TRUE),
            );
        
            $this->db->insert('cliente_passageiro', $data);
           echo json_encode(['success'=>'Cliente adicionado com sucesso.']);
        }
    }

    /**listadados dos clientes e consulta */
    public function get_todos_clientes()
    {
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));
 
       $query = $this->db->get("cliente_passageiro");
 
       $data = [];
 
       foreach($query->result() as $r) {
            $data[] = array(

                 $r->fk_nome_ciente_cl,
                 $r->local_telefone_pessoal_cl,
                 $r->data_telefone_contato_cl,
                 date("d//m/Y", strtotime($r->nascimento_cl)),
                 '<button type="button" class="viewCliente btn btn-primary btn-sm" id="'.$r->id_cl.'">
                    <i class="material-icons"> touch_app </i>&nbsp;Visualizar
                 </button>'
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

    /**dados do cliente */
    public function get_cliente(int $id)
    {
        $output = array();  
           $data = $this->db->select('*')
                            ->where('id_cl', $id)
                            ->get('cliente_passageiro')->result();
           foreach($data as $row)  
           {  
                $output['agCli_nome'] = $row->fk_nome_ciente_cl;  
                $output['agCli_cida'] = $row->fk_cidade_cl;   
                $output['agCli_esta'] = $row->fk_estado_cl;   
                $output['agCli_tel_p'] = $row->local_telefone_pessoal_cl;   
                $output['agCli_tele_c'] = $row->data_telefone_contato_cl;   
                $output['agCli_rg'] = $row->rg_cl;   
                $output['agCli_cpf'] = $row->cpf_cl;   
                $output['agCli_naci'] = $row->nascimento_cl;   
                $output['agCli_observ'] = $row->observacao_cl;   
           }  
           echo json_encode($output);
    }

    /**altera dados do passageiro */
    public function alteraDadosPassageiro(int $id)
    {
        $this->form_validation->set_rules('agCli_nome', 'NOME', 'required');
        $this->form_validation->set_rules('agCli_tel_p', 'TELEFONE', 'required|exact_length[15]');
        $this->form_validation->set_rules('agCli_tele_c', 'TELEFONE DO CONTATO', 'required|exact_length[15]');
        $this->form_validation->set_rules('agCli_esta', 'ESTADO', 'required');
        $this->form_validation->set_rules('agCli_cida', 'CIDADE', 'required');
        $this->form_validation->set_rules('agCli_rg', 'RG', 'required|max_length[15]');
        $this->form_validation->set_rules('agCli_cpf', 'CPF', 'required|exact_length[14]');
        $this->form_validation->set_rules('agCli_naci', 'DATA DE NASCIMENTO', 'required');
        $this->form_validation->set_rules('agCli_observ', 'OBSERVAÇÃO', 'min_length[10]|max_length[500]');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $data = array(
                'fk_nome_ciente_cl'         => $this->input->post('agCli_nome', TRUE),
                'fk_cidade_cl'              => $this->input->post('agCli_cida', TRUE),
                'fk_estado_cl'              => $this->input->post('agCli_esta', TRUE),
                'local_telefone_pessoal_cl' => $this->input->post('agCli_tel_p', TRUE),
                'data_telefone_contato_cl'  => $this->input->post('agCli_tele_c', TRUE),
                'rg_cl'                     => $this->input->post('agCli_rg', TRUE),
                'cpf_cl'                    => $this->input->post('agCli_cpf', TRUE),
                'nascimento_cl'             => $this->input->post('agCli_naci', TRUE),
                'observacao_cl'             => $this->input->post('agCli_observ', TRUE),
            );
            $this->db->update('cliente_passageiro', $data, array('id_cl' => $id));
           echo json_encode(['success'=>'Cliente adicionado com sucesso.']);
        }
    }

    /**tootal clientes */
    public function somaClientesTotal()
    {
        $query = $this->db->query('SELECT id_cl FROM cliente_passageiro');
        echo $query->num_rows();
    }
}

/* End of file PassageiroController.php */
