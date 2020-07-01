<!-- Modal -->
<div class="modal fade" id="addUsuariosstaticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //form -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Cadastrar usuário</h4>
                            <p class="card-category">Dados do usuário do sistema</p>
                        </div>
                        <div class="card-body">
                            <form id="form_add" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Usuário:</label>
                                            <input type="text" class="form-control" name="ges_nome" id="ges_nome">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Agência:</label>
                                            <select class="form-control" name="user_agencias" id="user_agencias"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Telefone:</label>
                                            <input type="tel" class="form-control" name="ges_telefone" id="ges_telefone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Email pessoal:</label>
                                            <input type="email" class="form-control" name="ges_email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Nível:</label>
                                            <select class="form-control my_motor_one" name="ges_nivel" id="ges_nivel">
                                                <option selected disabled>Selecione aqui...</option>
                                                <option class="text-dark" value="administrador">Administrador</option>
                                                <option class="text-dark" value="gestor">Gestor</option>
                                                <option class="text-dark" value="socio">Sócio</option>
                                                <option class="text-dark" value="Motorista">Motorista</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Estado:</label>
                                            <select class="form-control" name="selectUf" id="selectUf">
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
                                            <select class="form-control" name="city" id="city">
                                                <option selected disabled>Selecione aqui...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Endereço:</label>
                                            <input type="text" class="form-control" name="ges_endereco" id="ges_endereco">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="" id="chkPassport">
                                        Dados do motorista
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>


                                <div class="col-md-12" id="dvPassport" style="display: none">
                                    <div class="card">
                                        <div class="card-header card-header-text card-header-primary">
                                            <div class="card-text">
                                                <h4 class="card-title text-white">Informaçãoes quando motorista</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!-- ===================   dados form motorista  ============================= -->

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Nº da CNH:</label>
                                                        <input type="text" class="form-control" name="mt_num_cnh">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Data de validade:</label>
                                                        <input type="date" class="form-control" name="mt_data_validade_cnh">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Categoria:</label>
                                                        <select class="form-control" name="mt_categoria_cnh" id="mt_categoria_cnh">
                                                            <option selected disabled>Selecione aqui...</option>
                                                            <option class="text-dark" value="A">A</option>
                                                            <option class="text-dark" value="AB">AB</option>
                                                            <option class="text-dark" value="B">B</option>
                                                            <option class="text-dark" value="D">D</option>
                                                            <option class="text-dark" value="E">E</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">RG:</label>
                                                        <input type="text" class="form-control" name="mt_rg_motor">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">CPF:</label>
                                                        <input type="text" class="form-control" name="mt_cpf_motor">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Telefone de emegência</label>
                                                        <input type="tel" class="form-control" name="mt_tel_motor">
                                                    </div>
                                                </div>
                                            </div>
                                            <h5>Dados bancário</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Banco</label>
                                                        <input type="text" class="form-control" name="mt_banco">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Tipo de conta</label>
                                                        <select class="form-control" name="mt_tipo_conta" id="mt_tipo_conta">
                                                            <option selected disabled>Selecione aqui...</option>
                                                            <option class="text-dark" value="CC">Conta Corrente</option>
                                                            <option class="text-dark" value="CP">Conta Poupança</option>
                                                            <option class="text-dark" value="CE">Conta Empresarial</option>
                                                            <option class="text-dark" value="CD">Conta Digital</option>
                                                            <option class="text-dark" value="CU">Conta Universitária</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Nome da conta</label>
                                                        <input type="text" class="form-control" name="mt_nome_conta">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Nº da conta</label>
                                                        <input type="text" class="form-control" name="mt_numero_conta">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Operação</label>
                                                        <input type="text" class="form-control" name="mt_conta_op">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Nº do banco</label>
                                                        <input type="text" class="form-control" name="mt_num_banco">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Observações do motorista</label>
                                                        <div class="form-group bmd-form-group">
                                                            <label class="bmd-label-floating"> Digite aqui...</label>
                                                            <textarea class="form-control" rows="5" name="mt_observe"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ===================   fim form  ============================= -->
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="bt_env_dis btn btn-info" id="logTextEnviar">
                                    Salvar <span id="msgEnviando_env"></span>
                                </button>

                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
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


<!-- Modal visualiza altera dados do usuário-->
<div class="modal fade" id="viewUsuariosstaticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //form -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Alterar dados do usuário</h4>
                            <p class="card-category">Dados do usuário do sistema</p>
                        </div>
                        <div class="card-body">
                            <form id="form_altera" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Usuário:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="user_nome" id="user_nome">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Telefone:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="tel" class="form-control" name="user_tel" id="user_tel">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Email pessoal:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="email" class="form-control" name="user_email" id="user_email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Nível:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="user_nivel" id="user_nivel">
                                                <option selected disabled>Selecione aqui...</option>
                                                <option class="text-dark" value="administrador">Administrador</option>
                                                <option class="text-dark" value="B">B</option>
                                                <option class="text-dark" value="socio">Sócio</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Estado:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="user_estado" id="user_estado">
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
                                            <select class="form-control" name="user_cidade" id="user_cidade">
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
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Endeeço:</label>
                                        <div class="form-group bmd-form-group">

                                            <input type="text" class="form-control" name="user_endereco" id="user_endereco">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="user_id">
                                <button type="submit" class="bt_env_dis_aletra btn btn-primary" id="logTextEnviar_altera">Alterar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msg_update" style="display:none"></div>
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


