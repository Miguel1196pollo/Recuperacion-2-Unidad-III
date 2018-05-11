<?php

include_once '../configuracion/DAO.php';
include_once '../modelo/ServicioModelo.php';

class ServicioDao extends DAO {
    
    protected $tabla = 'servicio'; //Mapeo a tabla
    
    public function insertarServicio(ServicioModelo $servicio) {
        $consulta = "(nombreServicio, costoServicio) ";

        $consulta = $consulta . "values ('" . $servicio->getNombreServicio() . "', '" . $servicio->getCostoServicio() . "')";

        return $this->create($consulta);
    }
    
    /**
     * Método que imprime el grid de los registros en servicios
     */
    public function gridHtml1() {
        $tableHtml = "";

        $registros = $this->readTabla();

        if ($registros->rowCount() > 0) {
            while ($row = $registros->fetch(PDO::FETCH_ASSOC)) {
                $idServicio = $row['idServicio'];
                
                $tableHtml = $tableHtml . "<tr>" .
                        "<td>" . $row['idServicio'] . "</td>" .
                        "<td>" . $row['nombreServicio'] . "</td>" .
                        "<td>" . $row['costoServicio'] . "</td>" .
                       
                        "</tr>";
                        
            }
            return $tableHtml;
        }
    }
    
    /**
     * Método que imprime el grid de los registros en servicios
     */
    public function gridHtml() {
        $tableHtml = "";

        $registros = $this->readTabla();

        if ($registros->rowCount() > 0) {
            while ($row = $registros->fetch(PDO::FETCH_ASSOC)) {
                $idServicio = $row['idServicio'];
                
                $tableHtml = $tableHtml . "<tr>" .
                        "<td>" . $row['idServicio'] . "</td>" .
                        "<td>" . $row['nombreServicio'] . "</td>" .
                        "<td>" . $row['costoServicio'] . "</td>" .
                        "<td><a href='read_servicio.php?id=" . $idServicio . "' class='btn btn-primary left-margin'>"
                        . "<span class='glyphicon glyphicon-list'></span>Leer</a></td>" .
                        "<td><a href='update_servicio.php?id=" . $idServicio . "' class='btn btn-info left-margin'>"
                        . "<span class='glyphicon glyphicon-edit'></span>Editar</a></td>" .
                        "<td><a href='delete_servicio.php?id=" . $idServicio . "' class='btn btn-danger delete-object' onclick='return confirmation()'>"
                        . "<span class='glyphicon glyphicon-remove'></span>Eliminar</a></td>" .
                        "</tr>";
                        
            }
            return $tableHtml;
        }
    }

    /**
     * 
     * @param type $idServicio
     * @return \ServicioModelo
     */
    public function readId($idServicio) {
        //Objeto tipo servicio para retornar el servicio buscado
        $servicio = null;

        $registros = $this->readTabla();

        if ($registros->rowCount() > 0) {
            while ($row = $registros->fetch(PDO::FETCH_ASSOC)) {
                if ($idServicio == $row['idServicio']) {
                    $servicio = new ServicioModelo();

                    $servicio->setNombreServicio($row['nombreServicio']);
                    $servicio->setCostoServicio($row['costoServicio']);
                    $servicio->setIdServicio($row['idServicio']);
                    
                }
            }
        }
        return $servicio;
    }

    /**
     * Método que modifica el registro en la base de datos
     * @return boolean True exitosamente y False no exitoso
     */
    public function updateServicio(ServicioModelo $servicio) {
        $update = "UPDATE " . $this->tabla .
                " SET " .
                " nombreServicio= '" . $servicio->getNombreServicio(). "', " .
                " costoServicio= '" . $servicio->getCostoServicio() . "'" .
                " where idServicio= " . $servicio->getIdServicio();

        return $this->update($update);
    }

    public function deleteServicio($id) {
        return $this->delete($id);
    }

}
