<?php
class Actividad
{
	// conexion de base de datos y tabla actividades
	private $conn;

	// atributos de la clase
	public $id;
	public $titulo;
	public $fecha;
	public $ubicacion;
	public $correo;
	public $repetir;
	public $repetir_inicio;
    public $repetir_final;
    public $tipo;
    public $hora;

	public $filtro;
	public $valor;

	// constructor con $db como conexion a base de datos
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// leer todas las actividades
	function read()
	{
		// query para seleccionar todos
		$query = "CALL sp_todas_actividades()";
		// sentencia para preparar query
		$stmt = $this->conn->prepare($query);
		// ejecutar query
		$stmt->execute();
		return $stmt;
	}

	function obtener_actividad(){
		$query = "CALL sp_obtener_actividad(?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		return $stmt;
	}

	function obtener_actividad_dia(){
		$query = "CALL sp_listar_actividades()";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function obtener_actividad_filtro(){
		$query = "CALL sp_listar_actividades_filtro(?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->filtro);
		$stmt->bindParam(2, $this->valor);
		$stmt->execute();
		return $stmt;
	}

	function registrar()
	{
		$query = "CALL sp_registrar_actividades(?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		
		// bind values
		$stmt->bindParam(1, $this->titulo);
		$stmt->bindParam(2, $this->fecha);
		$stmt->bindParam(9, $this->hora);
		$stmt->bindParam(3, $this->ubicacion);
		$stmt->bindParam(4, $this->correo);
		$stmt->bindParam(5, $this->repetir);
		$stmt->bindParam(6, $this->repetir_inicio);
		$stmt->bindParam(7, $this->repetir_final);
		$stmt->bindParam(8, $this->tipo);

		// execute query
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	function actualizar(){
		$query = "CALL sp_actualizar_actividad(?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->titulo);
		$stmt->bindParam(3, $this->fecha);
		$stmt->bindParam(10, $this->hora);
		$stmt->bindParam(4, $this->ubicacion);
		$stmt->bindParam(5, $this->correo);
		$stmt->bindParam(6, $this->repetir);
		$stmt->bindParam(7, $this->repetir_inicio);
		$stmt->bindParam(8, $this->repetir_final);
		$stmt->bindParam(9, $this->tipo);

		if($stmt->execute()){
			return true;
		}
		return false;
	}

	function eliminar(){
		$query = "CALL sp_eliminar_actividad(?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		
		if($stmt->execute()){
			return true;
		}
		return false;
	}
}
?>
