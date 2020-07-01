<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_encomenda extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_enc' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_id_carro_viagem_enc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_id_cliente_enc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'remetente_nome_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
            ),
            'remetente_telefone_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'remetente_rg_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'remetente_local_recebe_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'status_encomenda_enc' => array(
                'type' => 'ENUM("0","1","2","3")',
                'default' => '0',
                'null' => TRUE,
            ),
            'descricao_peca_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'codigo_produto_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'qtd_produto_enc' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ),
            'valor_produto_enc' => array(
                'type' => 'DECIMAL',
                'constraint' => 10,2,
                'null' => TRUE,
            ),
            'key_produto_enc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'observacao_cliente_encomenda_enc' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'data_cadastro_enc' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        
        $this->dbforge->add_key('id_enc', TRUE);
        $this->dbforge->create_table('encomenda_viagem');
    }

    public function down()
    {
        $this->dbforge->drop_table('encomenda_viagem');
    }
}
