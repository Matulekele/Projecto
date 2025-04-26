<?php
    
    include_once ("../includes/conexao.php");

    $sql = "
        SELECT 
            patrimonio.id_patrimonio,
            patrimonio.nome,
            patrimonio.marca,
            patrimonio.modelo,
            patrimonio.quantidade,
            patrimonio.estado,
            localizacao.nome AS localizacao,
            responsaveis.responsavel AS responsavel,
            categoria.nome_categoria AS categoria
        FROM patrimonio
        LEFT JOIN categoria 
            ON patrimonio.categoria = categoria.id_categoria
        LEFT JOIN localizacao 
            ON patrimonio.localizacao = localizacao.id_localizacao 
        LEFT JOIN responsaveis
            ON patrimonio.responsavel = responsaveis.id_responsavel
        WHERE patrimonio.estado = 'Bom'
    ";


    $res = $conn->query($sql);

    $html = "
        <div style='text-align: center; margin-bottom: 30px;'>
            <h2>INSTITUTO POLITÉCNICO DO UÍGE</h2>
            <h3>ÁREA PATRIMONIAL</h3>
            <h4>RELATÓRIO DE BENS EM BOM ESTADO</h4>
        </div>";

    if ($res && $res->num_rows > 0) {
        
        $html .= "
            <table style='width: 100%; border: 1px solid #ccc; border-collapse: collapse; line-height: 25px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;'>
                <thead>
                    <tr style='background: #eeeeedd3; padding: 8px;'>
                        <th style='border: 1px solid #ccc; text-align: center;'>ID</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Nome</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Marca</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Modelo</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Categoria</th>
                        <th style='border: 1px solid #ccc; text-align: center;'>Quantidade</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Estado</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Localização</th>
                        <th style='border: 1px solid #ccc; text-align: left;'>Responsável</th>
                    </tr>
                </thead>
                <tbody>";

        
        while ($row = $res->fetch_object()) {
            $html .= "
                <tr>
                    <td style='border: 1px solid #ccc; text-align: center;'>{$row->id_patrimonio}</td>
                    <td style='border: 1px solid #ccc;'>{$row->nome}</td>
                    <td style='border: 1px solid #ccc;'>{$row->marca}</td>
                    <td style='border: 1px solid #ccc;'>{$row->modelo}</td>
                    <td style='border: 1px solid #ccc;'>{$row->categoria}</td>
                    <td style='border: 1px solid #ccc; text-align: center;'>{$row->quantidade}</td>
                    <td style='border: 1px solid #ccc;'>{$row->estado}</td>
                    <td style='border: 1px solid #ccc;'>{$row->localizacao}</td>
                    <td style='border: 1px solid #ccc;'>{$row->responsavel}</td>
                </tr>";
        }

        $html .= "</tbody></table>";
    } else {
        $html .= "<p style='text-align: center; color: red;'>Nenhum equipamento em bom estado encontrado!</p>";
    }

    
    use Dompdf\Dompdf;
    require_once '../dompdf-3.0.1/./dompdf/autoload.inc.php';

    
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option('defaultFont', 'Arial');
    $dompdf->setPaper('A4', 'landscape'); // Define orientação como paisagem
    $dompdf->render();

    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"Relatório.pdf\"");

    echo $dompdf->output();
?>