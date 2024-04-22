<?php
    namespace controller;
    use model\TablaProductos;
    use config\Config;
    require_once realpath('.../../vendor/autoload.php');
    
    class Productos{
        public static function agregar_datos(){
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria']; 
            $presio = $_POST['presio'];

            $producto = new TablaProductos();
            $result = $producto->insercion([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'categoria' => $categoria,
                'presio' => $presio
            ]);
            
            $route = new Config;
            if ($result) {
                $route->redirigir('producto');
            } else {
                echo "<script>alert('Error al insertar los datos'); window.history.back();</script>";
            }
        }

        public static function eliminar_datos(){
            $id = $_POST['id'];

            $eliminar = new TablaProductos();
            $result = $eliminar->eliminar()->where(['id'=> $id]);

            $route = new Config;
            if ($result) {
                $route->redirigir('producto');
            } else {
                echo "<script>alert('Error al eliminar el datos'); window.history.back();</script>";
            }
        }

        public static function filtro(){
            $id = $_POST['categoria'];


            consulta_dato($id);


        }

        public static function consulta_dato($filtro = ''){

            $comsulta = new TablaProductos();
            $result = $comsulta->consulta()->all();
            return $result;
        }
    }

?>