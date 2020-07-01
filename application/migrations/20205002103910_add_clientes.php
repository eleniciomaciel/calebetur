<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_clientes extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_cl' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_nome_ciente_cl' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'fk_usuario_agente_cl' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_agencia_cl' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_cidade_cl' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_estado_cl' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'local_telefone_pessoal_cl' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'data_telefone_contato_cl' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'rg_cl' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'cpf_cl' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'nascimento_cl' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'observacao_cl' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'data_cadastro_cl' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        
        $this->dbforge->add_key('id_cl', TRUE);
        $this->dbforge->create_table('cliente_passageiro');
        $this->db->query('ALTER TABLE cliente_passageiro ADD FOREIGN KEY(fk_usuario_agente_cl) REFERENCES users_gestores(us_id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE cliente_passageiro ADD FOREIGN KEY(fk_agencia_cl) REFERENCES agencias(id_ag) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE cliente_passageiro ADD FOREIGN KEY(fk_cidade_cl) REFERENCES cidade(id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE cliente_passageiro ADD FOREIGN KEY(fk_estado_cl) REFERENCES estado(id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('cliente_passageiro');
    }
}
