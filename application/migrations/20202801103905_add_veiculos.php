<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_veiculos extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_veic' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'marca_veic' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'modelo_ano_veic' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'ano_veic' => array(
                'type' => 'VARCHAR',
                'constraint' => '4',
                'null' => TRUE,
            ),
            'chassi_veic' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'poltronas_veic' => array(
                'type' => 'INT',
                'constraint' => '4',
                'null' => TRUE,
            ),
            'placa_veic' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => TRUE,
            ),
            'status_carro_veic' => array(
                'type' => 'ENUM("Próprio","Fretado")',
                'default' => 'Próprio',
                'null' => TRUE,
            )
        ));
        $this->dbforge->add_key('id_veic', TRUE);
        $this->dbforge->create_table('veiculos');
    }

    public function down()
    {
        $this->dbforge->drop_table('veiculos');
    }
}
