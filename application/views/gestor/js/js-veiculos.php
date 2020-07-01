<script>
    $(document).ready(function() {

        var dataTableveiculos = $('#lista_todas_os_carros').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('lista-carros-gestor') ?>",
                type: 'GET'
            },
        });

        /**adiciona carro */
        $(document).on('submit', '#form_add_veiculo', function(event) {
            event.preventDefault();

            $('#veiculoAddEnviar').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Salvando, aguarde...').prop("disabled", true);
            $(".bt_car_env").prop("disabled", true);

            var veiculo_marca = $("input[name='veiculo_marca']").val();
            var veiculo_modelo = $("input[name='veiculo_modelo']").val();
            var veiculo_ano = $("input[name='veiculo_ano']").val();
            var veiculo_chassi = $("input[name='veiculo_chassi']").val();
            var veiculo_poltrona = $("input[name='veiculo_poltrona']").val();
            var veiculo_placa = $("input[name='veiculo_placa']").val();
            var veiculo_tipo_carro = $("select[name='veiculo_tipo_carro']").val();


            $.ajax({
                url: "<?= site_url('adiciona-veiculo') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    veiculo_marca: veiculo_marca,
                    veiculo_modelo: veiculo_modelo,
                    veiculo_ano: veiculo_ano,
                    veiculo_chassi: veiculo_chassi,
                    veiculo_poltrona: veiculo_poltrona,
                    veiculo_placa: veiculo_placa,
                    veiculo_tipo_carro:veiculo_tipo_carro,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg_addVeiculo").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#form_add_veiculo')[0].reset();
                        dataTableveiculos.ajax.reload();
                        $('#veiculoAddEnviar').html('Salvar');
                        $(".bt_car_env").prop("disabled", false);
                    } else {
                        $(".print-error-msg_addVeiculo").css('display', 'block');
                        $(".print-error-msg_addVeiculo").html(data.error);

                        $('#veiculoAddEnviar').html('Salvar');
                        $(".bt_car_env").prop("disabled", false);
                    }
                }
            });
        });
        /**visualliza altera dados do veiculo */
        $(document).on('click', '.viewAlteraCar', function() {
            var vw_id_car = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('visualiza-dados-do-car/'); ?>" + vw_id_car,
                method: "GET",
                data: {
                    vw_id_car: vw_id_car
                },
                dataType: "json",
                success: function(data) {
                    $('#viewAlteraVeiculoModalLong').modal('show');
                    $('#car_up_marca').val(data.car_up_marca);
                    $('#car_up_modelo').val(data.car_up_modelo);
                    $('#car_up_ano_vei').val(data.car_up_ano_vei);
                    $('#car_up_chassi').val(data.car_up_chassi);
                    $('#car_up_poltronas').val(data.car_up_poltronas);
                    $('#car_up_placa').val(data.car_up_placa);
                    $('#car_up_status').val(data.car_up_status);
                    $('#vw_id_car').val(vw_id_car);
                }
            })
        });

        /**altera dados do veiculo */
        $(document).on('submit', '#form_vw_altera_veiculo', function(event) {
            event.preventDefault();

            $('#carroTextEnviar_up_car').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Alterando, aguarde...').prop("disabled", true);
            $(".bt_env_car_upt").prop("disabled", true);

            var car_up_marca = $("input[name='car_up_marca']").val();
            var car_up_modelo = $("input[name='car_up_modelo']").val();
            var car_up_ano_vei = $("input[name='car_up_ano_vei']").val();
            var car_up_chassi = $("input[name='car_up_chassi']").val();
            var car_up_poltronas = $("input[name='car_up_poltronas']").val();
            var car_up_placa = $("input[name='car_up_placa']").val();
            var car_up_status = $("select[name='car_up_status']").val();
            var vw_id_car = $("input[name='vw_id_car']").val();


            $.ajax({
                url: "<?= site_url('altera-carro/') ?>" + vw_id_car,
                type: 'POST',
                dataType: "json",
                data: {
                    car_up_marca: car_up_marca,
                    car_up_modelo: car_up_modelo,
                    car_up_ano_vei: car_up_ano_vei,
                    car_up_chassi: car_up_chassi,
                    car_up_poltronas: car_up_poltronas,
                    car_up_placa: car_up_placa,
                    car_up_status: car_up_status,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg_UpCar").css('display', 'none');
                        swal("OK!", data.success, "success");
                        dataTableveiculos.ajax.reload();

                        $('#carroTextEnviar_up_car').html('Alterar');
                        $(".bt_env_car_upt").prop("disabled", false);
                    } else {
                        $(".print-error-msg_UpCar").css('display', 'block');
                        $(".print-error-msg_UpCar").html(data.error);

                        $('#carroTextEnviar_up_car').html('Alterar');
                        $(".bt_env_car_upt").prop("disabled", false);
                    }
                }
            });
        });

        /**deleta veiculo */
        $(document).on('click', '.desativaCar', function() {
            var del_car_id = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Essa açao será permanente no sistema!",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?php echo site_url('delete-carro/'); ?>" + del_car_id,
                            method: "POST",
                            data: {
                                del_car_id: del_car_id,
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                dataTableveiculos.ajax.reload();
                            }
                        });

                    } else {
                        swal("Desistiu de deletar!");
                    }
                });
        });
    });
</script>