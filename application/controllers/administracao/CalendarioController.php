<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CalendarioController extends CI_Controller
{

    public function viewAgenda()
    {
        $event_data = $this->db->get('programacao_carro_viagem');
        
        foreach ($event_data->result_array() as $row) {
            $data[] = array(
                'id' => $row['id_vc'],
                'title' => $row['local_saida_vc'],
                'start' => $row['data_saida_vc']
            );
        }
        echo json_encode($data);
    }

    public function listaCarroCadeiras(int $id)
    {
        $output = array();  
        $data = $this->db->select('*, sai.nome as city_sai, dest.nome as city_chega')
                        ->from('programacao_carro_viagem')
                        ->join('veiculos', 'veiculos.id_veic = programacao_carro_viagem.fk_carro_vc')
                        ->join('cidade as sai', 'sai.id = programacao_carro_viagem.fk_cidade_vc')
                        ->join('cidade as dest', 'dest.id = programacao_carro_viagem.fk_cidade_destino_vc')
                        ->where('id_vc', $id)
                        ->get();

        foreach($data->result() as $row)  
        {  
            $output['calendar_car_city_saida'] = $row->city_sai;  
            $output['calendar_car_city_chega'] = $row->city_chega;
            $output['calendar_car_key_viagem'] = $row->controle_key_vc;

            $output['calendar_car_placa_saida'] = $row->placa_veic;  
            $output['calendar_car_local_saida'] = $row->local_saida_vc;  
            $output['calendar_car_data_saida'] = date("d/m/Y", strtotime($row->data_saida_vc));  
            $output['calendar_car_hora_saida'] = date("H:i", strtotime($row->hora_saida_vc));  
        }  
        echo json_encode($output);
    }
}

/* End of file CalendarioController.php */
