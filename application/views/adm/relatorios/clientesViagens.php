<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerário-ônibus</title>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg th {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg .tg-lboi {
            border-color: inherit;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-v0hj {
            font-weight: bold;
            background-color: #efefef;
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-qbk9 {
            font-weight: bold;
            background-color: #efefef;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-c3ow {
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-xhg5 {
            font-family: "Lucida Console", Monaco, monospace !important;
            ;
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-h5uz {
            font-family: "Lucida Console", Monaco, monospace !important;
            ;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-uc5x {
            font-weight: bold;
            background-color: #fffc9e;
            border-color: inherit;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-0iu2 {
            background-color: #fffc9e;
            border-color: inherit;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-elvq {
            background-color: #fffc9e;
            border-color: inherit;
            text-align: left;
            vertical-align: top
        }
    </style>
</head>

<body>
    <img src="<?= base_url() ?>stylus/assets/img/logo_geral.png" class="img-responsive" alt="Calebe Turismo">
    <table class="tg">
        <tr>
            <th class="tg-lboi" colspan="2">Calebe Tur</th>
            <th class="tg-c3ow"><span style="font-weight:bold">Data da viagem:</span> <?php echo date("d/m/Y", strtotime($dados_viagem['0']->data_saida_vc)) ?></th>
            <th class="tg-c3ow" colspan="2"><span style="font-weight:bold">Cód.:/Viagem:</span> <?php echo $dados_viagem['0']->controle_key_vc; ?></th>
        </tr>
        <tr>
            <td class="tg-uc5x">Itinerário</td>
            <td class="tg-0iu2"><span style="font-weight:bold">Origem:</span> <?php echo $dados_viagem['0']->my_city_sai; ?></td>
            <td class="tg-elvq" colspan="2"><span style="font-weight:bold">Destino: </span> <?php echo $dados_viagem['0']->my_city_ch; ?></td>
            <td class="tg-elvq"><span style="font-weight:bold">Carro:</span> <?php echo $dados_viagem['0']->placa_veic; ?></td>
        </tr>
        <tr>
            <td class="tg-qbk9">Clientes:</td>
            <td class="tg-qbk9">Documentos:</td>
            <td class="tg-qbk9">Saída:</td>
            <td class="tg-v0hj">Destino: </td>
            <td class="tg-v0hj">Poltrona:</td>
        </tr>

        <?php
        foreach ($dados_viagem as $key) {
        ?>
            <tr>
                <td class="tg-h5uz"><?php echo $key->fk_nome_ciente_cl; ?></td>
                <td class="tg-h5uz">CPF: <?php echo $key->cpf_cl; ?></td>
                <td class="tg-h5uz"><?php echo $key->cliente_saida_cpcv; ?></td>
                <td class="tg-xhg5"><?php echo $key->cliente_destino_cpcv; ?></td>
                <td class="tg-xhg5"><?php echo $key->poltrona_carro_cpcv; ?></td>
            </tr>
        <?php
        }
        ?>


        <!-- <tr>
            <td class="tg-lboi" colspan="5" rowspan="6"><span style="font-weight:bold">Observações do motorista sobre a viagem:</span><br>xxxx</td>
        </tr> -->
    </table>
    <br>
    <button class="btn-print">Imprimir relatorio</button>

    <script>
(function( w, d ) {
   'use strict'; 

   d.querySelector( '.btn-print' ).addEventListener( 'click', function() { w.print(); }, false );

}( window, document ));
</script>
</body>

</html>