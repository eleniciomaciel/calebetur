<script>
    $(document).ready(function() {
        carregaTotalAgencias();
        $('#telefone_ag').mask('(00)9. 0000-0000');

        var dataTablelista = $('#lista_todas_as_agencias').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('lista-agencias') ?>",
                type: 'GET'
            },
        });
        /**get lista cidades */
        $('select[name="selectUf_ag"]').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: "<?php echo site_url('myform/ajax/') ?>" + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="cidade_ag"]').empty();

                        $('select[name="cidade_ag"]').append('<option selected disabled>Selecione uma cidade aqui...</option>');
                        $.each(data, function(key, value) {
                            $('select[name="cidade_ag"]').append('<option class="text-dark" value="' + value.id + '">' + value.nome + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="cidade_ag"]').empty();
            }
        });

        /**adiciona agencia */
        $(document).on('submit', '#form_add_agencia', function(event) {
            event.preventDefault();

            $('#agenciaTextEnviar').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando, aguarde...').prop("disabled", true);
            $(".bt_env_ag").prop("disabled", true);

            var nome_ag = $("input[name='nome_ag']").val();
            var telefone_ag = $("input[name='telefone_ag']").val();
            var email_ag = $("input[name='email_ag']").val();
            var selectUf_ag = $("select[name='selectUf_ag']").val();
            var cidade_ag = $("select[name='cidade_ag']").val();
            var bairro_ag = $("input[name='bairro_ag']").val();
            var endereco_ag = $("input[name='endereco_ag']").val();


            $.ajax({
                url: "<?= site_url('adiciona-agencia') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    nome_ag: nome_ag,
                    telefone_ag: telefone_ag,
                    email_ag: email_ag,
                    selectUf_ag: selectUf_ag,
                    cidade_ag: cidade_ag,
                    bairro_ag: bairro_ag,
                    endereco_ag: endereco_ag,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg_addAgencia").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#form_add_agencia')[0].reset();
                        dataTablelista.ajax.reload();
                        carregaTotalAgencias();
                        $('#agenciaTextEnviar').html('Enviar');
                        $(".bt_env_ag").prop("disabled", false);
                    } else {
                        $(".print-error-msg_addAgencia").css('display', 'block');
                        $(".print-error-msg_addAgencia").html(data.error);

                        $('#agenciaTextEnviar').html('Enviar');
                        $(".bt_env_ag").prop("disabled", false);
                    }
                }
            });
        });

        /**altera visualuza dados */
        $(document).on('click', '.viewDadosAg', function() {
            var vw_id_ag = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('visualiza-dados-agencia/'); ?>" + vw_id_ag,
                method: "GET",
                data: {
                    vw_id_ag: vw_id_ag
                },
                dataType: "json",
                success: function(data) {
                    $('#viewAlteraAgenciaModal').modal('show');
                    $('#vw_up_nome').val(data.vw_up_nome);
                    $('#vw_up_estado').val(data.vw_up_estado);
                    $('#vw_up_cidade').val(data.vw_up_cidade);
                    $('#vw_up_bairro').val(data.vw_up_bairro);
                    $('#vw_up_endereco').val(data.vw_up_endereco);
                    $('#vw_up_telefone').val(data.vw_up_telefone);
                    $('#vw_up_email').val(data.vw_up_email);
                    $('#vw_id_ag').val(vw_id_ag);
                }
            })
        });

        /**adiciona agencia */
        $(document).on('submit', '#form_vw_up_agencia', function(event) {
            event.preventDefault();

            $('#agenciaTextEnviar_upt').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Alterando, aguarde...').prop("disabled", true);
            $(".bt_env_ag_upt").prop("disabled", true);

            var vw_up_nome = $("input[name='vw_up_nome']").val();
            var vw_up_telefone = $("input[name='vw_up_telefone']").val();
            var vw_up_email = $("input[name='vw_up_email']").val();
            var vw_up_estado = $("select[name='vw_up_estado']").val();
            var vw_up_cidade = $("select[name='vw_up_cidade']").val();
            var vw_up_bairro = $("input[name='vw_up_bairro']").val();
            var vw_up_endereco = $("input[name='vw_up_endereco']").val();
            var vw_id_ag = $("input[name='vw_id_ag']").val();


            $.ajax({
                url: "<?= site_url('altera-agencia/') ?>" + vw_id_ag,
                type: 'POST',
                dataType: "json",
                data: {
                    vw_up_nome: vw_up_nome,
                    vw_up_telefone: vw_up_telefone,
                    vw_up_email: vw_up_email,
                    vw_up_estado: vw_up_estado,
                    vw_up_cidade: vw_up_cidade,
                    vw_up_bairro: vw_up_bairro,
                    vw_up_endereco: vw_up_endereco,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg_addAgencia").css('display', 'none');
                        swal("OK!", data.success, "success");
                        dataTablelista.ajax.reload();

                        $('#agenciaTextEnviar_upt').html('Alterar');
                        $(".bt_env_ag_upt").prop("disabled", false);
                    } else {
                        $(".print-error-msg_addAgencia").css('display', 'block');
                        $(".print-error-msg_addAgencia").html(data.error);

                        $('#agenciaTextEnviar_upt').html('Alterar');
                        $(".bt_env_ag_upt").prop("disabled", false);
                    }
                }
            });
        });

        /**deleta agencia */
        $(document).on('click', '.delete_ag', function() {
            var delete_ag_id = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Ao confirmar essa ação será permanente no sistema!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?php echo site_url('delete-agencia/'); ?>" + delete_ag_id,
                            method: "POST",
                            data: {
                                delete_ag_id: delete_ag_id,
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                dataTablelista.ajax.reload();
                            }
                        });

                    } else {
                        swal("Desistiu de deletar!");
                    }
                });
        });

        /**get soma dados as agencias */
        function carregaTotalAgencias(){
            $.get("<?php echo site_url('soma-agencias'); ?>", function(data) {
                $(".result_agencias").html(data);
            });
        }
    });
</script>