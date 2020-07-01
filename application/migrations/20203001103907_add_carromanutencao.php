<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_carromanutencao extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_car_m' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_car_m' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            )
        ));
        $this->dbforge->add_key('id_car_m', TRUE);
        $this->dbforge->create_table('carro_para_manutencao');
        $this->db->query('ALTER TABLE carro_para_manutencao ADD FOREIGN KEY(fk_car_m) REFERENCES veiculos(id_veic) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('carro_para_manutencao');
    }
}
