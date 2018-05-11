<?php
include_once "../dao/ServicioDao.php";

//Instancia hacia ServicioDao
$servicio = new ServicioDao();

// Establece cabecera
$page_title = "Listado de Servicios";
include_once "template/header.php";
?>
<div class="right-button-margin ">
    <a href='../index.php' class='btn btn-primary'>Reresar al inicio</a>
</div>
<br>
<table class='table table-hover' id='tabla1'>
    <thead>
        <tr>
            <td>Id Servicio</td>
            <th>Nombre Servicio</td>
            <td>Costo Servicio</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        <?Php
        echo $servicio->gridHtml1(); // Se comentan parametros [hpastortest] -- $num_registro, $reg_por_pagina
        ?>
    </tbody>
</table>
<?Php
// Establece el footer
//include_once "template/footer.php";
?>
