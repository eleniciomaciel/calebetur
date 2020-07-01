<script>
    $(document).ready(function() {
        $.get("<?= site_url('lista-todos-motoristas') ?>", function(data) {
            $(".result_lista_motoristas").html(data);
        });

        var dataTableagmotoviagem = $('#lista_todas_viagens_agendads_motoristas').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?= site_url('lista-viagens-agendadas-motoristas') ?>",
                type: 'GET'
            },
        });

        $('select[name="selectDate"]').on('change', function() {
            var stateID_dt = $(this).val();
            if (stateID_dt) {
                $.ajax({
                    url: "<?= site_url('lista-datas-carro-viagem/') ?>" + stateID_dt,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="pl_car_trip"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="pl_car_trip"]').append('<option value="' + value.id_vc + '">' + value.placa_veic + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="pl_car_trip"]').empty();
            }
        });

        /**Seleciona a key */
        $('select[name="selectDate"]').on('change', function() {
            var data_key = $(this).val();
            if (data_key) {
                $.ajax({
                    url: "<?= site_url('lista-key-carro-viagem/') ?>" + data_key,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="valor_key_tip"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="valor_key_tip"]').append('<option value="' + value.id_vc + '">' + value.controle_key_vc + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="valor_key_tip"]').empty();
            }
        });

        /**seleciona o id da viagem */
        $(document).on('submit', '#form_addMotorAgenda', function(event) {
            event.preventDefault();

            $('#salvaAgendaMotor').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Salvando agendamento...').prop("disabled", true);
            $(".bt_adm_add_agenda_motor").prop("disabled", true);

            var str_motor_viagem = $("#form_addMotorAgenda").serialize();

            $.ajax({
                url: "<?= site_url('adiciona-motorista-agenda-viagem') ?>",
                type: 'POST',
                dataType: "json",
                data: str_motor_viagem,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg_av_age_motor").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#form_addMotorAgenda')[0].reset();
                        dataTableagmotoviagem.ajax.reload();

                        $('#salvaAgendaMotor').html('Adicionar novo');
                        $(".bt_adm_add_agenda_motor").prop("disabled", false);

                    } else {
                        $(".print-error-msg_av_age_motor").css('display', 'block');
                        $(".print-error-msg_av_age_motor").html(data.error);

                        $('#salvaAgendaMotor').html('Adicionar novo');
                        $(".bt_adm_add_agenda_motor").prop("disabled", false);
                    }
                }
            });
        });

        $(document).on('click', '.deleteUserMotorNaViagem', function() {
            var user_id = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Você desejar deletar o motorista para essa viagem?",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?=site_url('deleta-motorista-viagem/')?>" + user_id,
                            method: "POST",
                            data: {
                                user_id: user_id,
                                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {

                                swal(data, {
                                    icon: "success",
                                });
                                dataTableagmotoviagem.ajax.reload();
                            }
                        });

                    } else {
                        swal("Você desistiu de deletar!");
                    }
                });
        });


        /**print card carro viagem motorista */
    });
</script>