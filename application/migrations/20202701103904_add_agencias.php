<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_agencias extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_ag' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'nome_ag' => array(
                'type' => 'VARCHAR',
                'constraint' => '75',
                'null' => TRUE,
            ),
            'estado_ag' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'cidade_ag' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'bairro_ag' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'endereco_ag' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'telefone_ag' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'email_ag' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'cnpj_ag' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE,
            )
        ));
        $this->dbforge->add_key('id_ag', TRUE);
        $this->dbforge->create_table('agencias');
    }

    public function down()
    {
        $this->dbforge->drop_table('agencias');
    }
}
