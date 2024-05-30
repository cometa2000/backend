<?php
namespace controller;
use model\TablaCiber;
use config\Router;
use config\View;

class Ciber extends View {
	public function edit() {
		$id = $_POST['id'];
		$consulta = new TablaCiber();
        $ciber = $consulta->consulta()->where('id', $id)->first();
        return parent::vista('editForm', $ciber);

	}
	

    public function consulta_Datos() {
        $consulta = new TablaCiber();
        return parent::vista('principal', $consulta->consulta()->all());
    }
    public function insertar_Datos() {
        $nombre_maquina = $_POST['nombre_maquina'];
        $fecha_hora_actual = date("Y-m-d H:i:s");
        $dia_actual = date("Y-m-d");
        $datos = [
            'nombre_maquina' => $nombre_maquina,
            'tiempo_de_inicio' => $fecha_hora_actual,
            'cronometro' => '00:00:00',
            'dia' => $dia_actual,
            'precio' => 0
        ];
        $ciber = new TablaCiber();
        $resultado = $ciber->insercion($datos);
		if($resultado){
			$route = new Router();
			return $route->redirigir('principal');
		}
    }



    public function editar_Datos() {
        $id = $_POST['id'];
        $nombre_maquina = $_POST['nombre_maquina'];
        $ciber = new TablaCiber();
        $resultado = $ciber->actualizar(['nombre_maquina' => $nombre_maquina])->where('id', $id)->first();
		
		$route = new Router();
		return $route->redirigir('principal');
		
    }
    public function eliminar_Datos() {
        $id = $_POST['id'];
        $ciber = new TablaCiber();
        $resultado = $ciber->eliminar()->where('id', $id)->get();
		if($resultado){
			$route = new Router();
			return $route->redirigir('principal');
		}
    }
    public function pausar_Cronometro() {
        // Funcionalidad para pausar el cronómetro
    }
}
?>
