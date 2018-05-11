<?php
/**
 * Description of delete_servicio
 *
 * @author pollo
 */
session_start();
if (!isset($_SESSION['sesion'])) {
    ?>
    <!--Solo el Administrador puede ver los servicios del dia-->
    <script type="text/javascript">
        window.location.href = "../";
    </script>
    <?php
} else {
///Valida el parametro GET en la URL
    if (!isset($_GET['id']) || $_GET['id'] == 0) {
        die('Error con el ID');
    } else {
        include_once "../dao/ServicioDao.php";
        include_once "../modelo/ServicioModelo.php";

        //Obtiene el id del servicio a modificar.
        $id = $_GET['id'];

        //Instancia hacia ServicioDao y se busca el servicio por su ID
        $servicio = new ServicioDao();

        //Establece el titulo de la pagina
        $page_title = "Servicio Eliminado";
        include_once "template/header.php";

        if ($servicio->deleteServicio($id)) {
            echo "<div class='alert alert-success'>Servicio eliminado exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>No es posible eliminar el servicio.</div>";
        }
        echo '<div class = "right-button-margin ">
            <a href = "../" class = "btn btn-primary">Continuar</a>
        </div>';
        
        include_once "template/footer.php";
    }
}
?>

