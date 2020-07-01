<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EncomendasController extends CI_Controller
{

    public function index(int $id)
    {
        $output = array();
        $data = $this->db->get_where('programacao_carro_viagem', array('id_vc' => $id));;
        foreach ($data->result() as $row) {
            $output['progran_key'] = $row->controle_key_vc;
            $output['progran_loc_s'] = $row->local_saida_vc;
            $output['progran_hora_sai'] = $row->hora_saida_vc;
            $output['progran_data_sai'] = $row->data_saida_vc;
        }
        echo json_encode($output);
    }

    /**busca cliente */
    public function searchCliente()
    {

        if (isset($_GET['term'])) {
            $result = $this->search_blog($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->cpf_cl;
                echo json_encode($arr_result);
            }
        }
    }

    public function search_blog($title)
    {
        $this->db->like('cpf_cl', $title, 'both');
        $this->db->order_by('cpf_cl', 'ASC');
        $this->db->limit(10);
        return $this->db->get('cliente_passageiro')->result();
    }

    public function dadosClienteComplete($var)
    {
        $result = $this->db->where("cpf_cl", $var)->get("cliente_passageiro")->result();
        echo json_encode($result);
    }

    /**envia dados encomenda */
    public function enviaEncomenda()
    {
        $this->form_validation->set_rules('user_cliente_encom', 'CLIENTE', 'required|max_length[100]');
        $this->form_validation->set_rules('destin_name', 'DESTINATÁRIO', 'required|max_length[100]');
        $this->form_validation->set_rules('destin_tel', 'TELEFONE DO DESTINATÁRIO', 'required|max_length[18]');
        $this->form_validation->set_rules('destin_rg', 'RG DO DESTINARTÁRIO', 'required|max_length[15]');
        $this->form_validation->set_rules('destin_loal_retirada', 'LOCAL DA RETIRADA', 'required|max_length[100]');
        $this->form_validation->set_rules('destin_observe', 'OBSERVAÇÃO', 'required');
        $this->form_validation->set_rules('id_encomenda', 'CARRO VIAGEM', 'required');
        $this->form_validation->set_rules('desc_encom[]', 'Descrição da bagagem', 'required|max_length[100]');
        $this->form_validation->set_rules('cod_encom[]', 'código da bagagem', 'required|max_length[30]|is_unique[encomenda_viagem.codigo_produto_enc]');
        $this->form_validation->set_rules('qtd_encom[]', 'Quantidade', 'required|integer|max_length[5]');
        $this->form_validation->set_rules('valor_encom[]', 'Quantidade', 'required|decimal|max_length[10]');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $data = array();
            $token = md5(uniqid(""));
            for ($i = 0; $i < count($this->input->post('desc_encom')); $i++) {
                $data[] = array(
                    'fk_id_carro_viagem_enc' => $this->input->post('id_encomenda'),
                    'fk_id_cliente_enc' => $this->input->post('user_cliente_encom'),
                    'remetente_nome_enc' => $this->input->post('destin_name'),
                    'remetente_telefone_enc' => $this->input->post('destin_tel'),
                    'remetente_rg_enc' => $this->input->post('destin_rg'),
                    'remetente_local_recebe_enc' => $this->input->post('destin_loal_retirada'),
                    'descricao_peca_enc' => $this->input->post('desc_encom')[$i],
                    'codigo_produto_enc' => $this->input->post('cod_encom')[$i],
                    'qtd_produto_enc' => $this->input->post('qtd_encom')[$i],
                    'valor_produto_enc' => $this->input->post('valor_encom')[$i],
                    'key_produto_enc' => $token,
                    'observacao_cliente_encomenda_enc' => $this->input->post('destin_observe'),

                );
            }
            $this->db->insert_batch('encomenda_viagem', $data);
            echo json_encode(['success' => 'Bagagens adicionada com sucesso.']);
        }
    }

    /**seleciona encomendas */
    public function listaEncomendasDaviagem($id)
    {
        $output = '';

        $data = $this->db->select('*')
                            ->from('encomenda_viagem')
                            ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = encomenda_viagem.fk_id_carro_viagem_enc')
                            ->join('cliente_passageiro', 'cliente_passageiro.id_cl = encomenda_viagem.fk_id_cliente_enc')
                            ->group_by("fk_id_cliente_enc")
                            ->where('id_vc', $id)
                            ->get();

        /**id do carro da viagem programada */
        $row_cv = $data->row();

        $output .= '
        <div class="table-responsive">';
        if (isset($row_cv->id_vc)) {
            $output .= '
            <a href="'.site_url('lista-encomendas-da-diagem/'.$row_cv->id_vc).'" class="id_rogranCarViagem btn btn-info btn-round"  target="_blank">
                <i class="material-icons"> local_printshop </i>&nbsp;Print encomendas
            </a>
           ';

        } 
        
        $output .= '
           <table class="table">
            <tr>
                <th>ID</th>
                <th>REMETENTE</th>
                <th>DESTINATÁRIO</th>
                <th>TELEFONE</th>
                <th>OPÇÕES</th>
            </tr>
        ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
            <tr>
             <td>'.$row->id_enc.'</td>
             <td>' . $row->fk_nome_ciente_cl . '</td>
             <td>' . $row->remetente_nome_enc . '</td>
             <td>' . $row->remetente_telefone_enc . '</td>
             <td>
             <div class="btn-group">
             <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Ações
             </button>
             <div class="dropdown-menu">
               <a class="viewEncomendaRemete dropdown-item" href="#" id="'.$row->key_produto_enc.'">
                    <i class="material-icons"> visibility </i>&nbsp;Visualizar
                </a>
               <a class="dropdown-item" href="'.site_url('e-ticket-bagagem/'.$row->key_produto_enc).'" target="_blank">
                    <i class="material-icons"> loyalty </i>&nbsp;E-ticket
                </a>
               <div class="dropdown-divider"></div>
               <a href="'.site_url('cliente-encomenda-imprimir/'.$row->key_produto_enc).'" class="dropdown-item" target="_blank">
                    <i class="material-icons"> local_printshop </i>&nbsp;Print
                </a>
             </div>
           </div>
             </td>
            </tr>
          ';
            }
        } else {
            $output .= '<tr>
             <td colspan="5">Sem encomenda cadastradas</td>
            </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    /**lista encomendas print viagem */
    public function listaEncomendasDaViagemCarroPrint(int $id)
    {
        $data['encomendas_list'] = $this->db->select('*, sai.nome AS my_city_sai, cheg.nome as my_city_ch')
                ->from('encomenda_viagem')
                ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = encomenda_viagem.fk_id_carro_viagem_enc')
                ->join('cliente_passageiro', 'cliente_passageiro.id_cl = encomenda_viagem.fk_id_cliente_enc')
                ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
                ->join('cidade as cheg', 'cheg.id = programacao_carro_viagem.fk_cidade_destino_vc')
                ->where('id_vc', $id)
                ->get()->result();

        $this->load->view('adm/relatorios/encomendasGeraisCarroViagem', $data);
        
    }

    /**lista encomendas do remetente */
    public function listaEncomendasRemetente($var)
    {
        $output = array();   
        

            $output = '';

            $data = $this->db->select('*')
                    ->from('encomenda_viagem')
                    ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = encomenda_viagem.fk_id_carro_viagem_enc')
                    ->join('cliente_passageiro', 'cliente_passageiro.id_cl = encomenda_viagem.fk_id_cliente_enc')
                    ->where('key_produto_enc', $var)
                    ->get();

            $row_cv = $data->row();
            $output .= '
            <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0; width:100%;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-cly1{text-align:left;vertical-align:middle}
            .tg .tg-ggg6{background-color:#ecf4ff;text-align:center;vertical-align:middle}
            .tg .tg-rgo3{background-color:#fffc9e;text-align:center;vertical-align:middle}
            .tg .tg-nrix{text-align:center;vertical-align:middle}
            .tg .tg-v4j2{font-weight:bold;background-color:#c0c0c0;text-align:center;vertical-align:middle}
            </style>
            <table class="tg">
            <tr>
                <th class="tg-ggg6" colspan="3"><span style="font-weight:bold">Remetente:</span> '.$row_cv->fk_nome_ciente_cl.'</th>
                <th class="tg-ggg6" colspan="3"><span style="font-weight:bold">Destinatário:</span>  '.$row_cv->remetente_nome_enc.'</th>
            </tr>
            <tr>
                <td class="tg-cly1"><span style="font-weight:bold">RG remetente:</span> '.$row_cv->remetente_rg_enc.'</td>
                <td class="tg-cly1" colspan="2"><span style="font-weight:bold">Local da retirada:</span> '.$row_cv->remetente_local_recebe_enc.'</td>
                <td class="tg-cly1" colspan="3"><span style="font-weight:bold">Telefone:</span> '.$row_cv->remetente_telefone_enc.'</td>
            </tr>
            <tr>
                <td class="tg-rgo3">Descrição:</td>
                <td class="tg-rgo3">Cód.:</td>
                <td class="tg-rgo3">Valor:</td>
                <td class="tg-rgo3">Qtd.:</td>
                <td class="tg-rgo3">Status.:</td>
                <td class="tg-rgo3">Ação:</td>
            </tr>
            ';
            if($data->num_rows() > 0)
            {
                    
                $valor_total = 0;
                $qtd_total = 0;
                foreach($data->result() as $row)
                {
                $output .= '
                <tr>
                <td class="tg-nrix">'.$row->descricao_peca_enc.'</td>
                <td class="tg-nrix">'.$row->codigo_produto_enc.'</td>
                <td class="tg-nrix">R$ '.number_format($row->valor_produto_enc, 2, ',', '.').'</td>
                <td class="tg-nrix">'.$row->qtd_produto_enc.'</td>
                <td class="tg-nrix">'
                .(($row->status_encomenda_enc == 0) ? '<span class="badge badge-primary">Aguardando</span>' :(($row->status_encomenda_enc == 1) ? '<span class="badge badge-info">Embarcado</span>' :(($row->status_encomenda_enc == 2) ? '<span class="badge badge-warning">No destino</span>' :(($row->status_encomenda_enc == 3) ? '<span class="badge badge-success">Entregue</span>' : "Off")))).
                '
                </td>
                <td class="tg-nrix">
                
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="viewStsProduct btn btn-info" title="Status da encomenda."  id="'.$row->id_enc.'">
                        <i class="material-icons"> settings </i>
                    </button>
                    <button type="button" class="delItemProduto btn btn-danger" title="Deletar encomenda." id="'.$row->id_enc.'">
                        <i class="material-icons"> delete_forever </i>
                    </button>
                </div>

                </td>
                </tr>
                ';
                $valor_total += $row->valor_produto_enc;
                $qtd_total += $row->qtd_produto_enc;
                }
            }
            else
            {
                $output .= '<tr>
                    <td colspan="5">No Data Found</td>
                </tr>';
            }
            $output .= '<tr>
            <td class="tg-v4j2" colspan="2">Total:</td>
            <td class="tg-v4j2" colspan="1">R$ '.number_format($valor_total, 2, ',', '.').'</td>
            <td class="tg-v4j2" colspan="3">Unidades: '.$qtd_total.'</td>
            </tr>
        </table>';
        echo $output;
    }

    /**deletando encomenda */
    public function deleteEncomendaCliente(int $id)
    {
        $this->db->delete('encomenda_viagem', array('id_enc' => $id));
        echo 'Encomenda deletada com sucesso!';
    }

    /**printa emcomendas */
    public function printEncoemdasUsuario($id)
    {
        $data['list_produto_usuario'] = $this->db->select('*')
                    ->from('encomenda_viagem')
                    ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = encomenda_viagem.fk_id_carro_viagem_enc')
                    ->join('cliente_passageiro', 'cliente_passageiro.id_cl = encomenda_viagem.fk_id_cliente_enc')
                    ->where('key_produto_enc', $id)
                    ->get()->result();

        $this->load->view('adm/relatorios/encomendasUsuario', $data);
    }

    /**status do produto encomenda */
    public function getStatus(int $id)
    {
        $output = array();   
           $data = $this->db->select('*')
                    ->from('encomenda_viagem')
                    ->where('id_enc', $id)
                    ->get()->result();
           foreach($data as $row)  
           {  
                $output['sts_product'] = $row->status_encomenda_enc;  
                $output['sts_codigo'] = $row->codigo_produto_enc;  
                $output['sts_descricao'] = $row->descricao_peca_enc;  
           }  
           echo json_encode($output);
    }

    /**muda o status */
    public function mudaStatus(int $id)
    {
        $data = array(  
            'status_encomenda_enc' => $this->input->post('sts_product'), 
       );  
       $this->db->update('encomenda_viagem', $data, array('id_enc' => $id)); 
       echo 'Status alteradao com sucesso!'; 
    }

    /**lista todas as encomenda consulta */
    public function get_encomendas()
    {
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));
 
       $query = $this->db->get("encomenda_viagem");
  
       $data = [];

       foreach($query->result() as $r) {
            $data[] = array(
                 $r->descricao_peca_enc,
                 $r->codigo_produto_enc,
                 (($r->status_encomenda_enc == 0) ? '<span class="badge badge-primary">Aguardando</span>' :(($r->status_encomenda_enc == 1) ? '<span class="badge badge-info">Embarcado</span>' :(($r->status_encomenda_enc == 2) ? '<span class="badge badge-warning">No destino</span>' :(($r->status_encomenda_enc == 3) ? '<span class="badge badge-success">Entregue</span>' : "Off")))),
                 $r->remetente_nome_enc,
                 date("d/m/Y", strtotime($r->data_cadastro_enc)),
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

    /**tootal clientes */
    public function somaEncomendasTotal()
    {
        $query = $this->db->query('SELECT id_enc FROM encomenda_viagem');
        echo $query->num_rows();
    }
}

/* End of file EncomendasController.php */
