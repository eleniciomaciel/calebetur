<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_carroviagem extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_vc' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_carro_vc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_usuario_agente_vc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_agencia_vc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_cidade_vc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_cidade_destino_vc' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'local_saida_vc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'data_saida_vc' => array(
                'type' => 'DATE'
            ),
            'hora_saida_vc' => array(
                'type' => 'TIME'
            ),
            'controle_key_vc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'observacao_vc' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'data_cadastro_vc' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        
        $this->dbforge->add_key('id_vc', TRUE);
        $this->dbforge->create_table('programacao_carro_viagem');
        $this->db->query('ALTER TABLE programacao_carro_viagem ADD FOREIGN KEY(fk_carro_vc) REFERENCES veiculos(id_veic) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE programacao_carro_viagem ADD FOREIGN KEY(fk_usuario_agente_vc) REFERENCES users_gestores(us_id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE programacao_carro_viagem ADD FOREIGN KEY(fk_agencia_vc) REFERENCES agencias(id_ag) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE programacao_carro_viagem ADD FOREIGN KEY(fk_cidade_vc) REFERENCES cidade(id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE programacao_carro_viagem ADD FOREIGN KEY(fk_cidade_destino_vc) REFERENCES cidade(id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('programacao_carro_viagem');
    }
}
