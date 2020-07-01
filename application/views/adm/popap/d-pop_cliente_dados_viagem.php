<div class="modal fade" id="clientedadosViagemstaticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dados do viajante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   formulario  ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Dados do passageiro</h4>
                            <p class="card-category">Informações do passageiro para a viagem</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="bmd-label-floating">Passageiro</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Linha/saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_cidade_destino_carro">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Linha/chegada</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_cidade_chegada_carro">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Poltrona</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_poltrona">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Passageiro/saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_cliente_saida">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Passageiro/destino</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_cliente_chegada">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Ônibus/placa</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_placa_carro">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Data/saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_data_saida">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Hora/saída</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_hora_saida">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Agência</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_agencia_cadastro">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Agente</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_agencia_agente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Status</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_poltronaStatus">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Data do cadastro</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" id="cli_Viagem_data_cadastro">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Observação:</label>
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Observações do passageiro.</label>
                                            <div class="form-group bmd-form-group">
                                                <textarea class="form-control" rows="5" id="cli_Viagem_observaçãoes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ===================   formulario  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- ===================   bagagem do passageiro  ============================= -->

<!-- Modal -->
<div class="modal fade" id="bagagemPassageiroIndividual" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar bagagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   lista bagagem  ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title" id="">Cliente: <span id="cliente_bgg_add"></span></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                            <div id="result_bagagem"></div>

                                <h5>Adicionar bagagem</h5>
                                <form id="add_bagaens_user_form">
                                    <?php
                                    $csrf = array(
                                        'name' => $this->security->get_csrf_token_name(),
                                        'hash' => $this->security->get_csrf_hash()
                                    );
                                    ?>
                                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                    <div class="table-responsive">
                                        <table class="table table-dark" id="dinamycBagage">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Descrição</th>
                                                    <th scope="col">Cód.:bagagem</th>
                                                    <th scope="col">Qtd</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><input class="form-control" type="text" name="desc_bgg[]" placeholder="Digite aqui..." required></th>
                                                    <td><input class="form-control" type="text" name="cod_bgg[]" placeholder="Código aqui..." required></td>
                                                    <td><input class="form-control" type="number" name="qtd_bgg[]" placeholder="Ex.: 2" required></td>
                                                    <td><input class="form-control" type="number" name="valor_bgg[]"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  value="0.00" placeholder="Ex.: 0,00" required></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" name="addBagage" id="addBagage">
                                                            <i class="fa fa-plus"></i>&nbsp;Adicionar
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="id_bgg" id="id_bgg">
                                        <button type="submit" class="bt_adm_add_bagaem btn btn-success" id="salvaBagagem">
                                            <span class="btn-label">
                                                <i class="material-icons">check</i>
                                            </span>
                                            Salvar
                                            <div class="ripple-container"></div></button>
                                    </div>
                                </form>
                                <br>
                                <div class="alert alert-danger print-error-msgAddBgg" style="display:none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ===================   fim lista bagagem  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>