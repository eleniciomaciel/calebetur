<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center">Card de viagem</h2>

    <div class="card">
        <img src="<?php echo base_url('uploads/qr_image/' . $img_url_qd); ?>" alt="QRCode Image" style="width:100%">
        <h1><?php echo $dados_viagem['0']->us_nome; ?></h1>
        <p class="title">Motorista</p>
        <p>Calebetur viagens e turismo</p>
        <p class="title"><?php echo date("d/m/Y", strtotime($dados_viagem['0']->data_saida_vc)); ?></p>
        <p>
            <button>Imprimir</button>
        </p>
    </div>

</body>

</html>