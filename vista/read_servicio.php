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

    include_once "../dao/ServicioDao.php";
    include_once "../modelo/ServicioModelo.php";

//Valida el parametro GET en la URL
    if (!isset($_GET['id']) || $_GET['id'] == 0) {
        die('Error con el ID');
    } else {
        //Obtiene el id del servicio a modificar.
        $id = $_GET['id'];

        //Instancia hacia ClienteDao y se busca el cliente por su ID
        $servicio = new ServicioDao();

        $servicioM = $servicio->readId($id);

        if (is_null($servicioM)) {
            $page_title = "Servicio NULL";
            die('El servicio fue alterado en otro proceso');
        } else {
            //Establece el titulo de la pagina
            $page_title = "Consultar servicio";
            include_once "template/header.php";
            ?>
            <form action='' >
                <table class='table table-hover'>
                    <tr>
                        <td>Nombre Servicio</td>
                        <td><input type='text' name='nombreServicio' value="<?php echo $servicioM->getNombreServicio(); ?>" class="form-control" readonly="TRUE"></td>
                    </tr>
                    <tr>
                        <td>Costo Servicio</td>
                        <td><input type='text' name='costoServicio' value="<?php echo $servicioM->getCostoServicio(); ?>" class="form-control" readonly="TRUE"></td>
                    </tr>
                </table>
            </form>
            <div class="right-button-margin ">
                <a href='list_servicio.php' class='btn btn-primary'>Consultar</a>
            </div>
            <?php
            include_once "template/footer.php";
        }
    }
}
?>