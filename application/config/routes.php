<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['myform/ajax/(:any)'] = 'gestores/AdminController/myformAjax/$1';
$route['form_addUser'] = 'gestores/AdminController/cadastraUsuarios';
$route['get_users'] = 'gestores/AdminController/get_all_usuarios';
$route['view_user/(:num)']['get'] = 'gestores/AdminController/get_dados_usuario/$1';
$route['form_alteraUser/(:num)'] = 'gestores/AdminController/altera_dados_usuario/$1';
$route['status_access/(:num)'] = 'gestores/AdminController/status_permissao_acesso/$1';
$route['save-acesso-user/(:num)'] = 'gestores/AdminController/salvaAcesso/$1';
$route['deleta-usuario/(:num)'] = 'gestores/AdminController/deleteUser/$1';
$route['lista-usuarios-motoristas'] = 'gestores/AdminController/listaUsuariosMotorista';
$route['lista-dados-motorista-um/(:num)'] = 'gestores/AdminController/listaUsuariosMotoristaUm/$1';
$route['altera-dado-motorista-ativo/(:num)'] = 'gestores/AdminController/alteraUsuarioMotorista/$1';

/**agencia crud */
$route['adiciona-agencia'] = 'gestores/AgenciaController/addAgencia';
$route['lista-agencias'] = 'gestores/AgenciaController/get_all_agencias';
$route['select-agencias'] = 'gestores/AgenciaController/select_all_agencias';
$route['select-agencias'] = 'gestores/AgenciaController/select_all_agencias';
$route['visualiza-dados-agencia/(:num)']['GET'] = 'gestores/AgenciaController/visualiza_agencia/$1';
$route['altera-agencia/(:num)'] = 'gestores/AgenciaController/altera_agencia/$1';
$route['delete-agencia/(:num)'] = 'gestores/AgenciaController/delete_agencia/$1';


/**carro crud */
$route['adiciona-veiculo'] = 'gestores/VeiculosController/salvaVeiculo';
$route['lista-carros-gestor'] = 'gestores/VeiculosController/get_all_carros';
$route['visualiza-dados-do-car/(:num)'] = 'gestores/VeiculosController/get_car/$1';
$route['altera-carro/(:num)'] = 'gestores/VeiculosController/alteraDadosDoCarro/$1';
$route['delete-carro/(:num)'] = 'gestores/VeiculosController/deletaCarro/$1';

/**totalizador card state */
$route['soma-usuarios'] = 'gestores/AdminController/somaTodosUsuarios';
$route['soma-agencias'] = 'gestores/AgenciaController/somaTodasAgencias';

/**rotas localidades */
$route['adiciona-localidades'] = 'gestores/LocalidadesController/inseriLocalidades';
$route['get-localidades'] = 'gestores/LocalidadesController/get_localidades';
$route['deleta-local/(:num)'] = 'gestores/LocalidadesController/del_localidades/$1';

/**rotas da manutencao */
$route['adiciona-carro-na-manutencao'] = 'gestores/ManutencaoController/addCarManutencao';
$route['get-carro-em-manutencao'] = 'gestores/ManutencaoController/get_carrosComManutencao';
$route['lista-dados-carro-manutencao/(:num)'] = 'gestores/ManutencaoController/get_carrosComManutencaoPecas/$1';
$route['adiciona-pecas-para-o-carro/(:num)'] = 'gestores/ManutencaoController/get_carrosAddManutencaoPecas/$1';
$route['adiciona-pecas-dinamicamente'] = 'gestores/ManutencaoController/add_many_piecas';
$route['deleta-peca-manutencao/(:num)'] = 'gestores/ManutencaoController/delete_pecas/$1';

/**login */
$route['acesso-restrito'] = 'welcome/login';
$route['logaut'] = 'welcome/logout';


/**get dinamicos select */
$route['lista-carros'] = 'administracao/CarroViagemController/selecCarros';
$route['lista-ciadades-saida'] = 'administracao/CarroViagemController/selecCidades';

/**rota agenda viagem */
$route['cadastro-carro-viagem'] = 'administracao/CarroViagemController/carroAgendaViagem';
$route['lista-carro-programado-viagem'] = 'administracao/CarroViagemController/getCarroViagemProgramacao';
$route['visualiza-dados-programa-carro-viagem/(:num)'] = 'administracao/CarroViagemController/viewCarProgramViagem/$1';
$route['altera-dados-dados-programa-viagem/(:num)'] = 'administracao/CarroViagemController/alteraDadosViagem_car/$1';

/**passageiro dados */
$route['adiciona-cleinete-passageiro'] = 'administracao/PassageiroController/addPassageiro';
$route['altera-cleinete-passageiro/(:num)'] = 'administracao/PassageiroController/alteraDadosPassageiro/$1';
$route['cidade-do-cliente/(:num)'] = 'administracao/PassageiroController/seleciona_cidadesDoEstado/$1';
$route['lista-todos-clientes'] = 'administracao/PassageiroController/get_todos_clientes';
$route['lista-dados-do-cliente/(:num)'] = 'administracao/PassageiroController/get_cliente/$1';

