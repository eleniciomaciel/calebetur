<!-- Modal -->
<div class="modal fade" id="listaEtinarioModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Etinerários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Card lista -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-rose">
                            <div class="card-icon">
                                <i class="material-icons">language</i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Localidades atendidas</h4>
                            <br>
                            <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#localAtendeModalCenter">
                                <i class="material-icons">add</i> Adicionar
                            </button>
                            <!-- Table lista -->
                            <div class="table-responsive">
                                <table class="table" id="lista_das_localidades" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>UF</th>
                                            <th>Cidade</th>
                                            <th>Local</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>

                            <!-- Table lista -->
                        </div>
                    </div>
                </div>
                <!-- Card lista -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal adiciona localidades-->
<div class="modal fade" id="localAtendeModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Localidades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //card -->
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Cadastrar localidades</h4>
                    <div class="card-body">
                        <!-- //form -->
                        <form id="form_add_local">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputStateUf">Estado:</label>
                                    <select id="inputStateUf" name="inputStateUf" class="form-control">
                                        <option selected disabled>Selecione aqui...</option>
                                        <?php
                                        $query = $this->db->get('estado');
                                        foreach ($query->result() as $row) {
                                        ?>
                                            <option class="text-dark" value="<?php echo $row->id; ?>"><?php echo $row->nome; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cidade_atende">Cidade</label>
                                    <select name="cidade_atende" id="cidade_atende" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="localAtende">Local de parada</label>
                                <input type="text" class="form-control" name="localAtende" id="localAtende" maxlength="200" placeholder="Ex.: Centro">
                            </div>
                            <button type="submit" id="localTextEnviar" class="bt_env_loc btn btn-primary">Salvar</button>
                        </form>
                        <!-- //form -->
                        <br>
                        <div class="alert alert-danger print-error-msgAddLocal" style="display:none"></div>
                    </div>
                </div>
                <!-- //fim card -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>