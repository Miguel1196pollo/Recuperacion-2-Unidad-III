<?php
session_start();
if (!isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver los servicios del dia-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
} else {
//Establece el título de la página 
    $page_title = "Agregar un servicio para Barber Shop";
    include_once 'template/header.php';

    if ($_SESSION['sesion'] == 'admin') {
        ?>
        <div class="right-button-margin ">
            <a href='list_servicio.php' class='btn btn-primary'>Consultar</a>
        </div>
    <div class="right-button-margin ">
            <a href='list_cliente.php' class='btn btn-primary'>Reresar a lista de clientes</a>
        </div>
        <?php
    }
    ?>
    <!-- Aquí va el contenido a mostrar en la página  -->
    <!--Código del formulario HTML-->
    <form action='#' method='POST'>
        <table class='table table-hover'>
            <tr>
                <td>Nombre Servicio</td>
                <td><input type='text' name='nombreServicio' id='nombres'  class="form-control" required></td>
            </tr>
            <tr>
                <td>Costo Servicio</td>
                <td><input type='text' name='costoServicio' id='costoServicio' class="form-control" required ></td>
            </tr>

               <td>&nbsp;</td>
                <td><button type='submit' name='enviar' id='enviar' class="btn btn-primary">Guardar servicio</button></td>
            </tr>


        </table>
    </form>




    <?php
    include_once 'template/footer.php';

    //Vía método POST
    if ($_POST) {
        $slash = DIRECTORY_SEPARATOR;
        $base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
        include_once ("{$base_dir}modelo{$slash}ServicioModelo.php");
        include_once ("{$base_dir}dao{$slash}ServicioDao.php");

        $servicio = new ServicioModelo();

        $servicio->setNombreServicio($_POST['nombreServicio']);
        $servicio->setCostoServicio($_POST['costoServicio']);
        

        $servicioDao = new ServicioDao();

        if ($servicioDao->insertarServicio($servicio)) {
            echo "<div class='alert alert-success'>Servicio agregado exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>No es posible agregar los datos.</div>";
        }
    }
}
?>

