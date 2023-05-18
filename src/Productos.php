<?php 
    namespace novedadeslety;
   
    class Productos{
        private $config;
        private $cn=null;
        public function __construct()
        {
            // leer el contenido de ese archivo
            $this->config=parse_ini_file(__DIR__.'/../config.ini');
            $this->cn= new \PDO($this->config['dns'],$this->config['usuario'],
            $this->config['clave'],array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));
        } 
        public function registrarProducto($clave,$nombre,$descripcion,$foto,$precio,$existencias,$id_categoria,$id_marca){
            $sql="CALL inserta_producto('$clave','$nombre','$descripcion','$foto',$precio,$existencias,'$id_categoria','$id_marca')";
            $pre=$this->cn->prepare($sql);
            $pre->execute();
            $resultado = $pre->fetchAll(\PDO::FETCH_ASSOC);
            // foreach($resultado as $row){
            //     $message=$row['MENSAJE'];
            // }
        }
        public function actualizarProducto($clave,$nombre,$descripcion,$foto,$precio,$existencias,$id_categoria,$id_marca){
            $sql="CALL actualizar_producto('$clave','$nombre','$descripcion','$foto',$precio,$existencias,'$id_categoria','$id_marca')";
            $pre=$this->cn->prepare($sql);
            $pre->execute();
            $resultado = $pre->fetchAll(\PDO::FETCH_ASSOC);
            foreach($resultado as $row){
                $message=$row['MENSAJE'];
            }
        }
        public function eliminarProducto($clave){
            $sql="CALL eliminar_producto('$clave')";
            $pre=$this->cn->prepare($sql);
            $pre->execute();
            $resultado = $pre->fetchAll(\PDO::FETCH_ASSOC);
            foreach($resultado as $row){
                $message=$row['MENSAJE'];
            }
        }
        public function mostrarProductos(){
            $sql="CALL mostrar_productos()";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        }
        public function mostrarProductosPorID($clave){
            $sql="CALL mostrar_productos_clave('$clave')";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetch(\PDO::FETCH_ASSOC);
            return false;
        }
        public function mostrarProductosVender(){
            $sql="CALL mostrar_productos_vender()";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        }
    }
?>