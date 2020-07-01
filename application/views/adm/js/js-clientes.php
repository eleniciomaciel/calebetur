<script>
    $(document).ready(function() {
        somaTotalClientes();

        $('#inputTelCliente').mask("(00)9.0000-0000", {
            placeholder: "(00)9.0000-0000"
        });
        $('#inputTelContato').mask("(00)9.0000-0000", {
            placeholder: "(00)9.0000-0000"
        });
        $('#inputCliente_cf').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });


        /**form altera */
        $('#agCli_tel_p').mask("(00)9.0000-0000", {
            placeholder: "(00)9.0000-0000"
        });
        $('#agCli_tele_c').mask("(00)9.0000-0000", {
            placeholder: "(00)9.0000-0000"
        });
        $('#agCli_cpf').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });

        var dataTableclientes = $('#lista_todos_clientes').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?= site_url('lista-todos-clientes') ?>",
                type: 'GET'
            },
        });

        /**soma todos os clientes */
        function somaTotalClientes() {
            $.get("<?php echo base_url(); ?>administracao/PassageiroController/somaClientesTotal", function(data) {
                $(".result_totalClientes").html(data);
            });
        }
        /**seleciona estado do cliente */
        $('select[name="select_estados"]').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: "<?= site_url('cidade-do-cliente/') ?>" + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="cidade_cliente"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="cidade_cliente"]').append('<option class="text-dark" value="' + value.id + '">' + value.nome + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="cidade_cliente"]').empty();
            }
        });
        /**salva cliente */
        $(document).on('submit', '#add_form_cliente', function(event) {
            event.preventDefault();

            $('#clienteADMEnviar').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando, aguarde...').prop("disabled", true);
            $(".bt_adm_cli").prop("disabled", true);

            var str_add_cliente = $("#add_form_cliente").serialize();

            $.ajax({
                url: "<?= site_url('adiciona-cleinete-passageiro') ?>",
                type: 'POST',
                dataType: "json",
                data: str_add_cliente,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgAddPassageiro").css('display', 'none');
                        swal("Ok!", data.success, "success");
                        $('#add_form_cliente')[0].reset();
                        $('#clienteADMEnviar').html('Salvar');
                        $(".bt_adm_cli").prop("disabled", false);
                        dataTableclientes.ajax.reload();
                        somaTotalClientes();
                    } else {
                        $(".print-error-msgAddPassageiro").css('display', 'block');
                        $(".print-error-msgAddPassageiro").html(data.error);

                        $('#clienteADMEnviar').html('Salvar');
                        $(".bt_adm_cli").prop("disabled", false);
                    }
                }
            });
        });

        /**get dados cliente */
        $(document).on('click', '.viewCliente', function() {
            var id_cli = $(this).attr("id");
            $.ajax({
                url: "<?= site_url('lista-dados-do-cliente/') ?>" + id_cli,
                method: "GET",
                data: {
                    id_cli: id_cli
                },
                dataType: "json",
                success: function(data) {
                    $('#viewClientesModal').modal('show');
                    $('#agCli_nome').val(data.agCli_nome);
                    $('#agCli_cida').val(data.agCli_cida);
                    $('#agCli_esta').val(data.agCli_esta);
                    $('#agCli_tel_p').val(data.agCli_tel_p);
                    $('#agCli_tele_c').val(data.agCli_tele_c);
                    $('#agCli_rg').val(data.agCli_rg);
                    $('#agCli_cpf').val(data.agCli_cpf);
                    $('#agCli_naci').val(data.agCli_naci);
                    $('#agCli_observ').val(data.agCli_observ);
                    $('#id_cli').val(id_cli);
                }
            })
        });

        /**altera dados do cliente */
        $(document).on('submit', '#altera_form_cliente', function(event) {
            event.preventDefault();

            $('#clienteADMEnviar_altera').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Alterarndo, aguarde...').prop("disabled", true);
            $(".bt_adm_cli_altera").prop("disabled", true);

            var id_cli = $("input[name='id_cli']").val();
            var str_add_cliente = $("#altera_form_cliente").serialize();

            $.ajax({
                url: "<?= site_url('altera-cleinete-passageiro/') ?>" + id_cli,
                type: 'POST',
                dataType: "json",
                data: str_add_cliente,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgAalteraPassageiro").css('display', 'none');
                        swal("Ok!", data.success, "success");
                        $('#clienteADMEnviar_altera').html('Alterar');
                        $(".bt_adm_cli_altera").prop("disabled", false);
                        dataTableclientes.ajax.reload();
                    } else {
                        $(".print-error-msgAalteraPassageiro").css('display', 'block');
                        $(".print-error-msgAalteraPassageiro").html(data.error);

                        $('#clienteADMEnviar_altera').html('Alterar');
                        $(".bt_adm_cli_altera").prop("disabled", false);
                    }
                }
            });
        });

        function listaClientes() {
            $.ajax({
                url: "<?= site_url('usuarios-lista-clientes') ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="polt_car_v_cliente"]').empty();
                    $('select[name="polt_car_v_cliente"]').append('<option selected disabled>Selecione o cliente...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="polt_car_v_cliente"]').append('<option  class="text-dark" value="' + value.id_cls + '">' + value.nome_classe + '</option>');
                    });
                }
            });
        }
    });
</script>