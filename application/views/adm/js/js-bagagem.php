<script>
    $(document).ready(function() {


        function id_bagagemviagem(query) {

            $.ajax({
                url: "<?= site_url('lista-bagagem-bagagem-viagem/') ?>" + query,
                method: "GET",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result_bagagem').html(data);
                }
            })
        }

        var i = 1;

        $('#addBagage').click(function() {
            i++;
            $('#dinamycBagage').append(
                '<tr id="row' + i + '" class="dynamic-added">' +
                '<td>' +
                '<input type="text" name="desc_bgg[]" placeholder="Digite aqui..." class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                '<input type="text" name="cod_bgg[]" placeholder="Código aqui..." class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                '<input type="number" name="qtd_bgg[]" placeholder="Ex.: 2" class="form-control name_list" required />' +
                '</td>' +
                '<td>' +
                "<input type='number' name='valor_bgg[]'  oninput='this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');' value='0.00' placeholder='Ex.: 2' class='form-control name_list' required />" +
                '</td>' +
                '<td>' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove_bgg btn-sm"><i class="fa fa-close"></i>&nbsp;Remover</button>' +
                '</td>' +
                '</tr>');
        });

        $(document).on('click', '.btn_remove_bgg', function() {
            let button_id_bgg = $(this).attr("id");
            $('#row' + button_id_bgg + '').remove();
        });

        $("#valo_bagagem").blur(function() {
            this.value = parseFloat(this.value).toFixed(2);
        });

        $(document).on('click', '.bagagemUsuario', function() {
            var id_bgg = $(this).attr("id");
            $.ajax({
                url: "<?= site_url('lista-usuario-bagagem/') ?>" + id_bgg,
                method: "GET",
                data: {
                    id_bgg: id_bgg
                },
                dataType: "json",
                success: function(data) {
                    $('#bagagemPassageiroIndividual').modal('show');
                    let cliente_bgg = data['cli_Viagem_cliente'];
                    $('#cliente_bgg_add').html(cliente_bgg);
                    $('#id_bgg').val(id_bgg);
                    id_bagagemviagem(id_bgg);
                }
            })
        });


        /**adiciona bagagens */
        $(document).on('submit', '#add_bagaens_user_form', function(event) {
            event.preventDefault();

            var str_form_bagagem = $("#add_bagaens_user_form").serialize();
            var id_bgg_add = $('#id_bgg').val();

            $('#salvaBagagem').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Salvando bagagem, aguarde...').prop("disabled", true);
            $(".bt_adm_add_bagaem").prop("disabled", true);

            $.ajax({
                url: "<?= site_url('add-bagagem_usuario') ?>",
                type: 'POST',
                dataType: "json",
                data: str_form_bagagem,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgAddBgg").css('display', 'none');
                        swal("OK!", data.success, "success");
                        $('#add_bagaens_user_form')[0].reset();
                        id_bagagemviagem(id_bgg_add);

                        $('#salvaBagagem').html('Salvar');
                        $(".bt_adm_add_bagaem").prop("disabled", false);

                    } else {
                        $(".print-error-msgAddBgg").css('display', 'block');
                        $(".print-error-msgAddBgg").html(data.error);

                        $('#salvaBagagem').html('Salvar');
                        $(".bt_adm_add_bagaem").prop("disabled", false);
                    }
                }
            });

        });

        /**deleta bagagem */
        $(document).on('click', '.del_bagagem', function() {
            var id_del_bgg = $(this).attr("id");

            swal({
                    title: "Deseja deletar?",
                    text: "Deseja deletar essa bagagem?",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "<?= site_url('deletar-bagaem/') ?>" + id_del_bgg,
                            method: "GET",
                            data: {
                                id_del_bgg: id_del_bgg
                            },
                            success: function(data) {
                                swal(data, {
                                    icon: "success",
                                });
                                $('#bagagemPassageiroIndividual').modal('hide');
                            }
                        });

                    } else {
                        swal("Você desistiu de deletar!");
                    }
                });
        });
    });
</script>