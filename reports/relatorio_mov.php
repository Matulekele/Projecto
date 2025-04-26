<?php
 
 include_once ("../includes/conexao.php");

    $sql = "
        SELECT 
            movimentacao.id_movimentacao,
            patrimonio.nome AS patrimonio,
            loc_antigo.nome AS local_antigo,
            loc_novo.nome AS local_novo,
            responsaveis.responsavel,
            movimentacao.estado,
            movimentacao.motivo,
            movimentacao.datamovimentacao
        FROM movimentacao
        INNER JOIN patrimonio 
            ON movimentacao.id_patrimonio = patrimonio.id_patrimonio
        LEFT JOIN localizacao AS loc_antigo 
            ON movimentacao.id_localantigo = loc_antigo.id_localizacao
        LEFT JOIN localizacao AS loc_novo 
            ON movimentacao.id_localnovo = loc_novo.id_localizacao
        LEFT JOIN responsaveis 
            ON movimentacao.id_responsavel = responsaveis.id_responsavel
        ORDER BY movimentacao.datamovimentacao DESC
    ";

    $res = $conn->query($sql);

    $html = "
        <div style='text-align: center; margin-bottom: 30px;'>
            <h2>INSTITUTO POLITÉCNICO DO UÍGE</h2>
            <h3>ÁREA PATRIMONIAL</h3>
            <h4>RELATÓRIO DE MOVIMENTAÇÕES</h4>
        </div>";

    if ($res && $res->num_rows > 0) {
        
        $html .= "
            <table style='width: 100%; border: 1px solid #ccc; border-collapse: collapse; line-height: 25px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;'>
                <thead>
                    <tr style='background: #eeeeedd3; padding: 8px;'>
                        <th style='border: 1px solid #ccc; text-align: center;'>ID</th>
                        <th style='border: 1px solid #ccc;'>Patrimônio</th>
                        <th style='border: 1px solid #ccc;'>Localização Antiga</th>
                        <th style='border: 1px solid #ccc;'>Localização Nova</th>
                        <th style='border: 1px solid #ccc;'>Responsável</th>
                        <th style='border: 1px solid #ccc; text-align: center;'>Estado</th>
                        <th style='border: 1px solid #ccc;'>Motivo</th>
                        <th style='border: 1px solid #ccc; text-align: center;'>Data da Movimentação</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $res->fetch_object()) {
            $html .= "
                <tr>
                    <td style='border: 1px solid #ccc; text-align: center;'>{$row->id_movimentacao}</td>
                    <td style='border: 1px solid #ccc;'>{$row->patrimonio}</td>
                    <td style='border: 1px solid #ccc;'>{$row->local_antigo}</td>
                    <td style='border: 1px solid #ccc;'>{$row->local_novo}</td>
                    <td style='border: 1px solid #ccc;'>{$row->responsavel}</td>
                    <td style='border: 1px solid #ccc; text-align: center;'>{$row->estado}</td>
                    <td style='border: 1px solid #ccc;'>{$row->motivo}</td>
                    <td style='border: 1px solid #ccc; text-align: center;'>{$row->datamovimentacao}</td>
                </tr>";
        }

        $html .= "</tbody></table>";
    } else {
        $html .= "<p style='text-align: center; color: red;'>Nenhuma movimentação encontrada!</p>";
    }

    use Dompdf\Dompdf;
    require_once '../dompdf-3.0.1/dompdf/autoload.inc.php';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option('defaultFont', 'Arial');
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"Relatorio_Movimentacoes.pdf\"");

    echo $dompdf->output();
?>