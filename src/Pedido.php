<?php 
    namespace novedadeslety;
   
    class Pedido{
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
        public function registrarPedido($idCliente,$total){
            $sql="CALL insertar_pedido(".$idCliente.",".$total.")";
            $pre=$this->cn->prepare($sql);
            if($pre->execute()){
                return $pre->fetch(\PDO::FETCH_ASSOC);
            }
            return false;
        }

        public function registrarDetalle($idPedido,$claveProducto,$precio,$cantidad){
            $sql="CALL INSERTAR_DETALLE_VENTA(".$idPedido.",'".$claveProducto."',".$precio.",".$cantidad.")";
            // print $sql;
            $pre=$this->cn->prepare($sql);
            if($pre->execute()){
                return true;
            }
            return false;
        }
        public function mostrarPedido(){
            $sql="CALL mostrar_pedidos()";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        }
        public function mostrarDatosClientePedido($idPedido){
            $sql="CALL mostrar_pedido_id(".$idPedido.")";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetch(\PDO::FETCH_ASSOC);
            return false;
        }
        public function mostrarDetallePedido($idPedido){
            $sql="CALL mostrar_detalle_pedido(".$idPedido.")";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        }
        public function enviarPedido($idPedido){
            $sql="CALL pedido_enviado(".$idPedido.")";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return true;
            return false;
        }
       
    }
?>