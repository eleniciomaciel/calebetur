<!-- Modal -->
<div class="modal fade" id="manutencaoModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Lançar carro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">directions_bus</i>
                            </div>
                        </div>
                        <div class="card-body">

                            <h4 class="card-title">Adicionar carro para a manutenção</h4>

                            <form>
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control selectpicker" data-style="btn btn-link" name="add_car_manutencao" id="add_car_manutencao">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php
                                            $query = $this->db->get('veiculos');
                                            foreach ($query->result() as $row) {
                                            ?>
                                                <option class="text-dark" value="<?php echo $row->id_veic; ?>">Placa ==> <?php echo $row->placa_veic . ' - Marca ==> ' . $row->marca_veic; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <button class="bt_env_car_manutencao btn__manutencao_submit btn btn-primary btn-round" id="carroManutencaoTextEnviar">
                                    <i class="material-icons">save</i> Salvar
                                </button>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msgCarVeiculoManutencao" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- card -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>


<!-- ===================   lista peças do carro da manutenção  ============================= -->

<div class="modal fade" id="ListaPecasCarroManutencaoModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Histórico de peças</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   tabela peças  ============================= -->
                <div id="result_table_pecas"></div>
                <!-- ===================   fim tabela lista peças  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================   adiciona peças dinamicamente  ============================= -->

<div class="modal fade" id="addPecasModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Peças</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================  formulario de cadastro   ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">Placa:&nbsp;<span id="plc_car"></span> </h4>
                            <p class="category">Marca:&nbsp;<span id="plc_marca"></span></p>
                        </div>
                        <div class="card-body">
                            <!-- ===================   tabela de add  ============================= -->
                            <form name="add_name" id="formPiecasAdd" autocomplete="off">
                            <input type="hidden" id="csrf" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" /> 
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <thead>
                                            <tr>
                                                <th scope="col">Descrição</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Valor</th>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <th scope="row">Nº da nota de compras</th>
                                            <td colspan="3">
                                                <input type="text" name="addNotaCompras" placeholder="Ex.: 12544" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="addmorepecaNome" id="addmorepecaNome" placeholder="Ex.: Freios" class="form-control name_list" />
                                            </td>
                                            <td>
                                                <input type="text" name="addmoreQuantidade" id="addmoreQuantidade" placeholder="Ex.: 5" class="form-control name_list" />
                                            </td>
                                            <td>
                                                <input type="text" name="addmorePrecos" id="addmorePrecos" placeholder="Ex.: 150,00" class="form-control name_list" />
                                            </td>
                                        </tr>

                                    </table>
                                    <input type="hidden" name="id_car_pecas" id="id_car_pecas">
                                    <input type="hidden" name="id_caro_manutencao" id="id_caro_manutencao">

                                    <input type="submit" name="submit" id="submit" class="btn_submit_dynamic btn btn-info" value="Salvar" />
                                </div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msgAddPiecasDynamic" style="display:none"></div>
                            <!-- ===================   fim table  ============================= -->
                        </div>
                    </div>
                </div>




                <!-- ===================  formulario de cadastro   ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>