<!-- Modal autenticação-->
<div class="modal fade" id="authstaticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Permissões do usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- // card -->
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Permissão do usuário</h4>
                    <div class="card-body">
                        <h4 class="card-title">Autenticação das pemissões</h4>

                        <ul class="list-group">
                            <li class="list-group-item active text-white">Cras justo odio</li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        Alterar<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        Editar <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option2">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        Excluir <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option3">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        Consultar <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option4">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>

                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Dapibus ac facilisis in
                                <span class="badge badge-primary badge-pill">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Morbi leo risus
                                <span class="badge badge-primary badge-pill">1</span>
                            </li>
                        </ul>

                    </div>
                </div>
                <!-- // card -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal permissap-->
<div class="modal fade" id="permissaostaticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Permissão de acesso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- // car permissao -->
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-warning">
                        Status da permissão
                    </div>
                    <div class="card-body">

                        <?php echo form_open('colabora_status', array('id' => 'statusDoUser')) ?>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" id="user_nome_st" class="form-control">
                            </div>
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="customSwitch1" id="customSwitch1" value="0">
                                    <label class="custom-control-label" for="customSwitch1">
                                        <span id="vll">Status de acesso!</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="auth_id" id="auth_id">
                        </form>

                    </div>
                </div>
                <!-- // car permissao -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal login usuarios-->
<div class="modal fade" id="loginstaticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Loguin de acesso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-nav-tabs">
                    <div class="card-header card-header-warning">
                        Dados do loguin
                    </div>
                    <div class="card-body">

                        <form id="form_login">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Usuário:</label>
                                    <input type="text" class="form-control" id="user_log_nome" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email pessoal</label>
                                    <input type="text" class="form-control" id="user_log_email" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Login do usuário:</label>
                                    <input type="text" class="form-control" name="user_log_login" id="user_log_login" placeholder="Ex.: ana@login.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Senha do usuário:</label>
                                    <input type="text" class="form-control" name="user_log_pw" placeholder="Ex.: 123">
                                </div>

                                <input type="hidden" name="loguin_id" id="loguin_id">
                                <button type="submit" class="bt_env_pw btn btn-warning" id="logTextGeraPw">Salvar</button>
                            </div>
                        </form>
                        <br>
                        <div class="alert alert-danger print-error-msgLoguin" style="display:none"></div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================   lista dados do motorista  ============================= -->

<div class="modal fade" id="usuarioMotoristaPanel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Informações do motorista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   form dados motorista  ============================= -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">Motorista</h4>
                            <p class="card-category">Informações do motorista</p>
                        </div>
                        <div class="card-body">
                            <form id="form_altera_motorista_ADM">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="bmd-label-floating">Nome:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_nome" id="drive_nome">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Telefone:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="tel" class="form-control" name="drive_tele" id="drive_tele">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Email pessoal:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="email" class="form-control" name="drive_emai" id="drive_emai">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="bmd-label-floating">Endereço:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_ende" id="drive_ende">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Telefône de emegência:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="tel" class="form-control" name="drive_telm" id="drive_telm">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Cidade:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_cida" id="drive_cida" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="bmd-label-floating">Estado:</label>
                                        <div class="form-group bmd-form-group">

                                            <input type="text" class="form-control" name="drive_ufes" id="drive_ufes" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="bmd-label-floating">Agência:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_agen" id="drive_agen" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Função:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_nive" id="drive_nive" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Endereço:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_ende" id="drive_ende">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">CNH</label>
                                        <div class="form-group bmd-form-group">

                                            <input type="text" class="form-control" name="drive_cnhh" id="drive_cnhh">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Validade CNH</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="date" class="form-control" name="drive_dtvl" id="drive_dtvl">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Categoria CNH</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="drive_catg" id="drive_catg">
                                                <option class="text-dark" value="A">A</option>
                                                <option class="text-dark" value="AB">AB</option>
                                                <option class="text-dark" value="B">B</option>
                                                <option class="text-dark" value="C">C</option>
                                                <option class="text-dark" value="D">D</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">RG:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_rggg" id="drive_rggg">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">CPF:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_cpff" id="drive_cpff">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Banco:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_baco" id="drive_baco">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Nome da conta:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_nocont" id="drive_nocont">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Número da conta:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_nunco" id="drive_nunco">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="bmd-label-floating">Operação:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_contop" id="drive_contop">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Tipo de conta:</label>
                                        <div class="form-group bmd-form-group">
                                            <select class="form-control" name="drive_tip_cont" id="drive_tip_cont">
                                                <option class="text-dark" value="CC">Conta corrente</option>
                                                <option class="text-dark" value="CP">Conta poupança</option>
                                                <option class="text-dark" value="CE">Conta empresarial</option>
                                                <option class="text-dark" value="CU">Conta universitária</option>
                                                <option class="text-dark" value="CH">Conta digital</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Número da conta:</label>
                                        <div class="form-group bmd-form-group">
                                            <input type="text" class="form-control" name="drive_nomeb" id="drive_nomeb">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <div class="form-group bmd-form-group">
                                                <textarea class="form-control" rows="5" name="drive_obser" id="drive_obser"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_mtvw" id="id_mtvw">
                                <button type="submit" class="btn btn-info">Alterar</button>
                                <div class="clearfix"></div>
                            </form>
                            <br>
                            <div class="alert alert-danger print-error-msgMtUp" style="display:none"></div>
                        </div>
                    </div>
                </div>
                <!-- ===================   form fim motorista  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>