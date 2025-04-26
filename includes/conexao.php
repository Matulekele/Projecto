<?php

    $usuario = 'root';
    $senha = 'fabianoell7';
    $database = 'controlo';
    $host = 'localhost';

    $mysqli = new mysqli($host, $usuario, $senha, $database);

    if( $conn = mysqli_connect($host, $usuario, $senha, $database)){
        //echo "Conectado";
    }
    
    if ($mysqli->connect_errno) {
        die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
    }

    function mensagem($texto, $tipo) {
        echo " <div class='alert alert-$tipo' role='alert'>
                $texto
            </div> ";
    }

    function mostra_data($data) {
        $d = explode('-', $data);
        $escreve = $d[2] ."/" .$d[1] ."/" .$d[0];
        return $escreve;
    }

    function mover_foto($vetor_foto){
       
        $vtipo = explode("/", $vetor_foto['type']);
        $tipo = $vtipo[0] ?? '';
        $extensao = isset($vtipo[1]) ? "." .$vtipo[1] : '';

        if((!$vetor_foto['error']) and ($vetor_foto['size'] <= 500000) and  ($tipo == "image")){
            $nome_arquivo = date('Ymdhms') .$extensao;
            move_uploaded_file($vetor_foto['tmp_name'], "img/".$nome_arquivo);
            return $nome_arquivo;
        }else{
            return 0;
        }
    }

?>