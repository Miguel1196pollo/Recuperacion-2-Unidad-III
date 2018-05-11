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
        //Obtiene el id del cliente a modificar.
        $id = $_GET['id'];

        //Instancia hacia ClienteDao y se busca el cliente por su ID
        $servicio = new ServicioDao();

        $servicioM = $servicio->readId($id);

        if (is_null($servicioM)) {
            $page_title = "Servicio NULL";
            die('El servicio fue alterado en otro proceso');
        } else {
            //Establece el titulo de la pagina
            $page_title = "Actualizar servicio";
            include_once "template/header.php";
            ?>
            <!--Script que ayuda a mandar un alerta si queremos enviar el formulario -->
            <script language="JavaScript">
                function pregunta() {
                    if (confirm('¿Estas seguro de editar los datos?')) {
                        document.form.submit()
                    }
                }
            </script> 

            <!-- Boton paraa consultar citas -->
            <div class="right-button-margin ">
                <a href='list_servicio.php' class='btn btn-primary'>Consultar</a>
            </div>

            <form action='' method='POST'>
                <table class='table table-hover'>
                    <tr>
                        <td>Nombre Servicio</td>
                        <td><input type='text' name='nombreServicio' value="<?php echo $servicioM->getNombreServicio(); ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Costo Servicio</td>
                        <td><input type='text' name='costoServicio' value="<?php echo $servicioM->getCostoServicio(); ?>" class="form-control"></td>
                    </tr>

                    <td>&nbsp;</td>
                        <td><button type='submit' name='enviar' id='enviar' class="btn btn-primary" onclick=" return pregunta()">Modificar Servicio</button></td>
                    </tr>
                </table>
            </form>
            <?php
            //Vía método POST
            // Forma a modificar el registro del servicio
            if ($_POST) {
                //Se inicializa un nuevo servicio
                $servicioMA = new ServicioModelo();

                $servicioMA->setNombreServicio($_POST['nombreServicio']);
                $servicioMA->setCostoServicio($_POST['costoServicio']);
                $servicioMA->setIdServicio($id);
                
                if ($servicio->updateServicio($servicioMA)) {
                    echo "<div class='alert alert-success'>Servicio modificado exitosamente.</div>";
                } else {
                    echo "<div class='alert alert-danger'>No es posible modificar el servicio.</div>";
                }
            }

            include_once "template/footer.php";
        }
    }
}
?>

