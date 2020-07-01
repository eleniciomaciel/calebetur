<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

    public function myformAjax($id) { 
        $result = $this->db->where("estado",$id)->get("cidade")->result();
        echo json_encode($result);
    }

    /**cadastra usuarios */
    public function cadastraUsuarios()
    {
        $this->form_validation->set_rules('ges_nome', 'NOME DO USUÁRIO', 'required|max_length[100]');
        $this->form_validation->set_rules('user_agencias', 'AGÊNCIA', 'required');
        $this->form_validation->set_rules('ges_telefone', 'TELEFONE', 'required|max_length[16]');
        $this->form_validation->set_rules('ges_email', 'EMAIL PESSOAL', 'required|valid_email|is_unique[users_gestores.us_email]');
        $this->form_validation->set_rules('ges_nivel', 'NÍVEL DO USUÁRIO', 'required');
        $this->form_validation->set_rules('selectUf', 'UF', 'required');
        $this->form_validation->set_rules('city', 'CIDADE', 'required');
        $this->form_validation->set_rules('ges_endereco', 'ENDEREÇO', 'required|max_length[100]');

        $this->form_validation->set_rules('mt_num_cnh', 'NÚMERO DA CNH', 'max_length[30]');
        $this->form_validation->set_rules('mt_categoria_cnh', 'CATEGORIA', 'in_list[A,AB,B,C,D,E]');
        $this->form_validation->set_rules('mt_rg_motor', 'RG DO MOTORISTA', 'max_length[20]');
        $this->form_validation->set_rules('mt_cpf_motor', 'CPF DO MOTORISTA', 'max_length[15]');
        $this->form_validation->set_rules('mt_tel_motor', 'TELEFENE DE EMERGÊNCIA', 'max_length[15]');
        $this->form_validation->set_rules('mt_banco', 'BANCO', 'max_length[50]');
        $this->form_validation->set_rules('mt_tipo_conta', 'TIPO DE CONTA', 'in_list[CC,CP,CE,CD,CU]');
        $this->form_validation->set_rules('mt_nome_conta', 'NOME DA CONTA', 'max_length[50]');
        $this->form_validation->set_rules('mt_numero_conta', 'NÚMERO DA CONTA', 'max_length[30]');
        $this->form_validation->set_rules('mt_conta_op', 'OPERAÇÃO DA CONTA', 'max_length[5]');
        $this->form_validation->set_rules('mt_num_banco', 'NÚMERO DO BANCO', 'max_length[30]');
        $this->form_validation->set_rules('mt_observe', 'OBSERVAÇÃO', 'max_length[250]');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $this->Usuarios_model->get_set_usuarios();
           echo json_encode(['success'=>'Usuário cadastrado com sucesso.']);
        }
    }

    /**validação de data */
    public function date_valid($date)
    {
      $parts = explode("/", $date);
      if (count($parts) == 3) {      
        if (checkdate($parts[1], $parts[0], $parts[2]))
        {
          return TRUE;
        }
      }
      $this->form_validation->set_message('date_valid', 'O campo Data da CNH deve conter uma data válida, assim mm/dd/aaaa');
      return false;
    }
    /**lista usuarios cadastrados */
    public function get_all_usuarios()
   {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      //$query = $this->db->get("users_gestores");
      $query = $this->db->get_where('users_gestores', array('us_nivel !=' => 'Motorista'));

      $data = [];


      foreach($query->result() as $r) {
           $data[] = array(
                $r->us_nome,
                $r->us_telefone,
                $r->us_email,
                $r->us_nivel,
                $r->us_status == 0 ? '<a href="#" class="badge badge-danger"><i class="material-icons"> lock </i>&nbsp;Negado</a>':'<a href="#" class="badge badge-success"><i class="material-icons"> lock_open </i>&nbsp;Ativo</a>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons"> touch_app </i>&nbsp;Ações
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="view_gesto_user dropdown-item" id="'.$r->us_id.'">
                            <i class="material-icons"> visibility </i>&nbsp;Visualizar
                        </a>
                        <a href="#" class="auth_view dropdown-item" id="'.$r->us_id.'">
                            <i class="material-icons"> phonelink_lock </i>&nbsp;Autenticação
                        </a><!-- //permissões crud -->
                        <a href="#" class="access_user dropdown-item" id="'.$r->us_id.'">
                            <i class="material-icons"> verified_user </i>&nbsp;Permissão
                        </a><!-- //ativo ou inativo -->
                        <a href="#" class="viewPanel_login dropdown-item" id="'.$r->us_id.'">
                            <i class="material-icons"> screen_lock_portrait </i>&nbsp;Acesso
                        </a><!-- //login -->
                        <div class="dropdown-divider"></div>
                        <a href="#" class="deleteUser dropdown-item" id="'.$r->us_id.'">
                            <i class="material-icons"> power_settings_new </i>&nbsp;Deletar
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

   /**visualiza dado do usuario */
   public function get_dados_usuario(int $id)
   {
    $output = array();   
    $data = $this->Usuarios_model->get_set_usuarios($id); 
    foreach($data as $row)  
    {  
         $output['user_nome'] = $row->us_nome;  
         $output['user_tel'] = $row->us_telefone;   
         $output['user_email'] = $row->us_email;   
         $output['user_endereco'] = $row->us_endereco;   
         $output['user_cidade'] = $row->us_cidade;   
         $output['user_estado'] = $row->us_estado;   
         $output['user_nivel'] = $row->us_nivel;   
         $output['user_status'] = $row->us_status;   
         $output['user_login'] = $row->us_login;   
    }  
    echo json_encode($output); 
   }

   /**altera dados do usuario */
   public function altera_dados_usuario(int $id)
   {
    $this->form_validation->set_rules('user_nome', 'NOME DO USUÁRIO', 'required|max_length[100]');
    $this->form_validation->set_rules('user_tel', 'TELEFONE', 'required|max_length[16]');
    $this->form_validation->set_rules('user_email', 'EMAIL PESSOAL', 'required|valid_email');
    $this->form_validation->set_rules('user_nivel', 'NÍVEL DO USUÁRIO', 'required');
    $this->form_validation->set_rules('user_estado', 'UF', 'required');
    $this->form_validation->set_rules('user_cidade', 'CIDADE', 'required');
    $this->form_validation->set_rules('user_endereco', 'ENDEREÇO', 'required|max_length[100]');


    if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        echo json_encode(['error'=>$errors]);
    }else{
        $data = array(
            'us_nome' => $this->input->post('user_nome'),
            'us_telefone' => $this->input->post('user_tel'),
            'us_email' => $this->input->post('user_email'),
            'us_endereco' => $this->input->post('user_endereco'),
            'us_cidade' => $this->input->post('user_cidade'),
            'us_estado' => $this->input->post('user_estado'),
            'us_nivel' => $this->input->post('user_nivel')
        );
    
        $this->db->update('users_gestores', $data, array('us_id' => $id));
       echo json_encode(['success'=>'Usuário alterado com sucesso.']);
    }
   }

    /**status do acesso */
    public function status_permissao_acesso(int $id)
    {
        $sts = $this->input->post('customSwitch1');
        if ($sts == TRUE) {
            $valor = '1';
            $data = array(
            'us_status' => $valor
        );

        $this->db->update('users_gestores', $data, array('us_id' => $id));
        } else {
            $valor2 = '0';
            $data = array(
            'us_status' => $valor2
        );

        $this->db->update('users_gestores', $data, array('us_id' => $id));
        }
        echo json_encode(['success' => 'Usuário alterado com sucesso.']);
    }

    public function salvaAcesso(int $id)
    {
        $this->form_validation->set_rules('user_log_login', 'Loguin', 'required|valid_email|max_length[60]|is_unique[users_gestores.us_login]');
        $this->form_validation->set_rules('user_log_pw', 'Address', 'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
        array('regex_match' => 'A senha deve conter pelo menos um número e uma letra maiúscula e minúscula, no mínimo 8 até 10 caracteres e um ou mais caracter especial #$^+=!*()@%&.'));
        $this->form_validation->set_rules('loguin_id', 'ID', 'required');

        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $data = array(
                'us_login' => $this->input->post('user_log_login', TRUE),
                'us_senha' => md5($this->input->post('user_log_pw', TRUE)),
            );
        
            $this->db->update('users_gestores', $data, array('us_id' => $id));
           echo json_encode(['success'=>'Dados de acesso gerado com sucesso.']);
        }
    }

    /**delete usuario */
    public function deleteUser(int $id)
    {
        $this->db->delete('users_gestores', array('us_id' => $id));
        echo 'Usuário deletado com sucesso!';
    }

    /**soma todos os usurios */
    public function somaTodosUsuarios()
    {
        $query = $this->db->query('SELECT COUNT(us_id) AS total_usuarios FROM users_gestores');
        $row = $query->row();
        echo $row->total_usuarios;
    }

    /**lista motorista */
    public function listaUsuariosMotorista()
    {
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));
 
       $query = $this->db->get_where('users_gestores', array('us_nivel' => 'Motorista'));
       $data = [];
 
 
       foreach($query->result() as $r) {
            $data[] = array(
                 date("d/m/Y", strtotime($r->us_data_validade)),
                 $r->us_nome,
                 $r->us_categoria,
                 $r->us_tel_emergencia,
                 '<!-- Example single info button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opções
                    </button>
                    <div class="dropdown-menu">
                        <a class="viewMotorUser dropdown-item" href="#" id="'.$r->us_id.'">
                            <i class="material-icons"> visibility </i>&nbsp;Alterar
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="material-icons"> delete_forever </i>&nbsp;Deletar
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
 
    /**lista dado do único motorista */
    public function listaUsuariosMotoristaUm(int $id)
    {
        $output = array();  
        $data = $this->db->select('*, cid.nome as city, stat.nome as uf')
                        ->from('users_gestores')
                        ->join('cidade as cid', 'cid.id = users_gestores.us_cidade')
                        ->join('estado as stat', 'stat.id = users_gestores.us_estado')
                        ->join('agencias', 'agencias.id_ag = users_gestores.us_agencia_fk')
                        ->where('us_id', $id)
                        ->get()->result();

        foreach($data as $row)  
        {  
             $output['drive_nome'] = $row->us_nome;  
             $output['drive_tele'] = $row->us_telefone;  
             $output['drive_emai'] = $row->us_email;  
             $output['drive_ende'] = $row->us_endereco;  
             $output['drive_cida'] = $row->city;  
             $output['drive_ufes'] = $row->uf;  
             $output['drive_agen'] = $row->nome_ag;  
             $output['drive_nive'] = $row->us_nivel;  
             $output['drive_telm'] = $row->us_tel_emergencia;  
             $output['drive_cnhh'] = $row->us_cnh;  
             $output['drive_dtvl'] = $row->us_data_validade;  
             $output['drive_catg'] = $row->us_categoria;  
             $output['drive_rggg'] = $row->us_rg;  
             $output['drive_cpff'] = $row->us_cpf;  
             $output['drive_baco'] = $row->us_banco; 

             $output['drive_nocont'] = $row->us_nome_conta;  
             $output['drive_tip_cont'] = $row->us_tipo_conta;  
             $output['drive_nunco'] = $row->us_numero_conta;  
             $output['drive_contop'] = $row->us_opraracao_conta;  
             $output['drive_nomeb'] = $row->us_numero_banco;  
             $output['drive_obser'] = $row->us_observer_motor;  
        }  
        echo json_encode($output); 
    }

    /**altera dados do motorista */
    public function alteraUsuarioMotorista(int $id)
    {
        $this->form_validation->set_rules('drive_nome', 'nome do motorista', 'required');
        $this->form_validation->set_rules('drive_emai', 'email', 'required|valid_email');
        $this->form_validation->set_rules('drive_tele', 'telefone', 'required');
        $this->form_validation->set_rules('drive_ende', 'endereço', 'required');
        $this->form_validation->set_rules('drive_telm', 'telefone', 'required');
        $this->form_validation->set_rules('drive_cnhh', 'cnh', 'required');
        $this->form_validation->set_rules('drive_dtvl', 'data de validade cnh', 'required');
        $this->form_validation->set_rules('drive_catg', 'categoria', 'required');
        $this->form_validation->set_rules('drive_rggg', 'rg', 'required');
        $this->form_validation->set_rules('drive_cpff', 'cpf', 'required');
        $this->form_validation->set_rules('drive_baco', 'banco', 'required');
        $this->form_validation->set_rules('drive_nocont', 'nome da conta', 'required');
        $this->form_validation->set_rules('drive_tip_cont', 'Tipo de conta', 'required');
        $this->form_validation->set_rules('drive_nunco', 'número da conta', 'required');
        $this->form_validation->set_rules('drive_contop', 'operação', 'required');
        $this->form_validation->set_rules('drive_nomeb', 'número do banco', 'required');
        $this->form_validation->set_rules('drive_obser', 'observações', 'required');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{

            $data = array(
                'us_nome'           => $this->input->post('drive_nome'),
                'us_telefone'       => $this->input->post('drive_tele'),
                'us_email'          => $this->input->post('drive_emai'),
                'us_endereco'       => $this->input->post('drive_ende'),
                'us_cnh'            => $this->input->post('drive_cnhh'),
                'us_data_validade'  => $this->input->post('drive_dtvl'),
                'us_categoria'      => $this->input->post('drive_catg'),
                'us_rg'             => $this->input->post('drive_rggg'),
                'us_cpf'            => $this->input->post('drive_cpff'),
                'us_tel_emergencia' => $this->input->post('drive_telm'),
                'us_banco'          => $this->input->post('drive_baco'),
                'us_tipo_conta'     => $this->input->post('drive_tip_cont'),
                'us_nome_conta'     => $this->input->post('drive_nocont'),
                'us_numero_conta'   => $this->input->post('drive_nunco'),
                'us_opraracao_conta'=> $this->input->post('drive_contop'),
                'us_numero_banco'   => $this->input->post('drive_nomeb'),
                'us_observer_motor' => $this->input->post('drive_obser'),
            );
        
            $this->db->update('users_gestores', $data, array('us_id' => $id));
           echo json_encode(['success'=>'Dados alterado com sucesso.']);
        }
    }
}

/* End of file AdminController.php */
