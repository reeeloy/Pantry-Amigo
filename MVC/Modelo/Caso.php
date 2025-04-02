<?php
require_once 'ConexionBD.php';

class Caso {
    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionBD();
    }

    //regcasos dinero
    public function registrarCasoDinero($nombre, $descripcion, $montoMeta, $montoRecaudado, $fechaInicio, $fechaFin, $estado, $imagen = null, $voluntariado, $fundacionId, $categoriaNombre) {
        if ($this->conexion->abrir()) {
            // Si no se proporciona una imagen, se guarda como NULL en la base de datos
            $imagenSQL = $imagen ? "'$imagen'" : "NULL";
    
            $sql = "INSERT INTO tbl_casos_dinero (
                        Caso_Nombre, Caso_Descripcion, Caso_Monto_Meta, Caso_Monto_Recaudado, 
                        Caso_Fecha_Inicio, Caso_Fecha_Fin, Caso_Estado, Caso_Imagen, 
                        Caso_Voluntariado, Caso_Fund_Id, Caso_Cat_Nombre
                    ) 
                    VALUES (
                        '$nombre', '$descripcion', '$montoMeta', '$montoRecaudado',
                        '$fechaInicio', '$fechaFin', '$estado', $imagenSQL, 
                        '$voluntariado', '$fundacionId', '$categoriaNombre'
                    )";
    
            $this->conexion->consulta($sql);
            $filasAfectadas = $this->conexion->obtenerFilasAfectadas();
            $this->conexion->cerrar();
            return $filasAfectadas > 0;
        }
        return false;
    }
    

    //Registrar Caso Recurso
    public function registrarCasoRecursos($nombre, $descripcion, $fechaInicio, $fechaFin, $estado, $puntoRec, $imagen, $voluntariado, $fundacionId, $categoriaNombre) {
        if ($this->conexion->abrir()) {
            // Si no se proporciona una imagen, se guarda como NULL en la base de datos
            $imagenSQL = $imagen ? "'$imagen'" : "NULL";
    
            $sql = "INSERT INTO tbl_casos_recursos (
                        Caso_Nombre, Caso_Descripcion, Caso_Fecha_Inicio, Caso_Fecha_Fin, Caso_Estado, Caso_Punto_Recoleccion, Caso_Imagen, 
                        Caso_Voluntariado, Caso_Fund_Id, Caso_Cat_Nombre
                    ) 
                    VALUES (
                        '$nombre', '$descripcion','$fechaInicio', '$fechaFin', '$estado', '$puntoRec', $imagenSQL, 
                        '$voluntariado', '$fundacionId', '$categoriaNombre'
                    )";
    
            $this->conexion->consulta($sql);
            $filasAfectadas = $this->conexion->obtenerFilasAfectadas();
            $this->conexion->cerrar();
            return $filasAfectadas > 0;
        }
        return false;
    }

   

    // 🔍 Obtener todos los casos activos dinero
    public function obtenerCasosActivosDinero() {
        if ($this->conexion->abrir()) {
            
            $sql = "SELECT Caso_Id, Caso_Nombre, Caso_Descripcion FROM tbl_casos_dinero WHERE Caso_Estado = 'Activo'";
            $resultado = $this->conexion->consulta($sql);
            $this->conexion->cerrar();
            return $resultado;
        }
        return null;
    }

    // 🔍 Obtener todos los casos activos dinero
    public function obtenerCasosActivosRecursos() {
        if ($this->conexion->abrir()) {
            
            $sql = "SELECT Caso_Id, Caso_Nombre, Caso_Descripcion FROM tbl_casos_recursos WHERE Caso_Estado = 'Activo'";
            $resultado = $this->conexion->consulta($sql);
            $this->conexion->cerrar();
            return $resultado;
        }
        return null;
    }
    
}
?>


