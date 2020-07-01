<script>
    $(document).ready(function() {
        somaTotalEncomendas();
        $('#cpf_clienteEncomenda').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });
        $('#destin_tel').mask("(00)9 0000-0000", {
            placeholder: "(00)9 0000-0000"
        });
        load_data_encomendas();
        
        var dataTablestcomenda = $('#item_list_enceomendas_all').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?=site_url('lista-all-encomendas')?>",
                type: 'GET'
            },
        });

        var i = 1;

        $('#addEncomenda').click(function() {
            i++;
            $('#dinamycEncomenda').append(
                '<tr id="row_enc' + i + '" class="dynamic-added">' +
                '<td>' +
                '<input type="text" name="desc_encom[]" placeholder="Digite aqui..." class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                '<input type="text" name="cod_encom[]" placeholder="Código aqui..." class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                '<input type="number" name="qtd_encom[]" placeholder="Ex.: 2" class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                "<input type='number' name='valor_encom[]'  oninput='this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');' value='0.00' placeholder='Ex.: 0,00' class='form-control name_list' required />" +
                '</td>' +
                '<td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove_encomenda btn-sm"><i class="fa fa-close"></i>&nbsp;Remover</button>' +
                '</td>' +
                '</tr>');
        });

        $(document).on('click', '.btn_remove_encomenda', function() {
            let button_id_enc = $(this).attr("id");
            $('#row_enc' + button_id_enc + '').remove();
        });

        /**soma emcomendas */
        function somaTotalEncomendas() {
            $.get("<?php echo base_url(); ?>administracao/EncomendasController/somaEncomendasTotal", function(data) {
                $(".result_totalEncomendas").html(data);
            });
        }
        $(document).on('click', '.addEncomendasDaViagem', function() {
            var id_encomenda = $(this).attr("id");

            $.ajax({
                url: "<?= site_url('lista-encomendas-do-carro/') ?>" + id_encomenda,
                method: "GET",
                data: {
                    id_encomenda: id_encomenda
                },
                dataType: "json",
                success: function(data) {
                    $('#clientesEncomendaDessaViagem').modal('show');

                    let progran_data_sai = data['progran_data_sai'];
                    $('#enc_progran_data_sai').html(progran_data_sai);

                    let progran_loc_s = data['progran_loc_s'];
                    $('#enc_progran_loc_s').html(progran_loc_s);

                    let progran_hora_sai = data['progran_hora_sai'];
                    $('#enc_progran_hora_sai').html(progran_hora_sai);

                    let progran_key = data['progran_key'];
                    $('#enc_progran_key').html(progran_key);

                    $('#id_encomenda').val(id_encomenda);
                    load_data_encomendas(id_encomenda);
                    dataTablestcomenda.ajax.reload();
                    
                }
            })
        });

        /**preenche o nome do aluno */
        $("#cpf_clienteEncomenda").autocomplete({
            source: "<?= site_url('busca-cliente') ?>"
        });
        /**completa dados nome */
        $('#cpf_clienteEncomenda').on('focusout', function() {

            var id_cliEnc = $(this).val();
            if (id_cliEnc) {
                $.ajax({
                    url: "<?= site_url('completa-dados-cliente/') ?>" + id_cliEnc,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="user_cliente_encom"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="user_cliente_encom"]').append('<option value="' + value.id_cl + '">' + value.fk_nome_ciente_cl + '</option>');

                        });
                    }
                });
            } else {
                $('select[name="user_cliente_encom"]').empty();
            }

        });

        /**adiciona emcomenda */
        /**adiciona bagagens */
        $(document).on('submit', '#form_encomenda', function(event) {
            event.preventDefault();

            var str_form_bagagem = $("#form_encomenda").serialize();
            var id_encomenda = $('#id_encomenda').val();

            $('#salvaEncomenda').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Salvando, aguarde...').prop("disabled", true);
            $(".bt_adm_add_encomenda").prop("disabled", true);

            $.ajax({
                url: "<?= site_url('add_encomenda_usuario') ?>",
                type: 'POST',
                dataType: "json",
                data: str_form_bagagem,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgAddEncomenda").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#form_encomenda')[0].reset();

                        $('#salvaEncomenda').html('Salvar');
                        $(".bt_adm_add_encomenda").prop("disabled", false);
                        load_data_encomendas(id_encomenda);
                        dataTablestcomenda.ajax.reload();
                        somaTotalEncomendas();

                    } else {
                        $(".print-error-msgAddEncomenda").css('display', 'block');
                        $(".print-error-msgAddEncomenda").html(data.error);

                        $('#salvaEncomenda').html('Salvar');
                        $(".bt_adm_add_encomenda").prop("disabled", false);
                    }
                }
            });

        });

        /**lista encomendas dos usuários da viagem */
        function load_data_encomendas(query_enc) {
            $.ajax({
                url: "<?= site_url('lista-encoemendas-minha-viagem/') ?>" + query_enc,
                method: "GET",
                data: {
                    query_enc: query_enc
                },
                success: function(data) {
                    $('#resultEncomendas').html(data);
                }
            })
        };

        /**lista encomendas do remetente */

        $(document).on('click', '.viewEncomendaRemete', function() {
            var id_lt_enc = $(this).attr("id");
            $.ajax({
                url: "<?= site_url('lista-encomenda-do-remetente/') ?>" + id_lt_enc,
                method: "GET",
                data: {
                    id_lt_enc: id_lt_enc
                },
                success: function(data) {
                    $('#remetenteEncomendaLista').modal('show');
                    $('#result_listaEncomendasOne').html(data);
                    $('#id_lt_enc').val(id_lt_enc);
                }
            })
        });

        /**deletando encomenda */
        $(document).on('click', '.delItemProduto', function() {
            var id_del_pi = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Quer reamente deletar essa encomenda?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?= site_url('delete-produto-encoemda-cleinet/') ?>" + id_del_pi,
                            method: "GET",
                            data: {
                                id_del_pi: id_del_pi
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                $('#remetenteEncomendaLista').modal('hide');
                                dataTablestcomenda.ajax.reload();
                            }
                        });


                    } else {
                        swal("Desisitiu de deletar!");
                    }
                });
        });

        /**seleciona status e muda */
        $(document).on('click', '.viewStsProduct', function() {
            var is_sts_one = $(this).attr("id");
            $.ajax({
                url: "<?= site_url('situacao-status-produto/') ?>" + is_sts_one,
                method: "GET",
                data: {
                    is_sts_one: is_sts_one
                },
                dataType: "json",
                success: function(data) {
                    $('#statusProdutoAltera').modal('show');
                    $('#sts_product').val(data.sts_product);

                    let pro_codigo = data['sts_codigo'];
                    $('#enc_pro_codigo').html(pro_codigo);

                    let prog_descricao = data['sts_descricao'];
                    $('#enc_prog_descricao').html(prog_descricao);

                    $('#is_sts_one_altera').val(is_sts_one);
                }
            })
        });

        /**altera status */
        $(document).on('submit', '#alterStatusProdutoAgencia', function(event) {
            event.preventDefault();
            var sts_product = $('#sts_product').val();
            var is_sts_one_altera = $('#is_sts_one_altera').val();


            swal({
                    title: "Alterar status?",
                    text: "Deseja alterar status desse produto?!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?= site_url('altera-status-do-produto-na-agencia/') ?>" + is_sts_one_altera,
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                $('#remetenteEncomendaLista').modal('hide');
                                dataTablestcomenda.ajax.reload();
                            }
                        });
                    } else {
                        swal("Desistiu de alterar o status!");
                    }
                });
        });
    });
</script>