<?php
    $user = $this->session->userdata('user');
    extract($user);
?>
<!-- Modal -->
<div class="modal fade" id="programaviaggemcarroModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agenda viagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================  card viagem   ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Programar viagem</h4>
                            <p class="card-category">Criar programação da viagem</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="form_addcarro_viagem">
                            <?=form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash())?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Selecione um carro</label>
                                            <select class="form-control" name="select_veiculo" id="select_veiculo"></select>
                                            <span id="select_veiculo_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Cidade da saída</label>
                                            <select class="form-control" name="select_cidades_saidas" id="select_cidades_saidas"></select>
                                            <span id="select_cidades_saidas_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Destino</label>
                                            <select class="form-control" name="select_cidades_destino" id="select_cidades_destino"></select>
                                            <span id="select_cidades_destino_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Local da saída</label>
                                            <input type="text" name="car_viag_local" id="car_viag_local" class="form-control">
                                            <span id="car_viag_local_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Data da saída</label>
                                            <input type="date" name="car_viag_data" id="car_viag_data" class="form-control">
                                            <span id="car_viag_data_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Hora da saída</label>
                                            <input type="time" name="car_viag_hora_saida" id="car_viag_hora_saida" class="form-control">
                                            <span id="car_viag_hora_saida_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observação</label>
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-floating"> Digite sua observação aqui...</label>
                                                <textarea class="form-control" name="car_viag_observe" id="car_viag_observe" rows="5"></textarea>
                                                <span id="car_viag_observe_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="agente_id" id="agente_id" value="<?php echo $us_id; ?>">
                                <input type="hidden" name="agencia_id" id="agencia_id" value="<?php echo $us_agencia_fk; ?>">
                                <button type="submit" name="add_viagem_car" id="add_viagem_car" class="btn btn-primary pull-right">Salvar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <span id="success_message"></span>
                        </div>
                    </div>
                </div>
                <!-- ===================  card viagem   ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- visualiza dados do agendamento da viagem carro Modal -->
<div class="modal fade" id="viewProgramaviaggemcarroModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agenda viagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================  card viagem   ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Programar viagem</h4>
                            <p class="card-category">Criar programação da viagem</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="form_alteracarro_viagem">
                            <?=form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash())?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Selecione um carro</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="progrm_car_fk_carro" id="progrm_car_fk_carro">
                                                <?php
                                                $variable = $this->db->get('veiculos');
                                                foreach ($variable->result() as $key) {
                                                    ?>
                                                    <option class="text-dark" value="<?php echo $key->id_veic?>"><?php echo $key->placa_veic?></option>
                                                    <?php
                                                }
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Cidade da saída</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="progrm_car_fk_cidade_s" id="progrm_car_fk_cidade_s">
                                            <?php
                                                $this->db->select('*');
                                                $this->db->from('localidades');
                                                $this->db->join('cidade', 'cidade.id = localidades.cidade_loc');

                                                $query = $this->db->get();

                                                foreach ($query->result() as $key) {
                                                    ?>
                                                    <option class="text-dark" value="<?php echo $key->id?>"><?php echo $key->nome?></option>
                                                    <?php
                                                }
                                                
                                                ?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Destino</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="progrm_car_fk_cidades_d" id="progrm_car_fk_cidades_d">
                                            <?php
                                                $this->db->select('*');
                                                $this->db->from('localidades');
                                                $this->db->join('cidade', 'cidade.id = localidades.cidade_loc');

                                                $query = $this->db->get();

                                                foreach ($query->result() as $key) {
                                                    ?>
                                                    <option class="text-dark" value="<?php echo $key->id?>"><?php echo $key->nome?></option>
                                                    <?php
                                                }
                                                
                                                ?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Local da saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" name="progrm_car_local_saida" id="progrm_car_local_saida" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Data da saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="date" name="progrm_car_data_saida" id="progrm_car_data_saida" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Hora da saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="time" name="progrm_car_hora_saida" id="progrm_car_hora_saida" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observação</label>
                                            <div class="form-group bmd-form-group">
                                                <textarea class="form-control" name="progrm_car_observacao" id="progrm_car_observacao" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_viewProgramCar" id="id_viewProgramCar">
                                <input type="hidden" name="agente_id" id="agente_id" value="<?php echo $us_id; ?>">
                                <input type="hidden" name="agencia_id" id="agencia_id" value="<?php echo $us_agencia_fk; ?>">
                                <button type="submit" class="btn_salva_alteracao_progran_viagem btn btn-danger">
                                    <i class="material-icons"> refresh </i>&nbsp;Alterar
                                </button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msgAlteraProgranViagem" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- ===================  card viagem   ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>