/**calendario */
$route['calendario-viagens'] = 'administracao/CalendarioController/viewAgenda';
$route['lista-carro-viagem/(:num)'] = 'administracao/CalendarioController/listaCarroCadeiras/$1';

/**poltrona carro viagem */
$route['lista-poltronas-do-carro-para-viagem/(:num)'] = 'administracao/CarroViagemController/selectDadosCadeiraViagem/$1';

$route['escolhe-poltrona-do-carro-viagem/(:num)'] = 'administracao/CarroViagemController/selectPoltronaCarViagem/$1';
$route['dados-da-poltrona/(:num)'] = 'administracao/CarroViagemController/selectPoltronaCarViagem/$1';
$route['salva-dados-poltrona'] = 'administracao/CarroViagemController/addUserPoltronaCar';
$route['usuarios-lista-clientes'] = 'administracao/CarroViagemController/clientes';


/**listando passageiros e dados */
$route['lista-passageiro-em-viagem-programada'] = 'administracao/ListaPassageiroViagem/getPassageirosViagem_programada';
$route['dados-cliente-agendada-viagem/(:num)'] = 'administracao/ListaPassageiroViagem/getClienteAgendadaViagem/$1';//teste

/**rota bagagem */
$route['lista-usuario-bagagem/(:num)'] = 'administracao/ListaPassageiroViagem/getClienteAgendadaViagem/$1';
$route['add-bagagem_usuario'] = 'administracao/ListaPassageiroViagem/addBagagemUsuario';
$route['lista-bagagem-bagagem-viagem/(:num)'] = 'administracao/ListaPassageiroViagem/listaBagaensClienteViagem/$1';
$route['cancelar-viagem-cliente/(:num)'] = 'administracao/ListaPassageiroViagem/cancelaClienteViagem/$1';
$route['deletar-bagaem/(:num)'] = 'administracao/ListaPassageiroViagem/deletaClienteViagemBagagem/$1';

/**e-tick controller */
$route['ticket-cliente-viagem/(:num)'] = 'administracao/E_ticketController/e_ticketViagem/$1';//teste
$route['get_list_passageoro_poltronaViagem_relatorio'] = 'administracao/RelatorioViagem/listaRelatorioCarroViagem';

/**relatorio etinerario clientes viagem */
$route['visualiza-itinerario/(:num)'] = 'administracao/RelatorioViagem/itinerarioCarroClientes/$1';

/**dados encomenda */
$route['lista-encomendas-do-carro/(:num)'] = 'administracao/EncomendasController/index/$1';
$route['busca-cliente'] = 'administracao/EncomendasController/searchCliente';
$route['completa-dados-cliente/(:any)'] = 'administracao/EncomendasController/dadosClienteComplete/$1';
$route['add_encomenda_usuario'] = 'administracao/EncomendasController/enviaEncomenda';
$route['lista-encoemendas-minha-viagem/(:any)'] = 'administracao/EncomendasController/listaEncomendasDaviagem/$1';
$route['lista-encomendas-da-diagem/(:num)'] = 'administracao/EncomendasController/listaEncomendasDaViagemCarroPrint/$1';
$route['lista-encomenda-do-remetente/(:any)'] = 'administracao/EncomendasController/listaEncomendasRemetente/$1';
$route['delete-produto-encoemda-cleinet/(:num)'] = 'administracao/EncomendasController/deleteEncomendaCliente/$1';
$route['cliente-encomenda-imprimir/(:any)'] = 'administracao/EncomendasController/printEncoemdasUsuario/$1';
$route['situacao-status-produto/(:num)'] = 'administracao/EncomendasController/getStatus/$1';
$route['altera-status-do-produto-na-agencia/(:num)'] = 'administracao/EncomendasController/mudaStatus/$1';
$route['lista-all-encomendas'] = 'administracao/EncomendasController/get_encomendas';
$route['e-ticket-bagagem/(:any)'] = 'administracao/E_ticketController/e_tickete_dados_encomenda/$1';
$route['e-ticket-dados-da-encomenda/(:any)'] = 'welcome/condicao_minhas_emcomendas/$1';

/**rota motorista agenda viagem */
$route['lista-datas-carro-viagem/(:any)'] = 'administracao/motoristaViagem/index/$1';
$route['lista-todos-motoristas'] = 'administracao/motoristaViagem/getAllMotorista';
$route['lista-key-carro-viagem/(:any)'] = 'administracao/motoristaViagem/selectKey/$1';
$route['adiciona-motorista-agenda-viagem'] = 'administracao/motoristaViagem/addMotorNaViagem';
$route['lista-viagens-agendadas-motoristas'] = 'administracao/motoristaViagem/get_agendaViagensMotoristas';
$route['lista-qrcode-viagem-motorista/(:num)/(:any)'] = 'administracao/motoristaViagem/listaCardViagem/$1/$2';
$route['car-viagem/(:any)'] = 'administracao/motoristaViagem/CardViagem/$1';
$route['deleta-motorista-viagem/(:num)'] = 'administracao/motoristaViagem/deletaMotoristaViagem/$1';
$route['lista-geral-dadospassageiro-poltrona/(:num)'] = 'administracao/motoristaViagem/listaInformacoesPassageiros/$1';
