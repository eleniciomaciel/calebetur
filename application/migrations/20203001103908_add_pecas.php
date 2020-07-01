<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_pecas extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_pc' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_car_pc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_manutencao_pc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'descricao_pc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'quantidade_pc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'valor_pc' => array(
                'type' => 'decimal',
                'constraint' => '10,2',
                'null' => TRUE,
            ),
            'n_nota_pc' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
            ),
            'data_pc' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        $this->dbforge->add_key('id_pc', TRUE);
        $this->dbforge->create_table('pecas_manutencao_historicos');
        $this->db->query('ALTER TABLE pecas_manutencao_historicos ADD FOREIGN KEY(fk_car_pc) REFERENCES veiculos(id_veic) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE pecas_manutencao_historicos ADD FOREIGN KEY(fk_manutencao_pc) REFERENCES carro_para_manutencao(id_car_m) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('pecas_manutencao_historicos');
    }
}
