<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Pedido.php';


use Dompdf\Dompdf;

$venta_id = $_GET['id'] ?? 0;
$ventaModel = new Venta();
$venta = $ventaModel->listar()[$venta_id - 1] ?? null;
$detalles = $ventaModel->detalles($venta_id);
$pedidoModel = new Pedido();
$pedido = $pedidoModel->listar()[$venta_id - 1] ?? null;
$descuento = $pedido['descuento'] ?? 0;

if (!$venta) {
    die("Venta no encontrada");
}

$html = '
<img src="https://oire.devsolutionsweb.com/images/logo.png" alt="Logo OIRË" style="width: 180px; margin-bottom: 10px;">
<style>
    body {
        font-family: 'Helvetica', sans-serif;
        font-size: 12px;
        color: #222;
        margin: 40px;
    }

    h1 {
        font-size: 20px;
        color: #111;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }

    p {
        line-height: 1.5;
        margin: 0 0 6px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 11.5px;
    }

    th {
        background-color: #444;
        color: #fff;
        padding: 6px;
        text-align: left;
        border: 1px solid #ccc;
    }

    td {
        padding: 6px;
        border: 1px solid #ddd;
    }

    .total {
        font-weight: bold;
        background-color: #f5f5f5;
    }

    .footer {
        font-size: 10px;
        text-align: center;
        color: #777;
        margin-top: 30px;
        border-top: 1px solid #ddd;
        padding-top: 8px;
    }
</style>

<h1>Factura OIRË</h1>
<p><strong>Cliente:</strong> ' . htmlspecialchars($venta['cliente_nombre']) . '<br>
<strong>Fecha:</strong> ' . $venta['fecha_venta'] . '<br>
<strong>Descuento aplicado:</strong> ' . $descuento . '%</p>
<table>
    <thead>
        <tr><th>Perfume</th><th>Cantidad</th><th>Precio unitario</th><th>Subtotal</th></tr>
    </thead>
    <tbody>';

$total = 0;
foreach ($detalles as $d) {
    $sub = $d['cantidad'] * $d['precio_unitario'];
    $total += $sub;
    $html .= '<tr>
        <td>' . htmlspecialchars($d['nombre']) . '</td>
        <td>' . $d['cantidad'] . '</td>
        <td>$' . number_format($d['precio_unitario'], 2) . '</td>
        <td>$' . number_format($sub, 2) . '</td>
    </tr>';
}
$html .= '
    ' . ($descuento > 0 ? '
<tr>
    <td colspan="3">Subtotal</td>
    <td>$' . number_format($total, 2) . '</td>
</tr>
<tr>
    <td colspan="3">Descuento (' . $descuento . '%)</td>
    <td>-$' . number_format($total * $descuento / 100, 2) . '</td>
</tr>
<tr class="total">
    <td colspan="3">Total con descuento</td>
    <td>$' . number_format($total * (1 - $descuento / 100), 2) . '</td>
</tr>' : '
<tr class="total">
    <td colspan="3">Total</td>
    <td>$' . number_format($total, 2) . '</td>
</tr>') . '

    </tbody>
</table>';

<div class="footer">
    Gracias por tu compra. <br>
    OIRË Perfumería – Hecho a mano, en Medellín, Colombia<br>
    Contacto: +57 305 240 2862 – @oire.perfumeriamedellin
</div>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("factura-oire-$venta_id.pdf", ["Attachment" => false]);
