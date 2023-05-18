<?php 
    namespace novedadeslety;
   
    class marca{
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
        public function mostrarMarca(){
            $sql="CALL mostrar_marca()";
            $pre=$this->cn->prepare($sql);
            if($pre->execute())
                return  $pre->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        }
    }
?>