<?php
    //require_once('../configuration/conexion.php');
    require_once('/xampp/htdocs/applus/configuration/conexion.php');
    class consulta extends CredencialesDB{
        protected $id;
        protected $nombre;
        protected $cedula;
        protected $email;
        protected $estado;
        protected $c_depatamento;
        protected $c_centro_costo;
        protected $sexo;
        protected $fecha_nacimiento;
        protected $fecha_ingreso;
        protected $ubicacion;
        public function __autoload(){
            parent::__construct();
        }

        public function setId($id) {
            $this->id = $id;
        }
    
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
    
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
    
        public function setEmail($email) {
            $this->email = $email;
        }
    
        public function setEstado($estado) {
            $this->estado = $estado;
        }
    
        public function setC_Departamento($c_depatamento) {
            $this->c_depatamento = $c_depatamento;
        }
    
        public function setC_Centro_Costo($c_centro_costo) {
            $this->c_centro_costo = $c_centro_costo;
        }
    
        public function setSexo($sexo) {
            $this->sexo = $sexo;
        }
    
        public function setFecha_Nacimiento($fecha_nacimiento) {
            $this->fecha_nacimiento = $fecha_nacimiento;
        }
    
        public function setFecha_Ingreso($fecha_ingreso) {
            $this->fecha_ingreso = $fecha_ingreso;
        }
    
        public function setUbicacion($ubicacion) {
            $this->ubicacion = $ubicacion;
        }

        //función para mostrar a los emplados que no se han eliminado 
        public function listar_empleados(){
           
            $instruccion = "CALL sp_mostrar_empleados";
            $consulta = $this->_db->query($instruccion);
            
            if ($consulta) {
                $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
                $consulta->close(); 
                return $resultado;
            } else {
                return false;
            }
        }
        

        //función para validar si la cedula existe
        public function validar_cedula(){
            $instruccion = "CALL sp_validar_cedula";
            $consulta = $this->_db->query($instruccion);
            if ($consulta) {
                $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
                $consulta->close(); 
                return $resultado;
            } else {
                return false;
            }
        }
        

        //función para ingresar valores mediante el uso de un excel 
        public function insertar_empleados($id, $nombre, $cedula, $email, $estado, $c_depatamento, $c_centro_costo, $sexo, $fecha_nacimiento, $fecha_ingreso, $ubicacion){
            $instrucion = "CALL sp_insertar_empleado_mediante_tablas_excel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,  ?)";
            $stmt = $this->_db->prepare($instrucion);
            $stmt->bind_param("isssssssss",$id, $nombre, $cedula, $email, $estado, $c_depatamento, $c_centro_costo, $sexo, $fecha_nacimiento, $fecha_ingreso, $ubicacion);
            $stmt->execute();
        }
    }