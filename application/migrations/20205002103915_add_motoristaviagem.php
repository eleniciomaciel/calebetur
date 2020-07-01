<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_motoristaviagem extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_mtv' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_id_carro_viagem_mtv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_id_motorista_mtv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'token_da_agenda_viagem_mtv' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'observacao_ao_motorista_mtv' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'data_cadastro_mtv' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        
        $this->dbforge->add_key('id_mtv', TRUE);
        $this->dbforge->create_table('motorista_agenda_viagem');
    }

    public function down()
    {
        $this->dbforge->drop_table('motorista_agenda_viagem');
    }
}

