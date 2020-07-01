<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_clientePoltronaCarroViagem extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_cpcv' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'fk_carro_viagem_cpcv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_id_programacao_carro_viagem_cpcv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_cliente_cpcv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'nome_vendedor_cliente_cpcv' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
            ),
            'fk_agente_cpcv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'fk_agencia_cpcv' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'poltrona_carro_cpcv' => array(
                'type' => 'INT',
                'constraint' => '2',
                'null' => TRUE,
            ),
            'status_poltrona_cpcv' => array(
                'type' => 'ENUM("0","1","2")',
                'default' => '0',
                'null' => TRUE,
            ),
            'tipo_pagamento_cpcv' => array(
                'type' => 'ENUM("0","Cartão débito","Cartão crédito","Dinheiro","Prazo")',
                'default' => '0',
                'null' => TRUE,
            ),
            'parcelas_cpcv' => array(
                'type' => 'INT',
                'constraint' => '2',
                'null' => TRUE,
            ),
            'cliente_saida_cpcv' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'cliente_destino_cpcv' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'observacao_cliente_cpcv' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'valor_poltrona_cpcv' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ),
            'embarcado_cpcv' => array(
                'type' => 'ENUM("Sim","Não")',
                'default' => 'Não',
                'null' => TRUE,
            ),
            'data_cadastro_cpcv' => array(
                'type'   => 'TIMESTAMP'
            )
        ));
        
        $this->dbforge->add_key('id_cpcv', TRUE);
        $this->dbforge->create_table('clientes_poltronas_carro_viagem');
        $this->db->query('ALTER TABLE clientes_poltronas_carro_viagem ADD FOREIGN KEY(fk_carro_viagem_cpcv) REFERENCES veiculos(id_veic) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE clientes_poltronas_carro_viagem ADD FOREIGN KEY(fk_id_programacao_carro_viagem_cpcv) REFERENCES programacao_carro_viagem(id_vc) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE clientes_poltronas_carro_viagem ADD FOREIGN KEY(fk_cliente_cpcv) REFERENCES cliente_passageiro(id_cl) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE clientes_poltronas_carro_viagem ADD FOREIGN KEY(fk_agente_cpcv) REFERENCES users_gestores(us_id) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE clientes_poltronas_carro_viagem ADD FOREIGN KEY(fk_agencia_cpcv) REFERENCES agencias(id_ag) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('clientes_poltronas_carro_viagem');
    }
}
