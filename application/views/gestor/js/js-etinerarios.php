<script>
    $(document).ready(function() {
        //**lista localidades */
        var dataTablelocal = $('#lista_das_localidades').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('get-localidades') ?>",
                type: 'GET'
            },
        });

        /**get lista cidades */
        $('select[name="inputStateUf"]').on('change', function() {
            var id_uf = $(this).val();
            if (id_uf) {
                $.ajax({
                    url: "<?php echo site_url('myform/ajax/') ?>" + id_uf,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="cidade_atende"]').empty();

                        $('select[name="cidade_atende"]').append('<option selected disabled>Selecione uma cidade aqui...</option>');
                        $.each(data, function(key, value) {
                            $('select[name="cidade_atende"]').append('<option class="text-dark" value="' + value.id + '">' + value.nome + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="cidade_atende"]').empty();
            }
        });

        /**inseri localidades */
        $(document).on('submit', '#form_add_local', function(event) {
            event.preventDefault();

            $('#localTextEnviar').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Enviando, aguarde...').prop("disabled", true);
            $(".bt_env_loc").prop("disabled", true);

            var inputStateUf = $("select[name='inputStateUf']").val();
            var cidade_atende = $("select[name='cidade_atende']").val();
            var localAtende = $("input[name='localAtende']").val();


            $.ajax({
                url: "<?= site_url('adiciona-localidades') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    inputStateUf: inputStateUf,
                    cidade_atende: cidade_atende,
                    localAtende: localAtende,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgAddLocal").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#form_add_local')[0].reset();
                        dataTablelocal.ajax.reload();

                        $('#localTextEnviar').html('Enviar');
                        $(".bt_env_loc").prop("disabled", false);

                    } else {
                        $(".print-error-msgAddLocal").css('display', 'block');
                        $(".print-error-msgAddLocal").html(data.error);

                        $('#localTextEnviar').html('Enviar');
                        $(".bt_env_loc").prop("disabled", false);

                    }
                }
            });
        });

        /**deletando localidade */
        $(document).on('click', '.btn_del_loc', function() {
            var id_del = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Ao confirmar essa ação será permanente!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?php echo site_url('deleta-local/'); ?>" + id_del,
                            method: "POST",
                            data: {
                                id_del: id_del,
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                dataTablelocal.ajax.reload();
                            }
                        });

                    } else {
                        swal("Ops! Você desistiu de deletar");
                    }
                });
        });
    });
</script>