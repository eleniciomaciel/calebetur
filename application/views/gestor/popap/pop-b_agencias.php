<!-- Modal -->
<div class="modal fade" id="listaAgenciasModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Lista das agencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addAgenciaModal">
                        <i class="fa fa-plus"></i> Cadastrar
                    </button>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Agencias</h4>
                            <p class="card-category"> Agências cadastradas</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="lista_todas_as_agencias" style="width: 100%;">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>Agência</th>
                                            <th>Telefone</th>
                                            <th>Email</th>
                                            <th>Cidade</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- cadastrar agencia -->
<div class="modal fade" id="addAgenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar agencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //form -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Agência</h4>
                            <p class="card-category">Dados da agencia de atendimento</p>
                        </div>
                        <div class="card-body">
                            <form autocomplete="off" id="form_add_agencia">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Nome da agência</label>
                                            <input type="text" class="form-control" name="nome_ag">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Telefone:</label>
                                            <input type="tel" class="form-control" name="telefone_ag" id="telefone_ag">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Email empresarial:</label>
                                            <input type="email" class="form-control" name="email_ag">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">UF:</label>
                                            <select class="form-control" name="selectUf_ag" id="selectUf_ag">
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Cidade:</label>
                                            <select class="form-control" name="cidade_ag" id="cidade_ag">
                                                <option selected disabled>Selecione aqui...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Bairro:</label>
                                            <input type="text" class="form-control" name="bairro_ag">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Endereço:</label>
                                            <input type="text" class="form-control" name="endereco_ag">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="bt_env_ag btn btn-primary" id="agenciaTextEnviar">Salvar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg_addAgencia" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- //fim form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- visualiza e altera agencia -->
<div class="modal fade" id="viewAlteraAgenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar agencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //form -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Editar agência</h4>
                            <p class="card-category">Dados das agencias cadatradas</p>
                        </div>
                        <div class="card-body">
                            <form autocomplete="off" id="form_vw_up_agencia">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="bmd-label-floating">Nome da agência</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="vw_up_nome" id="vw_up_nome">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Telefone:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="tel" class="form-control" name="vw_up_telefone" id="vw_up_telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Email empresarial:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="email" class="form-control" name="vw_up_email" id="vw_up_email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">UF:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="vw_up_estado" id="vw_up_estado">
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
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Cidade:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="vw_up_cidade" id="vw_up_cidade">
                                            <?php
                                                $query = $this->db->get('cidade');
                                                foreach ($query->result() as $row) {
                                                ?>
                                                    <option class="text-dark" value="<?php echo $row->id; ?>"><?php echo $row->nome; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Bairro:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="vw_up_bairro" id="vw_up_bairro">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Endereço:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="vw_up_endereco" id="vw_up_endereco">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="vw_id_ag" id="vw_id_ag">
                                <button type="submit" class="bt_env_ag_upt btn btn-primary" id="agenciaTextEnviar_upt">Alterar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg_addAgencia" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- //fim form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>