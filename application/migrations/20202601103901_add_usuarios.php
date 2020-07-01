<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_usuarios extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'us_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'us_nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => TRUE,
            ),
            'us_telefone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'us_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'us_endereco' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
             ),
             'us_bairro' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
             ),
             'us_cidade' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
             ),
             'us_estado' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
             ),
             'us_agencia_fk' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
             ),
             'us_status' => array(
                'type' => 'ENUM("0","1")',
                'default' => '0',
                'null' => TRUE,
             ),
             'us_nivel' => array(
                'type' => 'ENUM("gestor","administrador","cliente","socio","Motorista")',
                'default' => 'administrador',
                'null' => TRUE,
             ),
             'us_login' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
             ),
             'us_senha' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
             ),
             'us_data' => array(
                'type' => 'DATETIME'
             ),/** dados do motorista =================================================*/
             'us_cnh' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE,
             ),
             'us_data_validade' => array(
               'type' => 'DATE',
                'null' => TRUE,
             ),
             'us_categoria' => array(
               'type' => 'ENUM("A","AB","B","C","D","E")',
                'default' => 'A',
                'null' => TRUE,
             ),
             'us_rg' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
             ),
             'us_cpf' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => TRUE,
             ),
             'us_tel_emergencia' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => TRUE,
             ),
             'us_banco' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
             ),
             'us_tipo_conta' => array(
               'type' => 'ENUM("CC","CP","CE","CS","CD","CU")',
               'default' => 'CC',
               'null' => TRUE,
             ),
             'us_nome_conta' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
             ),
             'us_numero_conta' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE,
             ),
             'us_opraracao_conta' => array(
                'type' => 'INT',
                'constraint' => '5',
                'null' => TRUE,
             ),
             'us_numero_banco' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE,
             ),
             'us_observer_motor' => array(
                'type' => 'TEXT',
                'null' => TRUE,
             )
        ));
        $this->dbforge->add_key('us_id', TRUE);
        $this->dbforge->create_table('users_gestores');
    }

    public function down()
    {
        $this->dbforge->drop_table('users_gestores');
    }
}
