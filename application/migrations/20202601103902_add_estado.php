<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_estado extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '75',
                'null' => TRUE,
            ),
            'uf' => array(
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => TRUE,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('estado');
    }

    public function down()
    {
        $this->dbforge->drop_table('estado');
    }
}
