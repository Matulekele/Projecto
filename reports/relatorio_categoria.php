<?php

include_once ("../includes/conexao.php");

$sql = "
    SELECT 
        categoria.id_categoria, 
        categoria.nome_categoria, 
        categoria.descricao, 
        COUNT(patrimonio.id_patrimonio) AS nupatrimonio
    FROM categoria
    LEFT JOIN patrimonio 
        ON categoria.id_categoria = patrimonio.categoria
    GROUP BY categoria.id_categoria, categoria.nome_categoria, categoria.descricao
";

$res = $conn->query($sql);

$html = "
    <div style='text-align: center; margin-bottom: 30px;'>
        <h2>INSTITUTO MÉDIO POLITÉCNICO DO UÍGE</h2>
        <h3>ÁREA PATRIMONIAL</h3>
        <h4>RELATÓRIO DE CATEGORIAS</h4>
    </div>";

if ($res && $res->num_rows > 0) {
    $html .= "
        <table style='width: 100%; border: 1px solid #ccc; border-collapse: collapse; line-height: 25px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;'>
            <thead>
                <tr style='background: #eeeeedd3; padding: 8px;'>
                    <th style='border: 1px solid #ccc; text-align: center;'>ID da Categoria</th>
                    <th style='border: 1px solid #ccc; text-align: left;'>Nome da Categoria</th>
                    <th style='border: 1px solid #ccc; text-align: left;'>Descrição</th>
                    <th style='border: 1px solid #ccc; text-align: center;'>Nº Patrimonio</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $res->fetch_object()) {
        $html .= "
            <tr>
                <td style='border: 1px solid #ccc; text-align: center;'>{$row->id_categoria}</td>
                <td style='border: 1px solid #ccc;'>{$row->nome_categoria}</td>
                <td style='border: 1px solid #ccc;'>{$row->descricao}</td>
                <td style='border: 1px solid #ccc; text-align: center;'>{$row->nupatrimonio}</td>
            </tr>";
    }

    $html .= "</tbody></table>";
} else {
    $html .= "<p style='text-align: center; color: red;'>Nenhum dado encontrado!</p>";
}

use Dompdf\Dompdf;
require_once '../dompdf-3.0.1/./dompdf/autoload.inc.php';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->set_option('defaultFont', 'Arial');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"Relatorio_Categorias.pdf\"");

echo $dompdf->output();
?>