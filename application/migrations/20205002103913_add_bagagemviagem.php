<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_bagagemviagem extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_cb' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_id_viagem_poltrona' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'descricao_bagagem_cb' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
            ),
            'codigo_bagagem_cb' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'bagagem_status' => array(
                'type' => 'ENUM("Sim","Não")',
                'default' => 'Não',
                'null' => TRUE,
            ),
            'qtd_bagagem_cb' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ),
            'valor_bagagem_cb' => array(
                'type' => 'DECIMAL',
                'constraint' => 10,2,
                'null' => TRUE,
            ),
            'observacao_cliente_bagagem_cb' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'data_cadastro_cb' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        
        $this->dbforge->add_key('id_cb', TRUE);
        $this->dbforge->create_table('bagagem_cliente_viagem');
    }

    public function down()
    {
        $this->dbforge->drop_table('bagagem_cliente_viagem');
    }
}
