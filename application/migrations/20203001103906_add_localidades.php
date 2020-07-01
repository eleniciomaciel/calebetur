<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_localidades extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_loc' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'estado_loc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'cidade_loc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'local_loc' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => TRUE,
            )
        ));
        $this->dbforge->add_key('id_loc', TRUE);
        $this->dbforge->create_table('localidades');
    }

    public function down()
    {
        $this->dbforge->drop_table('localidades');
    }
}
