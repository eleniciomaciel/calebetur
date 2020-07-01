<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de encomendas</title>
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

        .tg .tg-otn5 {
            font-weight: bold;
            background-color: #9b9b9b;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-h42r {
            font-weight: bold;
            background-color: #fffc9e;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-w8l0 {
            font-weight: bold;
            background-color: #fffc9e;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }
    </style>
</head>

<body>
<img src="<?= base_url() ?>stylus/assets/img/logo_geral.png" class="img-responsive" alt="Calebe Turismo">
    <table class="tg">
        <tr>
            <th class="tg-otn5">Linha: <?=$encomendas_list[0]->my_city_sai . ' / ' . $encomendas_list[0]->my_city_ch; ?></th>
            <th class="tg-otn5">Data da viagem: <?= date("d/m/Y", strtotime($encomendas_list[0]->data_saida_vc)) ?></th>
            <th class="tg-otn5">Hora da saída: <?= date("H:i", strtotime($encomendas_list[0]->hora_saida_vc)) ?></th>
            <th class="tg-otn5" colspan="4">código da viagem: <?= $encomendas_list[0]->controle_key_vc; ?></th>
        </tr>
        <tr>
            <td class="tg-h42r">Remetente:</td>
            <td class="tg-h42r">Produto descrição:</td>
            <td class="tg-h42r">Quantidade:</td>
            <td class="tg-h42r">Valor:</td>
            <td class="tg-h42r">Destinatário:</td>
            <td class="tg-h42r">Código:</td>
            <td class="tg-w8l0">Local de retirada:</td>
        </tr>
        <?php
        foreach ($encomendas_list as $key) {
        ?>
            <tr>
                <td class="tg-lboi"><?=$key->fk_nome_ciente_cl?></td>
                <td class="tg-lboi"><?=$key->descricao_peca_enc?></td>
                <td class="tg-lboi"><?=$key->qtd_produto_enc?></td>
                <td class="tg-lboi">R$ <?=number_format($key->valor_produto_enc, 2, ',', '.')?></td>
                <td class="tg-lboi"><?=$key->remetente_nome_enc?></td>
                <td class="tg-lboi"><?=$key->codigo_produto_enc?></td>
                <td class="tg-0lax"><?=$key->remetente_local_recebe_enc?></td>
            </tr>
        <?php
        }
        ?>

    </table>
</body>

</html>