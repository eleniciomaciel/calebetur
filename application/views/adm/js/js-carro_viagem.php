<script>
  $(document).ready(function() {

    dados_calendar();
    load_poltrona_carro_viagem();
    show_product();
    somaTotalViagensAgendadas();

    /**seleciona carros */
    var dataTableprocar = $('#lista_carro_programado_viagem').DataTable({
      "language": { //Altera o idioma do DataTable para o português do Brasil
        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
      },
      "order": [
        [0, "desc"]
      ],
      "ajax": {
        url: "<?= site_url('lista-carro-programado-viagem') ?>",
        type: 'GET'
      },
    });

    /**lista usuarios da viagem individual */
    var dataTableuser = $('#lista_passageiros_viagem').DataTable({
      "language": { //Altera o idioma do DataTable para o português do Brasil
        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
      },
      "order": [
        [0, "desc"]
      ],
      "ajax": {
        url: "<?= site_url('lista-passageiro-em-viagem-programada') ?>",
        type: 'GET'
      },
    });


    /**cancela viagem */
    $(document).on('click', '.cancelaViagemPassageiro', function() {
      var id_cancel_viag = $(this).attr("id");

      swal({
          title: "Cancelar viagem?",
          text: "Deseja realmente cancelar viagem do cliente?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            $.ajax({
              url: "<?=site_url('cancelar-viagem-cliente/')?>" + id_cancel_viag,
              method: "POST",
              data: {
                id_cancel_viag: id_cancel_viag,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
              },
              success: function(data) {
                swal(data, {
                  icon: "success",
                });
                dataTableuser.ajax.reload();
              }
            });
          } else {
            swal("Você desistiu de cancelar!");
          }
        });
    });



    $.ajax({
      url: "<?= site_url('lista-carros') ?>",
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('select[name="select_veiculo"]').empty();
        $('select[name="select_veiculo"]').append('<option selected disabled>Selecione aqui...</option>');
        $.each(data, function(key, value) {
          $('select[name="select_veiculo"]').append('<option  class="text-dark" value="' + value.id_veic + '">' + value.placa_veic + '</option>');
        });
      }
    });

    $.ajax({
      url: "<?= site_url('lista-ciadades-saida') ?>",
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('select[name="select_cidades_saidas"]').empty();
        $('select[name="select_cidades_saidas"]').append('<option selected disabled>Selecione aqui...</option>');
        $.each(data, function(key, value) {
          $('select[name="select_cidades_saidas"]').append('<option  class="text-dark" value="' + value.id + '">' + value.nome + '</option>');
        });
      }
    });

    $.ajax({
      url: "<?= site_url('usuarios-lista-clientes') ?>",
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('select[name="polt_car_v_cliente"]').empty();
        $('select[name="polt_car_v_cliente"]').append('<option selected disabled>Selecione o cliente...</option>');
        $.each(data, function(key, value) {
          $('select[name="polt_car_v_cliente"]').append('<option  class="text-dark" value="' + value.id_cl + '">' + value.fk_nome_ciente_cl + '</option>');
        });
      }
    });

    $.ajax({
      url: "<?= site_url('lista-ciadades-saida') ?>",
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('select[name="select_cidades_destino"]').empty();
        $('select[name="select_cidades_destino"]').append('<option selected disabled>Selecione aqui...</option>');
        $.each(data, function(key, value) {
          $('select[name="select_cidades_destino"]').append('<option  class="text-dark" value="' + value.id + '">' + value.nome + '</option>');
        });
      }
    });


    function somaTotalViagensAgendadas() {
            $.get("<?php echo base_url(); ?>administracao/CarroViagemController/somaViagens", function(data) {
                $(".result_totalViagens").html(data);
            });
    }
    /**cadastra carro viagem */
    $('#form_addcarro_viagem').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: "<?= site_url('cadastro-carro-viagem') ?>",
        method: $(this).attr("method"),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
          $('#add_viagem_car').attr('disabled', 'disabled');
        },
        success: function(data) {
          if (data.error) {
            if (data.select_veiculo_error != '') {
              $('#select_veiculo_error').html(data.select_veiculo_error);
            } else {
              $('#select_veiculo_error').html('');
            }
            if (data.select_cidades_saidas != '') {
              $('#select_cidades_saidas_error').html(data.select_cidades_saidas_error);
            } else {
              $('#select_cidades_saidas_error').html('');
            }
            if (data.select_cidades_destino_error != '') {
              $('#select_cidades_destino_error').html(data.select_cidades_destino_error);
            } else {
              $('#select_cidades_destino_error').html('');
            }
            if (data.car_viag_local_error != '') {
              $('#car_viag_local_error').html(data.car_viag_local_error);
            } else {
              $('#car_viag_local_error').html('');
            }
            if (data.car_viag_data_error != '') {
              $('#car_viag_data_error').html(data.car_viag_data_error);
            } else {
              $('#car_viag_data_error').html('');
            }
            if (data.car_viag_hora_saida_error != '') {
              $('#car_viag_hora_saida_error').html(data.car_viag_hora_saida_error);
            } else {
              $('#car_viag_hora_saida_error').html('');
            }
            if (data.car_viag_observe_error != '') {
              $('#car_viag_observe_error').html(data.car_viag_observe_error);
            } else {
              $('#car_viag_observe_error').html('');
            }
          }
          if (data.success) {
            swal("OK!", data.success, "success");
            $('#select_veiculo_error').html('');
            $('#select_cidades_saidas_error').html('');
            $('#select_cidades_destino_error').html('');
            $('#car_viag_local_error').html('');
            $('#car_viag_data_error').html('');
            $('#car_viag_hora_saida_error').html('');
            $('#car_viag_observe_error').html('');
            $('#form_addcarro_viagem')[0].reset();
            dataTableprocar.ajax.reload();
            dados_calendar();
            somaTotalViagensAgendadas();
          }
          $('#add_viagem_car').attr('disabled', false);
        }
      })
    });

    $(document).on('click', '.viewProgramCarViagem', function() {
      var id_viewProgramCar = $(this).attr("id");
      $.ajax({
        url: "<?= site_url('visualiza-dados-programa-carro-viagem/') ?>" + id_viewProgramCar,
        method: "GET",
        data: {
          id_viewProgramCar: id_viewProgramCar
        },
        dataType: "json",
        success: function(data) {
          $('#viewProgramaviaggemcarroModalLong').modal('show');
          $('#progrm_car_fk_carro').val(data.progrm_car_fk_carro);
          $('#progrm_car_fk_agente').val(data.progrm_car_fk_agente);
          $('#progrm_car_agencia').val(data.progrm_car_agencia);
          $('#progrm_car_fk_cidade_s').val(data.progrm_car_fk_cidade_s);
          $('#progrm_car_fk_cidades_d').val(data.progrm_car_fk_cidades_d);
          $('#progrm_car_local_saida').val(data.progrm_car_local_saida);
          $('#progrm_car_data_saida').val(data.progrm_car_data_saida);
          $('#progrm_car_hora_saida').val(data.progrm_car_hora_saida);
          $('#progrm_car_observacao').val(data.progrm_car_observacao);
          $('#id_viewProgramCar').val(id_viewProgramCar);
        }
      })
    });
    /**alterando dados da programação do carro */
    $(".btn_salva_alteracao_progran_viagem").click(function(e) {
      e.preventDefault();
      var id_viewProgramCar = $("input[name='id_viewProgramCar']").val();
      var str_altera_progracao_car = $("#form_alteracarro_viagem").serialize();

      swal({
          title: "Deseja alterar?",
          text: "Ao confirmar a alteração será permanente!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {


            $.ajax({
              url: "<?= site_url('altera-dados-dados-programa-viagem/') ?>" + id_viewProgramCar,
              type: 'POST',
              dataType: "json",
              data: str_altera_progracao_car,
              success: function(data) {
                if ($.isEmptyObject(data.error)) {
                  $(".print-error-msgAlteraProgranViagem").css('display', 'none');
                  swal(data.success, {
                    icon: "success",
                  });
                  dataTableprocar.ajax.reload();
                } else {
                  $(".print-error-msgAlteraProgranViagem").css('display', 'block');
                  $(".print-error-msgAlteraProgranViagem").html(data.error);
                }
              }
            });
          } else {
            swal("Ops! desistiu de alterar.");
          }
        });
    });

    /**seleciona a poltrona */
    $(document).on('click', '.viewPoltronaViagem', function() {
      var id_pot = $(this).attr("id");

      $.ajax({
        url: "<?= site_url('dados-da-poltrona/') ?>" + id_pot,
        method: "GET",
        data: {
          id_pot: id_pot
        },
        dataType: "json",
        success: function(data) {
          $('#selectPoltronaCarViagem').modal('show');
          $('#polt_car_v_cliente').val(data.polt_car_v_cliente);
          $('#polt_car_v_vendedor').val(data.polt_car_v_vendedor);
          $('#polt_car_v_poltrona').val(data.polt_car_v_poltrona);
          $('#polt_car_v_status_p').val(data.polt_car_v_status_p);
          $('#polt_car_v_type_pay').val(data.polt_car_v_type_pay);
          $('#polt_car_v_parcelas').val(data.polt_car_v_parcelas);
          $('#polt_car_v_local_sa').val(data.polt_car_v_local_sa);
          $('#polt_car_v_local_destino').val(data.polt_car_v_local_destino);
          $('#polt_car_v_observacao').val(data.polt_car_v_observacao);
          $('#polt_car_v_valor').val(data.polt_car_v_calor);
          $('#id_pot').val(id_pot);
        }
      })
    });

    /**adiciona poltrona */
    $(".btn_save_poltrona").click(function(e) {
      e.preventDefault();

      let str_save_poltrona = $("#form_save_poltrona").serialize();

      $('#clienteADMEnviar_poltrona').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Salvando, aguarde...').prop("disabled", true);
      $(".bt_adm_cli_poltrona").prop("disabled", true);

      $.ajax({
        url: "<?= site_url('salva-dados-poltrona') ?>",
        type: 'POST',
        dataType: "json",
        data: str_save_poltrona,
        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            $(".print-error-msgSavePoltrona").css('display', 'none');
            swal("OK!", data.success, "success");
            $('#listaPoltronasModal').modal('hide');
            $('#clienteADMEnviar_poltrona').html('Salvar');
            $(".bt_adm_cli_poltrona").prop("disabled", false);
            dataTableuser.ajax.reload();
          } else {
            $(".print-error-msgSavePoltrona").css('display', 'block');
            $(".print-error-msgSavePoltrona").html(data.error);

            $('#clienteADMEnviar_poltrona').html('Salvar');
            $(".bt_adm_cli_poltrona").prop("disabled", false);
          }
        }
      });
    });

    /**================================================ CLIENTE VIAGEM ================================================= */
    $(document).on('click', '.clienteAgendadaViagem', function() {
      var cliAgVig_id = $(this).attr("id");

      $.ajax({
        url: "<?= site_url('dados-cliente-agendada-viagem/') ?>" + cliAgVig_id,
        method: "GET",
        data: {
          cliAgVig_id: cliAgVig_id
        },
        dataType: "json",
        success: function(data) {
          $('#clientedadosViagemstaticBackdrop').modal('show');
          $('#cli_Viagem_cliente').val(data.cli_Viagem_cliente);
          $('#cli_Viagem_cidade_destino_carro').val(data.cli_Viagem_cidade_destino_carro);
          $('#cli_Viagem_cidade_chegada_carro').val(data.cli_Viagem_cidade_chegada_carro);
          $('#cli_Viagem_cliente_saida').val(data.cli_Viagem_cliente_saida);
          $('#cli_Viagem_cliente_chegada').val(data.cli_Viagem_cliente_chegada);
          $('#cli_Viagem_placa_carro').val(data.cli_Viagem_placa_carro);
          $('#cli_Viagem_data_saida').val(data.cli_Viagem_data_saida);
          $('#cli_Viagem_hora_saida').val(data.cli_Viagem_hora_saida);
          $('#cli_Viagem_agencia_cadastro').val(data.cli_Viagem_agencia_cadastro);
          $('#cli_Viagem_agencia_agente').val(data.cli_Viagem_agencia_agente);
          $('#cli_Viagem_poltrona').val(data.cli_Viagem_poltrona);
          $('#cli_Viagem_poltronaStatus').val(data.cli_Viagem_poltrona_status);
          $('#cli_Viagem_data_cadastro').val(data.cli_Viagem_data_cadastro);
          $('#cli_Viagem_observaçãoes').val(data.cli_Viagem_observaçãoes);
          $('#cliAgVig_id').val(cliAgVig_id);
        }
      })
    });


    function dados_calendar() {
      var calendar = $('#calendar').fullCalendar({

        eventSources: [{
          color: '#FF1493',
          textColor: '#000000',
          events: []
        }],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'Hoje',
          month: 'Mês',
          week: 'Semana',
          day: 'Dia'
        },
        events: "<?= site_url('calendario-viagens') ?>",
        selectable: true,
        selectHelper: true,

        eventClick: function(event) {
          var id_vg = event.id;
          $.ajax({
            url: "<?= site_url('lista-carro-viagem/') ?>" + id_vg,
            type: "GET",
            data: {
              id_vg: id_vg
            },
            dataType: "json",
            success: function(data) {
              calendar.fullCalendar('refetchEvents');
              $('#listaPoltronasModal').modal('show');

              $('#calendar_car_cidade_saida').val(data.calendar_car_cidade_saida);

              let viagemKey = data['calendar_car_key_viagem'];
              $('#kyviagemKey').html(viagemKey);

              let city_sai = data['calendar_car_city_saida'];
              $('#cityMySaida').html(city_sai);

              let city_chega = data['calendar_car_city_chega'];
              $('#cityMychegada').html(city_chega);

              let placaSaidaCar = data['calendar_car_placa_saida'];
              $('#placaMySaida').html(placaSaidaCar);

              let localSaidaCar = data['calendar_car_local_saida'];
              $('#localMySaida').html(localSaidaCar);

              let dataMcarSaida = data['calendar_car_data_saida'];
              $('#dataMySaida').html(dataMcarSaida);

              let hora_my_saida = data['calendar_car_hora_saida'];
              $('#horaMySaida').html(hora_my_saida);

              $('#id_calendar_pol').val(id_vg);
              load_poltrona_carro_viagem(id_vg);
              show_product(id_vg);
            }
          })
        }

      });
    }


    function show_product(id_vg) {
      $.ajax({
        type: 'ajax',
        url: '<?php echo site_url('escolhe-poltrona-do-carro-viagem/') ?>' + id_vg,
        async: true,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' +
              '<button type="button" class="btn btn-primary" onclick="myFunction(' + data[i].poltrona_carro_cpcv + ')">' +
              '<i class="material-icons"> airline_seat_recline_normal </i> ' +
              '<span class="badge badge-light">' + data[i].poltrona_carro_cpcv + '</span>' +
              '</button>' +
              '</td>' +
              '<td>' +
              '<button type="button" class="btn btn-primary" onclick="myFunction(' + data[i].poltrona_corretor_d + ')"> ' +
              '<i class="material-icons"> airline_seat_recline_normal </i>' +
              '<span class="badge badge-light">' + data[i].poltrona_corretor_d + '</span>' +
              '</button>' +
              '</td>' +
              '<td>' +
              '<button type="button" class="btn btn-primary" onclick="myFunction(' + data[i].poltrona_corretor_e + ')"> ' +
              '<i class="material-icons"> airline_seat_recline_normal </i>' +
              '<span class="badge badge-light">' + data[i].poltrona_corretor_e + '</span>' +
              '</button>' +
              '</td>' +
              '<td>' +
              '<button type="button" class="btn btn-primary" onclick="myFunction(' + data[i].poltrona_corredor_e_janela + ')"> ' +
              '<i class="material-icons"> airline_seat_recline_normal </i>' +
              '<span class="badge badge-light">' + data[i].poltrona_corredor_e_janela + '</span>' +
              '</button>' +
              '</td>' +
              '</tr>';
          }
          $('#show_data').html(html);
        }

      });
    }


    /**lista tabela das poltronas carro */

    function load_poltrona_carro_viagem(id_vg) {
      $.ajax({
        url: "<?= site_url('lista-poltronas-do-carro-para-viagem/') ?>" + id_vg,
        method: "GET",
        data: {
          id_vg: id_vg
        },
        success: function(data) {
          $('#result_table_car_viagem').html(data);
        }
      })
    }

    $(id_vg).click(function() {
      var search = $(this).val();
      alert(search);
      if (search != '') {
        load_poltrona_carro_viagem(search);
      } else {
        load_poltrona_carro_viagem();
      }
    });

  });
</script>