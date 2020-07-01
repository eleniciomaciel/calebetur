<div class="modal fade" id="motoristaViagemModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agenda de viagemz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   lista  ============================= -->
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#agendaMotoristaModal">
                    <i class="material-icons">event_note</i> Agendar
                </button>
                <br>
                <div class="table-responsive">
                    <table class="table" id="lista_todas_viagens_agendads_motoristas" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Motoristas</th>
                                <th scope="col">Datas</th>
                                <th scope="col">Carros</th>
                                <th scope="col">Saída</th>
                                <th scope="col">Destino</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td>@fat</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                                <td>@twitter</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- ===================   fim lista  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- ===================   agenda motorista  ============================= -->

<div class="modal fade" id="agendaMotoristaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agendar viagem do motorista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   form  ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title"><i class="material-icons">event_note</i> Cadastrar motorista</h4>
                            <p class="card-category">Programar viagem para o motorista</p>
                        </div>
                        <div class="card-body">
                            <form id="form_addMotorAgenda">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Data da viagem</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="selectDate" id="selectDate">
                                                <option value="" selected disabled>Selecione aqui...</option>
                                                <?php
                                                $this->db->select('id_vc, data_saida_vc');
                                                $this->db->order_by('data_saida_vc DESC');
                                                $data = $this->db->get('programacao_carro_viagem');
                                                foreach ($data->result() as $row) {
                                                ?>
                                                    <option class="text-dark" value="<?php echo $row->data_saida_vc ?>"><?php echo date("d/m/Y", strtotime($row->data_saida_vc)); ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Carro/Placa</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="pl_car_trip" id="pl_car_trip"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Motorista</label>
                                        <div class="form-group bmd-form-group result_lista_motoristas"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Chave da viagem</label>
                                            <select class="form-control" name="valor_key_tip" id="valor_key_tip"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-floating"> Digite aqui a sua observação.</label>
                                                <textarea class="form-control" rows="5" name="agenda_moto_obs" id="agenda_moto_obs"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="bt_adm_add_agenda_motor btn btn-primary pull-right" id="salvaAgendaMotor">Agendar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg_av_age_motor" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- ===================   fim form  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- ===================   lista card  ============================= -->

<div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Card da viagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   card  ============================= -->
                    <div class="result_car_qr_code_viagem"></div>
                <!-- ===================   fim card  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>