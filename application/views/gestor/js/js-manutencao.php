<script>
    $(document).ready(function() {
        load_data_pecas();
        var dataTablemanut = $('#lista_carro_em_manutencao').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('get-carro-em-manutencao') ?>",
                type: 'GET'
            },
        });

        /**adiciona peças dinamicamente */
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append(
                '<tr id="row' + i + '" class="dynamic-added">' +
                '<td>' +
                '<input type="text" name="addmorepecaNome[][name]" id="addmorepecaNome" placeholder="Ex.: Freios" class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                '<input type="text" name="addmoreQuantidade[][name]" id="addmoreQuantidade" placeholder="Ex.: 5" class="form-control name_list" required="" />' +
                '</td>' +
                '<td>' +
                '<input type="text" name="addmorePrecos[][name]" id="addmorePrecos" placeholder="Ex.: 150,00" class="form-control name_list" required="" />' +
                '</td>' +
                '<td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-sm"><i class="material-icons"> clear </i> Remover</button>' +
                '</td>' +
                '</tr>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        /**inseri carro para a manutenção */
        $(".btn__manutencao_submit").click(function(e) {
            e.preventDefault();

            $('#carroManutencaoTextEnviar').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando, aguarde...').prop("disabled", true);
            $(".bt_env_car_manutencao").prop("disabled", true);

            var add_car_manutencao = $("select[name='add_car_manutencao']").val();

            $.ajax({
                url: "<?= site_url('adiciona-carro-na-manutencao') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    add_car_manutencao: add_car_manutencao,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgCarVeiculoManutencao").css('display', 'none');
                        swal("OK!", data.success, "success");
                        dataTablemanut.ajax.reload();
                        $('#carroManutencaoTextEnviar').html('Enviar');
                        $(".bt_env_car_manutencao").prop("disabled", false);
                    } else {
                        $(".print-error-msgCarVeiculoManutencao").css('display', 'block');
                        $(".print-error-msgCarVeiculoManutencao").html(data.error);

                        $('#carroManutencaoTextEnviar').html('Enviar');
                        $(".bt_env_car_manutencao").prop("disabled", false);
                    }
                }
            });
        });

        /**pega dados do carro e lista peças */

        function load_data_pecas(query) {

            $.ajax({
                url: "<?= site_url('lista-dados-carro-manutencao/') ?>" + query,
                method: "GET",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result_table_pecas').html(data);
                }
            })
        }

        $(document).on('click', '.pecaManutencao', function() {
            var search = $(this).attr("id");

            if (search != '') {
                load_data_pecas(search);

                $('#ListaPecasCarroManutencaoModalLong').modal('show');
            } else {
                load_data_pecas();
            }
        });

        /**visualiza peças dinamicamente */
        $(document).on('click', '.pecaAddManutencao', function() {
            var id_car_pecas = $(this).attr("id");
            $.ajax({
                url: "<?= site_url('adiciona-pecas-para-o-carro/') ?>" + id_car_pecas,
                method: "GET",
                data: {
                    id_car_pecas: id_car_pecas
                },
                dataType: "json",
                success: function(data) {
                    $('#addPecasModalLong').modal('show');
                    $('#view_placa').val(data.pc_placa);
                    $('#view_modelo').val(data.pc_marca);
                    $('#id_caro_manutencao').val(data.id_caro_manutencao);

                    let placa = data['pc_placa'];
                    $('#plc_car').html(placa);

                    let marca = data['pc_marca'];
                    $('#plc_marca').html(marca);

                    $('#id_car_pecas').val(id_car_pecas);
                }
            })
        });

        /**adiciona peças dinamicamente */

        $(document).on("submit", "#formPiecasAdd", function(e) {
            e.preventDefault();

            var addNotaCompras = $("input[name='addNotaCompras']").val();
            var addmorepecaNome = $("input[name='addmorepecaNome']").val();
            var addmoreQuantidade = $("input[name='addmoreQuantidade']").val();
            var addmorePrecos = $("input[name='addmorePrecos']").val();

            var id_car_pecas = $("input[name='id_car_pecas']").val();
            var id_caro_manutencao = $("input[name='id_caro_manutencao']").val();


            $.ajax({
                url: "<?= site_url('adiciona-pecas-dinamicamente') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    addNotaCompras: addNotaCompras,
                    addmorepecaNome: addmorepecaNome,
                    addmoreQuantidade: addmoreQuantidade,
                    addmorePrecos: addmorePrecos,
                    id_car_pecas: id_car_pecas,
                    id_caro_manutencao: id_caro_manutencao,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgAddPiecasDynamic").css('display', 'none');
                        swal("OK!", data.success, "success");
                    } else {
                        $(".print-error-msgAddPiecasDynamic").css('display', 'block');
                        $(".print-error-msgAddPiecasDynamic").html(data.error);
                    }
                }
            });
        });

        /**deletando peças de manutenção */


        $(document).on('click', '.deletePecas', function() {
            var id_delPeca = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Essa ação será permanente no sistemas!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?= site_url('deleta-peca-manutencao/') ?>" + id_delPeca,
                            method: "POST",
                            data: {
                                id_delPeca: id_delPeca,
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                $('#ListaPecasCarroManutencaoModalLong').modal('hide');
                            }
                        });

                    } else {
                        swal("Ops! Desistiu de deletar.");
                    }
                });

        });


    });
</script>