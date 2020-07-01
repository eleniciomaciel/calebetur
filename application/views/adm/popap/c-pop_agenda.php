<?php
$user = $this->session->userdata('user');
extract($user);
?>
<!-- Modal -->

<div class="modal fade" id="agendaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Planejamento das viagens</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div id="calendar"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="listaPoltronasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agendar viagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   tabela card  ============================= -->
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Agendar poltronas</h4>
                    <div class="card-body">

                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Linha saída: <span class="text-danger" id="cityMySaida"></span><br></li>
                                <li class="breadcrumb-item active">Linha destino: <span class="text-danger" id="cityMychegada"></span><br></li>
                                <li class="breadcrumb-item active">Carro: <span class="text-danger" id="placaMySaida"></span><br></li>
                                <li class="breadcrumb-item active">Local saída: <span class="text-danger" id="localMySaida"></span><br></li>
                                <li class="breadcrumb-item active">Data da saída: <span class="text-danger" id="dataMySaida"></span><br></li>
                                <li class="breadcrumb-item active">Hora da saída: <span class="text-danger" id="horaMySaida"></span></li>
                            </ol>
                        </nav>
                        <!-- ===================   tabela das poltronas  ============================= -->

                        <h5 class="text-center">Escolher poltronas</h5>

                        <div class="row">
                            <div class="col">
                                <form id="">
                                    <h6>Legendas:</h6>
                                    <span class="badge badge-danger"><i class="material-icons"> airline_seat_recline_normal </i>&nbsp;Vazias</span>
                                    <span class="badge badge-warning"><i class="material-icons"> airline_seat_recline_normal </i>&nbsp;Reservadas</span>
                                    <span class="badge badge-success"><i class="material-icons"> airline_seat_recline_normal </i>&nbsp;Ocupadas</span>
                                    <div class="alert alert-warning" role="alert">
                                        Nº da viagem <a href="#" class="alert-link" id="kyviagemKey"></a>
                                    </div>
                                    <div id="result_table_car_viagem"></div>
                                    <input type="hidden" name="id_calendar_pol" id="id_calendar_pol">
                                </form>
                            </div>
                        </div>




                        <!-- ===================   tabela das poltronas  ============================= -->

                    </div>
                </div>
                <!-- ===================   fim do card  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- ===================   seleciona dados da poltrona  ============================= -->

<div class="modal fade" id="selectPoltronaCarViagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados da poltrona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   form poltrona  ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Dados do usuário</h4>
                            <p class="card-category">Informações do passeiro dessa poltrona</p>
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <form id="form_save_poltrona">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="bmd-label-floating">Passageiro(a)</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="polt_car_v_cliente" id="polt_car_v_cliente">
                                                <option value="" selected disabled>Selecione aqui...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="bmd-label-floating">Poltrona:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="polt_car_v_poltrona" id="polt_car_v_poltrona" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="bmd-label-floating">Status:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="polt_car_v_status_p" id="polt_car_v_status_p">
                                                <option value="0" class="text-dark">Vago</option>
                                                <option value="1" class="text-dark">Reservado</option>
                                                <option value="2" class="text-dark">Ocupado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Saída:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="polt_car_v_local_sa" id="polt_car_v_local_sa">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Destino:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="polt_car_v_local_destino" id="polt_car_v_local_destino">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Tipo de Pagamento</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="polt_car_v_type_pay" id="polt_car_v_type_pay">
                                                <option class="text-dark" value="0">Sem pagamento</option>
                                                <option class="text-dark" value="Cartão débito">Cartão débito</option>
                                                <option class="text-dark" value="Cartão crédito">Cartão crédito</option>
                                                <option class="text-dark" value="Dinheiro">Dinheiro</option>
                                                <option class="text-dark" value="Prazo">Prazo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Parcelas:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="polt_car_v_parcelas" id="polt_car_v_parcelas">
                                                <option class="text-dark" value="" selected>Á vista</option>
                                                <?php
                                                for ($i = 0; $i <= 12; $i++) {
                                                ?>
                                                    <option class="text-dark" value="<?php echo $i; ?>"><?php echo $i . 'X'; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Valor R$:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="number" class="form-control" name="polt_car_v_valor" id="polt_car_v_valor" step="any">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Agente externo</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="polt_car_v_vendedor" id="polt_car_v_vendedor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Observações</label>
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Digite sua observação aqui...</label>
                                            <div class="form-group bmd-form-group">
                                                <textarea class="form-control" name="polt_car_v_observacao" id="polt_car_v_observacao" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_pot" id="id_pot">
                                <input type="hidden" name="polt_car_v_id_agente" id="polt_car_v_id_agente" value="<?php echo $us_id; ?>">
                                <input type="hidden" name="polt_car_v_id_agencia" id="polt_car_v_id_agencia" value="<?php echo $us_agencia_fk; ?>">
                                <button type="submit" class="btn_save_poltrona btn btn-primary pull-left bt_adm_cli_poltrona" id="clienteADMEnviar_poltrona">Salvar viajante</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msgSavePoltrona" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- ===================   form poltrona  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>