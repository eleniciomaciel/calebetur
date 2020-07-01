<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('Usuarios_model');
	}
 
	public function index(){
		//restrict users to go back to login if session has been set
		if($this->session->userdata('user') && $this->session->userdata('user')['us_nivel'] == 'gestor'){
			redirect('welcome/home');
		}elseif($this->session->userdata('user') && $this->session->userdata('user')['us_nivel'] == 'administrador'){
			redirect('welcome/administrador');
		}elseif($this->session->userdata('user') && $this->session->userdata('user')['us_nivel'] == 'Motorista'){
			redirect('welcome/motorista');
		}
		else{
			$this->load->view('welcome_message');
		}
	}
 
	public function login(){
		$output = array('error' => false);
 
		$email = $this->input->get('acesso_login', TRUE);
		$password = $this->input->get('acesso_senha', TRUE);
 
		$data = $this->Usuarios_model->login($email, $password);
 
		if($data){
			$this->session->set_userdata('user', $data);
			$output['message'] = 'Iniciando sua sessão. Aguarde ...';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Login inválido. Usuário não encontrado.';
		}
 
		echo json_encode($output); 
	}
 
	public function home(){
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view('gestor/partial_g/header');
			$this->load->view('gestor/partial_g/sidebar');
			$this->load->view('gestor/painel');
			$this->load->view('gestor/partial_g/footer');
		}
		else{
			redirect('/');
		}
	}

	/**administrador */
	public function administrador()
	{
		if($this->session->userdata('user')){
			$this->load->view('adm/partial/header-adm');
			$this->load->view('adm/partial/sidebar-adm');
			$this->load->view('adm/painel_adm');
			$this->load->view('adm/partial/footer-adm');
		}
		else{
			redirect('/');
		}
	}

	/**motorista */
	public function motorista()
	{
		if($this->session->userdata('user')){
			$this->load->view('adm/partial/header-adm');
			$this->load->view('adm/partial/sidebar-adm');
			$this->load->view('adm/painel_adm');
			$this->load->view('adm/partial/footer-adm');
		}
		else{
			redirect('/');
		}
	}
 
	public function logout(){
		$this->session->unset_userdata('user');
		redirect('/');
	}

	/**verifica-emcomenda */
	public function condicao_minhas_emcomendas($key)
	{
		$query['view_encomendas'] = $this->db->select('*')
                ->from('encomenda_viagem')
                ->join('cliente_passageiro', 'cliente_passageiro.id_cl = encomenda_viagem.fk_id_cliente_enc')
                ->join('programacao_carro_viagem', 'programacao_carro_viagem.id_vc = encomenda_viagem.fk_id_carro_viagem_enc')
                ->where('key_produto_enc', $key)
				->get()->result();
		$this->load->view('qr_ver_encomenda', $query);
	}
}
