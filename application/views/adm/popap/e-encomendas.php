<div class="modal fade" id="clientesEncomendaDessaViagem" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Clientes com encomenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   lista clientes encomenda  ============================= -->
                <div class="col-md-12">
                    <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#cadastraDOnoEncomenda">
                        <i class="material-icons">person_add</i> Cadastrar
                        <div class="ripple-container"></div>
                    </button>

                    <!-- ===================   info viagem  ============================= -->
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>
                            <h5>Informações da viagem</h5>
                            Viagem - <b id="enc_progran_loc_s"> </b>
                            Data - <b id="enc_progran_data_sai"> </b>
                            Hora - <b id="enc_progran_hora_sai"> </b>
                            Cod.: Viagem: - <b id="enc_progran_key"> </b>
                        </span>
                    </div>
                    <!-- ===================   fim info  ============================= -->
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title text-white">Encomendas da viagem</h4>
                        </div>
                        <div class="card-body">

                            <div id="resultEncomendas"></div>


                        </div>
                    </div>
                </div>
                <!-- ===================   lista clientes encomenda  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================   cadastrar usuario encomendas  ============================= -->

<div class="modal fade" id="cadastraDOnoEncomenda" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar dono da emcomenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   form  ============================= -->
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">how_to_reg</i>
                            </div>
                            <h4 class="card-title">Cliente da encomenda</h4>
                        </div>
                        <div class="card-body ">

                            <form id="form_encomenda">

                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Cliente (Digite o número do cpf):</label>
                                        <div class="ui-widget form-group bmd-form-group">
                                            <input type="text" class="form-control" name="cpf_clienteEncomenda" id="cpf_clienteEncomenda">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Nome do cliente:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="user_cliente_encom" id="user_cliente_encom"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Destinatário:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="destin_name" id="destin_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Telefone do destinatário:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="tel" class="form-control" name="destin_tel" id="destin_tel">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">RG do destinatário:</label>
                                            <input type="text" class="form-control" name="destin_rg" id="destin_rg">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Local do recebimento:</label>
                                            <input type="text" class="form-control" name="destin_loal_retirada" id="destin_loal_retirada">
                                        </div>
                                    </div>
                                </div>


                                <table class="table table-dark" id="dinamycEncomenda">
                                    <thead>
                                        <tr>
                                            <th scope="col">Descrição do produto</th>
                                            <th scope="col">Cód.:</th>
                                            <th scope="col">Qtd.:</th>
                                            <th scope="col">Valor.:</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><input class="form-control" type="text" name="desc_encom[]" placeholder="Digite aqui..." required></th>
                                            <td><input class="form-control" type="text" name="cod_encom[]" placeholder="Código aqui..." required></td>
                                            <td><input class="form-control" type="number" name="qtd_encom[]" placeholder="Ex.: 2" required></td>
                                            <td><input class="form-control" type="number" name="valor_encom[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="0.00" placeholder="Ex.: 0,00" required></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" name="addEncomenda" id="addEncomenda">
                                                    <i class="fa fa-plus"></i>&nbsp;Adicionar
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observação</label>
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-floating"> Digite aqui a observação...</label>
                                                <textarea class="form-control" rows="5" name="destin_observe" id="destin_observe"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id_encomenda" id="id_encomenda">

                                <button type="submit" class="bt_adm_add_encomenda btn btn-primary" id="salvaEncomenda">Salvar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msgAddEncomenda" style="display:none"></div>
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

<!-- ===================   encomenda do remetente  ============================= -->

<div class="modal fade" id="remetenteEncomendaLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Encomenda do remetente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   tabela  ============================= -->
                <div id="result_listaEncomendasOne"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================   altera status do produto  ============================= -->

<!-- Modal -->
<div class="modal fade" id="statusProdutoAltera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Altera status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   form  ============================= -->
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">archive</i>
                            </div>
                            <h4 class="card-title">Descrição:</h4>
                            <p>
                                Produto: <span id="enc_prog_descricao"></span> -
                                Cód.: <span id="enc_pro_codigo"></span>
                            </p>
                        </div>
                        <div class="card-body ">
                            <form id="alterStatusProdutoAgencia">
                            <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                            ?>
                            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <div class="form-group bmd-form-group">
                                    <label for="exampleEmail" class="bmd-label-floating">Status do produto</label>
                                    <select class="form-control" name="sts_product" id="sts_product">
                                        <option class="text-dark" value="0">Aguardando</option>
                                        <option class="text-dark" value="1">Embarcado</option>
                                        <option class="text-dark" value="2">No destino</option>
                                        <option class="text-dark" value="3">Entregue</option>
                                    </select>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-fill btn-rose">Alterar</button>
                                </div>
                                <input type="hidden" name="is_sts_one_altera" id="is_sts_one_altera">
                            </form>
                        </div>

                    </div>
                </div>
                <!-- ===================   form  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>