<script>
    $(document).ready(function() {

        $(function() {
            $("#chkPassport").click(function() {
                if ($(this).is(":checked")) {
                    $("#dvPassport").show();
                    $("#AddPassport").hide();
                } else {
                    $("#dvPassport").hide();
                    $("#AddPassport").show();
                }
            });
        });
        carregaTotalUser();
        $('#ges_telefone').mask('(00)9. 0000-0000');
        //carregarAgencias();

        var dataTable = $('#lista_todos_usuarios').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?php echo site_url('get_users'); ?>",
                type: 'GET'
            },
        });

        var dataTablemoto = $('#lista_usuarios_motoristas').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('lista-usuarios-motoristas') ?>",
                type: 'GET'
            },
        });


        $("#form_add").submit(function(e) {
            e.preventDefault();

            $('#logTextEnviar').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando, aguarde...').prop("disabled", true);
            $(".bt_env_dis").prop("disabled", true);

            let ges_nome = $("input[name='ges_nome']").val();
            let user_agencias = $("select[name='user_agencias']").val();
            let ges_telefone = $("input[name='ges_telefone']").val();
            let ges_email = $("input[name='ges_email']").val();
            let ges_nivel = $("select[name='ges_nivel']").val();
            let selectUf = $("select[name='selectUf']").val();
            let city = $("select[name='city']").val();
            let ges_endereco = $("input[name='ges_endereco']").val();

            /**dados motorista */
            let mt_num_cnh = $("input[name='mt_num_cnh']").val();
            let mt_data_validade_cnh = $("input[name='mt_data_validade_cnh']").val();
            let mt_categoria_cnh = $("select[name='mt_categoria_cnh']").val();
            let mt_rg_motor = $("input[name='mt_rg_motor']").val();
            let mt_cpf_motor = $("input[name='mt_cpf_motor']").val();
            let mt_tel_motor = $("input[name='mt_tel_motor']").val();
            let mt_banco = $("input[name='mt_banco']").val();
            let mt_tipo_conta = $("select[name='mt_tipo_conta']").val();
            let mt_nome_conta = $("input[name='mt_nome_conta']").val();
            let mt_numero_conta = $("input[name='mt_numero_conta']").val();
            let mt_conta_op = $("input[name='mt_conta_op']").val();
            let mt_num_banco = $("input[name='mt_num_banco']").val();
            let mt_observe = $("input[name='mt_observe']").val();

            var login = function() {
                $.ajax({
                    url: "<?php echo site_url('form_addUser'); ?>",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        ges_nome: ges_nome,
                        user_agencias: user_agencias,
                        ges_telefone: ges_telefone,
                        ges_email: ges_email,
                        ges_nivel: ges_nivel,
                        selectUf: selectUf,
                        city: city,
                        ges_endereco: ges_endereco,
                        /**dados motorista */
                        mt_num_cnh: mt_num_cnh,
                        mt_data_validade_cnh: mt_data_validade_cnh,
                        mt_categoria_cnh: mt_categoria_cnh,
                        mt_rg_motor: mt_rg_motor,
                        mt_cpf_motor: mt_cpf_motor,
                        mt_tel_motor: mt_tel_motor,
                        mt_banco: mt_banco,
                        mt_tipo_conta: mt_tipo_conta,
                        mt_nome_conta: mt_nome_conta,
                        mt_numero_conta: mt_numero_conta,
                        mt_conta_op: mt_conta_op,
                        mt_num_banco: mt_num_banco,
                        mt_observe: mt_observe,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $(".print-error-msg").css('display', 'none');
                            swal("OK!", data.success, "success");
                            $('#form_add')[0].reset();
                            dataTable.ajax.reload();
                            carregaTotalUser();
                            $('#logTextEnviar').html('Enviar');
                            $(".bt_env_dis").prop("disabled", false);

                        } else {
                            $(".print-error-msg").css('display', 'block');
                            $(".print-error-msg").html(data.error);

                            $('#logTextEnviar').html('Enviar');
                            $(".bt_env_dis").prop("disabled", false);

                        }
                    }
                });
            };
            setTimeout(login, 3000);
        });
        /**get lista cidades */
        $('select[name="selectUf"]').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: "<?php echo site_url('myform/ajax/') ?>" + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city"]').empty();

                        $('select[name="city"]').append('<option selected disabled>Selecione uma cidade aqui...</option>');
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option class="text-dark" value="' + value.id + '">' + value.nome + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city"]').empty();
            }
        });

        /**visualiza altera dados do usuario */
        $(document).on('click', '.view_gesto_user', function() {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('view_user/'); ?>" + user_id,
                method: "GET",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(data) {
                    $('#viewUsuariosstaticBackdrop').modal('show');
                    $('#user_nome').val(data.user_nome);
                    $('#user_tel').val(data.user_tel);
                    $('#user_email').val(data.user_email);
                    $('#user_endereco').val(data.user_endereco);
                    $('#user_cidade').val(data.user_cidade);
                    $('#user_estado').val(data.user_estado);
                    $('#user_nivel').val(data.user_nivel);
                    $('#user_id').val(user_id);
                }
            })
        });

        /**altera dados do usuario */
        $("#form_altera").submit(function(e) {
            e.preventDefault();

            $('#logTextEnviar_altera').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Alterando, aguarde...').prop("disabled", true);
            $(".bt_env_dis_aletra").prop("disabled", true);

            let user_id = $("input[name='user_id']").val();
            let user_nome = $("input[name='user_nome']").val();
            let user_tel = $("input[name='user_tel']").val();
            let user_email = $("input[name='user_email']").val();
            let user_nivel = $("select[name='user_nivel']").val();
            let user_estado = $("select[name='user_estado']").val();
            let user_cidade = $("select[name='user_cidade']").val();
            let user_endereco = $("input[name='user_endereco']").val();

            $.ajax({
                url: "<?php echo site_url('form_alteraUser/'); ?>" + user_id,
                type: 'POST',
                dataType: "json",
                data: {
                    user_id: user_id,
                    user_nome: user_nome,
                    user_tel: user_tel,
                    user_email: user_email,
                    user_nivel: user_nivel,
                    user_estado: user_estado,
                    user_cidade: user_cidade,
                    user_endereco: user_endereco,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg_update").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#form_altera')[0].reset();
                        dataTable.ajax.reload();

                        $('#logTextEnviar_altera').html('Alterar');
                        $(".bt_env_dis_aletra").prop("disabled", false);

                    } else {
                        $(".print-error-msg_update").css('display', 'block');
                        $(".print-error-msg_update").html(data.error);

                        $('#logTextEnviar_altera').html('Alterar');
                        $(".bt_env_dis_aletra").prop("disabled", false);

                    }
                }
            });
        });

        /**get autenticação */
        $(document).on('click', '.auth_view', function() {
            var auth_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('view_user/'); ?>" + auth_id,
                method: "GET",
                data: {
                    auth_id: auth_id
                },
                dataType: "json",
                success: function(data) {
                    $('#authstaticBackdrop').modal('show');
                    $('#user_nome').val(data.user_nome);
                    $('#user_email').val(data.user_email);
                    $('#auth_id').val(auth_id);
                }
            })
        });

        /**get permissão de acesso */
        $(document).on('click', '.access_user', function() {
            var auth_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('view_user/'); ?>" + auth_id,
                method: "GET",
                data: {
                    auth_id: auth_id
                },
                dataType: "json",
                success: function(data) {
                    $('#permissaostaticBackdrop').modal('show');
                    $('#user_nome_st').val(data.user_nome);
                    $('#customSwitch1').val(data.user_status).prop('checked', function(_, checked) {
                        return !checked;
                    });

                    $('#auth_id').val(auth_id);
                }
            })
        });

        /**pega status */
        $('input[name="customSwitch1"]').click(function() {
            if ($(this).prop("checked") == true) {
                $('#vll').html("Acesso liberado");

                let auth_id = $("input[name='auth_id']").val();
                let customSwitch1 = $('#customSwitch1').is(':checked');


                $.ajax({
                    url: "<?= site_url('status_access/') ?>" + auth_id,
                    type: 'POST',
                    dataType: "json",
                    data: {
                        auth_id: auth_id,
                        customSwitch1: customSwitch1,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $(".print-error-msg_sts").css('display', 'none');
                            swal("OK!", data.success, "success");
                            dataTable.ajax.reload();
                        } else {
                            $(".print-error-msg_sts").css('display', 'block');
                            $(".print-error-msg_sts").html(data.error);
                        }
                    }
                });

            } else if ($(this).prop("checked") == false) {
                $('#vll').html("Acesso negado");

                let auth_id2 = $("input[name='auth_id']").val();
                let customSwitch1 = '0';


                $.ajax({
                    url: "<?= site_url('status_access/') ?>" + auth_id2,
                    type: 'POST',
                    dataType: "json",
                    data: {
                        auth_id2: auth_id2,
                        customSwitch1: customSwitch1,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $(".print-error-msg_sts").css('display', 'none');
                            swal("OK!", data.success, "success");
                            dataTable.ajax.reload();
                        } else {
                            $(".print-error-msg_sts").css('display', 'block');
                            $(".print-error-msg_sts").html(data.error);
                        }
                    }
                });
            }
        });

        /**get dados login */
        $(document).on('click', '.viewPanel_login', function() {
            var loguin_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('view_user/'); ?>" + loguin_id,
                method: "GET",
                data: {
                    loguin_id: loguin_id
                },
                dataType: "json",
                success: function(data) {
                    $('#loginstaticBackdrop').modal('show');
                    $('#user_log_nome').val(data.user_nome);
                    $('#user_log_email').val(data.user_email);
                    $('#user_log_login').val(data.user_login);
                    $('#loguin_id').val(loguin_id);
                }
            })
        });

        /**inseri senha e login */
        $(document).on('submit', '#form_login', function(event) {
            event.preventDefault();

            $('#logTextGeraPw').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Salvando acesso, aguarde...').prop("disabled", true);
            $(".bt_env_pw").prop("disabled", true);

            var user_log_login = $("input[name='user_log_login']").val();
            var user_log_pw = $("input[name='user_log_pw']").val();
            var loguin_id = $("input[name='loguin_id']").val();


            $.ajax({
                url: "<?= site_url('save-acesso-user/') ?>" + loguin_id,
                type: 'POST',
                dataType: "json",
                data: {
                    user_log_login: user_log_login,
                    user_log_pw: user_log_pw,
                    loguin_id: loguin_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgLoguin").css('display', 'none');
                        swal("OK!", data.success, "success");

                        $('#logTextGeraPw').html('Salvar');
                        $(".bt_env_pw").prop("disabled", false);

                    } else {
                        $(".print-error-msgLoguin").css('display', 'block');
                        $(".print-error-msgLoguin").html(data.error);

                        $('#logTextGeraPw').html('Salvar');
                        $(".bt_env_pw").prop("disabled", false);

                    }
                }
            });
        });

        /**deleta usuario */
        $(document).on('click', '.deleteUser', function() {
            var elete_us_id = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Ao deletar essa ação será permanente!",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?= site_url('deleta-usuario/') ?>" + elete_us_id,
                            method: "POST",
                            data: {
                                elete_us_id: elete_us_id,
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                dataTable.ajax.reload();
                            }
                        });


                    } else {
                        swal("Você desistiu de alterar!");
                    }
                });
        });

        /**get soma dados usuarios */
        function carregaTotalUser() {
            $.get("<?php echo site_url('soma-usuarios'); ?>", function(data) {
                $(".result_users").html(data);
            });
        }

        /**lista dados do motorista */
        $(document).on('click', '.viewMotorUser', function() {
            var id_mtvw = $(this).attr("id");
            $.ajax({
                url: "<?=site_url('lista-dados-motorista-um/')?>" + id_mtvw,
                method: "GET",
                data: {
                    id_mtvw: id_mtvw
                },
                dataType: "json",
                success: function(data) {
                    $('#usuarioMotoristaPanel').modal('show');
                    $('#drive_nome').val(data.drive_nome);
                    $('#drive_tele').val(data.drive_tele);
                    $('#drive_emai').val(data.drive_emai);
                    $('#drive_ende').val(data.drive_ende);
                    $('#drive_cida').val(data.drive_cida);
                    $('#drive_ufes').val(data.drive_ufes);
                    $('#drive_agen').val(data.drive_agen);
                    $('#drive_nive').val(data.drive_nive);
                    $('#drive_telm').val(data.drive_telm);
                    $('#drive_cnhh').val(data.drive_cnhh);
                    $('#drive_dtvl').val(data.drive_dtvl);
                    $('#drive_catg').val(data.drive_catg);
                    $('#drive_rggg').val(data.drive_rggg);
                    $('#drive_cpff').val(data.drive_cpff);
                    $('#drive_baco').val(data.drive_baco);

                    $('#drive_nocont').val(data.drive_nocont);
                    $('#drive_tip_cont').val(data.drive_tip_cont);
                    $('#drive_nunco').val(data.drive_nunco);
                    $('#drive_contop').val(data.drive_contop);
                    $('#drive_nomeb').val(data.drive_nomeb);
                    $('#drive_obser').val(data.drive_obser);

                    $('#id_mtvw').val(id_mtvw);
                }
            })
        });

        /**altera dados motorista */
        $(document).on('submit', '#form_altera_motorista_ADM', function(event){  
           event.preventDefault(); 

	    	var str_form_altera_mt_one = $( "#form_altera_motorista_ADM" ).serialize();
            var id_mtvw = $("input[name='id_mtvw']").val();

	        $.ajax({
	            url: "<?=site_url('altera-dado-motorista-ativo/')?>" + id_mtvw,
	            type:'POST',
	            dataType: "json",
	            data: str_form_altera_mt_one,
	            success: function(data) {
	                if($.isEmptyObject(data.error)){
	                	$(".print-error-msgMtUp").css('display','none');
                        swal("OK!", data.success, "success");
                        dataTablemoto.ajax.reload();
                        dataTable.ajax.reload();
	                }else{
						$(".print-error-msgMtUp").css('display','block');
	                	$(".print-error-msgMtUp").html(data.error);
	                }
	            }
	        });
	    }); 
        
    });
</script>