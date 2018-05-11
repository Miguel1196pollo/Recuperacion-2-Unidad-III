<?php


class ServicioModelo {
    
    private $idServicio;
    private $nombreServicio;
    private $costoServicio;
    
    function getIdServicio() {
        return $this->idServicio;
    }

    function getNombreServicio() {
        return $this->nombreServicio;
    }

    function getCostoServicio() {
        return $this->costoServicio;
    }

    function setIdServicio($idServicio) {
        $this->idServicio = $idServicio;
    }

    function setNombreServicio($nombreServicio) {
        $this->nombreServicio = $nombreServicio;
    }

    function setCostoServicio($costoServicio) {
        $this->costoServicio = $costoServicio;
    }


}
