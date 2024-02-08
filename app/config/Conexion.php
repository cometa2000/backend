<?php
    require_once realpath('../../vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable('../../');
    $dotenv->load();
    define('SERVER',$_ENV['DB_HOST']);
    define('DB',$_ENV['DB_DATABASE']);
    define('USER',$_ENV['DB_USERNAME']);
    define('PASS',$_ENV['DB_PASSWORD']);
    define('PORT',$_ENV['DB_PORT']);
    class Conexion{
        private static $conexion;

        public static function abrir_conexion(){
            if(!isset(self::$conexion)){
                try{
                    self::$conexion = new PDO('mysql:host='.SERVER.';dbname='.DB,USER,PASS);
                    self::$conexion->exec('SET CHARACTER SET utf8');
                    return self::$conexion;
                }catch(PDOException $e){
                    echo "Error en la conexion".$e;
                    die();
                }
            }else{
                return self::$conexion;
                
            }
        }

        public static function obtener_conexion(){
            $conexion = self::abrir_conexion();
            return $conexion;
        }

        public static function cerrar_conexion(){
            self::$conexion = null;
        }

        public static function consultar() {
            try {
                $conexion = Conexion::obtener_conexion();
                $query = "SELECT id, nombre, apellido, carrera, semestre FROM t_pueba";
                $stmt = $conexion->query($query);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "ID: ". $row['id'].",  Nombre: " . $row['nombre'] . ", Apellido: " . $row['apellido'] . ", Carrera: " . $row['carrera'] . ", Semestre: " . $row['semestre'] . "<br>";
                }

                Conexion::cerrar_conexion();
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e;
            }

        }

        public static function agregar($nombre, $apellido, $carrera, $semestre){
            try {
                $conexion = Conexion::obtener_conexion();
                $query = "INSERT INTO t_pueba (nombre, apellido, carrera, semestre) VALUES (?, ?, ?, ?)";
                $stmt = $conexion->prepare($query);
                $stmt->execute([$nombre, $apellido, $carrera, $semestre]);
                Conexion::cerrar_conexion();
                // echo "Registro agregado correctamente.";
            } catch (PDOException $e) {
                echo "Error al agregar el registro: " . $e;
            }
        }

        public static function actualizar($id, $nombre, $apellido, $carrera, $semestre){
            try {
                $conexion = Conexion::obtener_conexion();
                $query = "UPDATE t_pueba SET nombre=?, apellido=?, carrera=?, semestre=? WHERE id=?";
                $stmt = $conexion->prepare($query);
                $stmt->execute([$nombre, $apellido, $carrera, $semestre, $id]);
                Conexion::cerrar_conexion();
                // echo "Registro actualizado correctamente.";
            } catch (PDOException $e) {
                echo "Error al actualizar el registro: " . $e;
            }
        }

        public static function eliminar($id){
            try {
                $conexion = Conexion::obtener_conexion();
                $query = "DELETE FROM t_pueba WHERE id=?";
                $stmt = $conexion->prepare($query);
                $stmt->execute([$id]);
                Conexion::cerrar_conexion();
                // echo "Registro eliminado correctamente.";
            } catch (PDOException $e) {
                echo "Error al eliminar el registro: " . $e;
            }
        }


    }
    

    // Conexion::agregar('Ariel','Segura','SIS','2');
    // Conexion::actualizar(5,'Pepe','Barrera','GES','1');
    Conexion::consultar()
?>