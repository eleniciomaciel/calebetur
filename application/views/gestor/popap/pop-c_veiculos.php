<div class="modal fade" id="listaVeiculoModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Veículos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- card -->
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#addVeiculoModalLong">
                    <i class="material-icons">add</i> Adicionar
                </button>
                <div class="table-responsive">
                    <table class="table" id="lista_todas_os_carros" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">Ano</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Placa</th>
                                <th class="text-right">Chassi</th>
                                <th>Tipo</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                        </tbody>
                    </table>
                </div>

                <!-- card -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal adiciona veiculo-->
<div class="modal fade" id="addVeiculoModalLong" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">directions_bus</i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Dados do veículo</h4>
                            <!-- //form -->
                            <br>
                            <form id="form_add_veiculo" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="veiculo_marca">Marca</label>
                                        <input type="text" class="form-control" name="veiculo_marca" placeholder="Ex.:">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="veiculo_modelo">Modelo</label>
                                        <input type="text" class="form-control" name="veiculo_modelo" placeholder="Ex.:">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="veiculo_ano">Ano</label>
                                        <input type="text" class="form-control" name="veiculo_ano" placeholder="Ex.:">
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="veiculo_chassi">Chassi</label>
                                        <input type="text" class="form-control" name="veiculo_chassi" placeholder="Ex.: 1234">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="veiculo_placa">Placa</label>
                                        <input type="text" class="form-control" name="veiculo_placa" placeholder="Ex.: ABC 1200">
                                    </div>

                                    <div class="form-group col-md-3 ml-auto">
                                        <label for="veiculo_poltrona">Poltronas</label>
                                        <input type="number" class="form-control" name="veiculo_poltrona" placeholder="Ex.: 58">
                                    </div>
                                    <div class="form-group col-md-3 ml-auto">
                                        <label for="veiculo_poltrona">Tipo de aquisição</label>
                                        <select class="form-control" name="veiculo_tipo_carro" id="veiculo_tipo_carro">
                                            <option class="text-dark" value="" selected disabled>Selecione aqui...</option>
                                            <option class="text-dark" value="Próprio">Próprio</option>
                                            <option class="text-dark" value="Fretado">Fretado</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="bt_car_env btn btn-primary" id="veiculoAddEnviar">Salvar</button>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg_addVeiculo" style="display:none"></div>
                            <!-- //form -->
                        </div>
                    </div>
                </div>
                <!-- //fim card -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal visualiza altera veiculo-->
<div class="modal fade" id="viewAlteraVeiculoModalLong" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Veículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">directions_bus</i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Dados do veículo</h4>
                            <!-- //form -->
                            <br>
                            <form id="form_vw_altera_veiculo" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="car_up_marca">Marca</label>
                                        <input type="text" class="form-control" name="car_up_marca" id="car_up_marca" placeholder="Ex.:">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="car_up_modelo">Modelo</label>
                                        <input type="text" class="form-control" name="car_up_modelo" id="car_up_modelo" placeholder="Ex.:">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="car_up_ano_vei">Ano</label>
                                        <input type="text" class="form-control" name="car_up_ano_vei" id="car_up_ano_vei" placeholder="Ex.:">
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="car_up_chassi">Chassi</label>
                                        <input type="text" class="form-control" name="car_up_chassi" id="car_up_chassi" placeholder="Ex.: 1234">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="car_up_placa">Placa</label>
                                        <input type="text" class="form-control" name="car_up_placa" id="car_up_placa" placeholder="Ex.: ABC 1200">
                                    </div>

                                    <div class="form-group col-md-3 ml-auto">
                                        <label for="car_up_poltronas">Poltronas</label>
                                        <input type="number" class="form-control" name="car_up_poltronas" id="car_up_poltronas" placeholder="Ex.: 58">
                                    </div>
                                    <div class="form-group col-md-3 ml-auto">
                                        <label for="car_up_poltronas">Tipo de aquisição</label>
                                        <select class="form-control" name="car_up_status" id="car_up_status">
                                        <option class="text-dark" value="Próprio">Próprio</option>
                                        <option class="text-dark" value="Fretado">Fretado</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="vw_id_car" id="vw_id_car">
                                <button type="submit" class="bt_env_car_upt btn btn-danger" id="carroTextEnviar_up_car">Alterar</button>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg_UpCar" style="display:none"></div>
                            <!-- //form -->
                        </div>
                    </div>
                </div>
                <!-- //fim card -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>