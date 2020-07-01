<?php
    $user = $this->session->userdata('user');
    extract($user);
?>
<!-- Button trigger modal -->
<div class="modal fade" id="listaTodosClientesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clientes cadastrados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   car clienet  ============================= -->
                <div class="col-md-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">menu_book</i>
                            </div>
                            <p class="card-category">Clientes cadastrados</p>
                        </div>
                        <!-- ===================   table  ============================= -->
                        <div class="card-body">
                            <button type="button" class="btn btn-warning pull-left" data-toggle="modal" data-target="#addClientesModal">
                                <i class="material-icons"> add </i>&nbsp;Adicionar
                            </button>
                            <div class="table-responsive">
                            <table class="table table-striped table-dark" id="lista_todos_clientes" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Telefone de contato</th>
                                        <th scope="col">Nascimento</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- ===================   fim tabela  ============================= -->
                    </div>
                </div>
                <!-- ===================   car cliente  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- adiciona cliente modal -->
<div class="modal fade" id="addClientesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   car clienet  ============================= -->
                <div class="col-md-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person_add</i>
                            </div>

                        </div>
                        <!-- ===================   table  ============================= -->
                        <div class="card-body">
                            <!-- ===================   form  ============================= -->
                            <form autocomplete="off" id="add_form_cliente">
                                <?php
                                    $csrf = array(
                                        'name' => $this->security->get_csrf_token_name(),
                                        'hash' => $this->security->get_csrf_hash()
                                    );
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label class="pull-left" for="inputNomeCliente">Nome completo:</label>
                                        <input type="text" class="form-control" name="inputNomeCliente" id="inputNomeCliente">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputTelCliente">Telefone pessoal:</label>
                                        <input type="tel" class="form-control" name="inputTelCliente" id="inputTelCliente">
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputTelContato">Telefone de contato:</label>
                                        <input type="tel" class="form-control" name="inputTelContato" id="inputTelContato">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="select_estados">Estado</label>
                                        <select name="select_estados" id="select_estados" class="form-control">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php
                                            $variable = $this->db->get('estado');
                                            foreach ($variable->result() as $key ) {
                                                ?>
                                                    <option class="text-dark" value="<?php echo $key->id?>"><?php echo $key->nome;?></option>
                                                <?php
                                            }
                                            
                                            ?> 
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputState">Cidade:</label>
                                        <select id="cidade_cliente" name="cidade_cliente" class="form-control"></select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inpuCliente_rg">RG:</label>
                                        <input type="text" class="form-control" name="inpuCliente_rg" id="inpuCliente_rg">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputCliente_cf">CPF:</label>
                                        <input type="text" class="form-control" name="inputCliente_cf" id="inputCliente_cf">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputCliente_nc">Data de nascimento:</label>
                                        <input type="date" class="form-control" name="inputCliente_nc" id="inputCliente_nc">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="cliente_observe">Observações</label>
                                    <textarea class="form-control" name="cliente_observe" id="cliente_observe" rows="3" placeholder="Digite sua observação aqui..."></textarea>
                                </div>

                                <input type="hidden" name="cliente_agente_id" id="agente_id" value="<?php echo $us_id; ?>">
                                <input type="hidden" name="cliente_agencia_id" id="agencia_id" value="<?php echo $us_agencia_fk; ?>">

                                <button type="submit" class="bt_adm_cli btn btn-success pull-left" id="clienteADMEnviar">
                                    <i class="material-icons">save</i>&nbsp;Salvar
                                </button>
                            </form>
                            <!-- ===================   fim doem  ============================= -->
                        </div>
                        <br>
                            <div class="alert alert-danger print-error-msgAddPassageiro" style="display:none"></div>
                        <!-- ===================   fim tabela  ============================= -->
                    </div>
                </div>
                <!-- ===================   car cliente  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================   visualiza cliente  ============================= -->
<!-- adiciona cliente modal -->
<div class="modal fade" id="viewClientesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ===================   car clienet  ============================= -->
                <div class="col-md-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person_add</i>
                            </div>

                        </div>
                        <!-- ===================   table  ============================= -->
                        <div class="card-body">
                            <!-- ===================   form  ============================= -->
                            <form autocomplete="off" id="altera_form_cliente">
                                <?php
                                    $csrf = array(
                                        'name' => $this->security->get_csrf_token_name(),
                                        'hash' => $this->security->get_csrf_hash()
                                    );
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label class="pull-left" for="agCli_nome">Nome completo:</label>
                                        <input type="text" class="form-control" name="agCli_nome" id="agCli_nome">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="agCli_tel_p">Telefone pessoal:</label>
                                        <input type="tel" class="form-control" name="agCli_tel_p" id="agCli_tel_p">
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="agCli_tele_c">Telefone de contato:</label>
                                        <input type="tel" class="form-control" name="agCli_tele_c" id="agCli_tele_c">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="agCli_esta">Estado</label>
                                        <select name="agCli_esta" id="agCli_esta" class="form-control">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php
                                            $variable = $this->db->get('estado');
                                            foreach ($variable->result() as $key ) {
                                                ?>
                                                    <option class="text-dark" value="<?php echo $key->id?>"><?php echo $key->nome;?></option>
                                                <?php
                                            }
                                            
                                            ?> 
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="agCli_cida">Cidade:</label>
                                        <select id="agCli_cida" name="agCli_cida" class="form-control"><
                                        <?php
                                            $variable = $this->db->get('cidade');
                                            foreach ($variable->result() as $key ) {
                                                ?>
                                                    <option class="text-dark" value="<?php echo $key->id?>"><?php echo $key->nome;?></option>
                                                <?php
                                            }
                                            
                                            ?> 
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="agCli_rg">RG:</label>
                                        <input type="text" class="form-control" name="agCli_rg" id="agCli_rg">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="agCli_cpf">CPF:</label>
                                        <input type="text" class="form-control" name="agCli_cpf" id="agCli_cpf">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="agCli_naci">Data de nascimento:</label>
                                        <input type="date" class="form-control" name="agCli_naci" id="agCli_naci">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="agCli_observ">Observações</label>
                                    <textarea class="form-control" name="agCli_observ" id="agCli_observ" rows="3" placeholder="Digite sua observação aqui..."></textarea>
                                </div>
                                <input type="hidden" name="id_cli" id="id_cli">
                                <button type="submit" class="bt_adm_cli_altera btn btn-danger pull-left" id="clienteADMEnviar_altera">
                                    <i class="material-icons">refresh</i>&nbsp;Alterar
                                </button>
                            </form>
                            <!-- ===================   fim doem  ============================= -->
                        </div>
                        <br>
                            <div class="alert alert-danger print-error-msgAalteraPassageiro" style="display:none"></div>
                        <!-- ===================   fim tabela  ============================= -->
                    </div>
                </div>
                <!-- ===================   car cliente  ============================= -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>