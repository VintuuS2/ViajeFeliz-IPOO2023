<?php

class viaje{
    private $codigo;
    private $destino;
    private $cupo;
    private $pasajeros=array();
    private $nombrePasajero;
    private $apellidoPasajero;
    private $dniPasajero;

    public function __construct($codigo, $destino, $cupo){
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->cupo = $cupo;
    }

    /**
     * Esta funcion devuelve el código del viaje
     * @return INT
     */
    public function getCodigo(){
        return $this->codigo;
    }

    /**
     * Esta función cambia el código del viaje por uno ingresado
     * @param INT $codigo
     * @return NULL
     */
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    /**
     * Esta función devuelve el destino del viaje
     * @return STRING
     */
    public function getDestino(){
        return $this->destino;
    }

    /**
     * Esta función cambia el destino del viaje por uno ingresado
     * @param STRING $destino
     * @return NULL
     */
    public function setDestino($destino){
        $this->destino = $destino;
    }

    /**
     * Esta función devuelve el cupo del viaje
     * @return INT
     */
    public function getCupo(){
        return $this->cupo;
    }

    /**
     * Esta función cambia el cupo del viaje por uno ingresado
     * @param INT @cupo
     * @return NULL
     */
    public function setCupo($cupo){
        $this->cupo = $cupo;
    }

    /**
     * Esta función devuelve el nombre del pasajero del viaje (último ingresado)
     * @return STRING
     */
    public function getNombrePasajero(){
        return $this->nombrePasajero;
    }

    /**
     * Esta función cambia el nombre del pasajero del viaje
     * @param STRING $nombrePasajero
     * @return  NULL
     */
    public function setNombrePasajero($nombrePasajero){
        $this->nombrePasajero = $nombrePasajero;
    }

    /**
     * Esta función devuelve el apellido del pasajero del viaje (último ingresado)
     * @return STRING
     */
    public function getApellidoPasajero(){
        return $this->apellidoPasajero;
    }

    /**
     * Esta función cambia el apellido del pasajero del viaje
     * @param STRING $apellidoPasajero
     * @return NULL
     */
    public function setApellidoPasajero($apellidoPasajero){
        $this->apellidoPasajero = $apellidoPasajero;
    }

    /**
     * Esta función devuelve el número de DNI del pasajero del viaje (último ingresado)
     * @return INT
     */
    public function getDniPasajero(){
        return $this->dniPasajero;
    }

    /**
     * Esta función cambia el número de DNI del pasajero del viaje
     * @param INT $dniPasajero
     * @return NULL
     */
    public function setDniPasajero($dniPasajero){
        $this->dniPasajero = $dniPasajero;
    }

    /**
     * Esta función devuelve un array de pasajeros
     * @return ARRAY
     */
    public function getPasajeros(){
        return $this->pasajeros;
    }

    /*public function setPasajeros($pasajeros, $nombre, $apellido,$dni){
        $this->pasajeros[$pasajeros]["nombre"]=$nombre;
        $this->pasajeros[$pasajeros]["apellido"]=$apellido;
        $this->pasajeros[$pasajeros]["dni"]=$dni;
    }*/

    /**
     * Esta función añade un pasajero al índice ingresado
     * @param INT $indice
     * @return NULL
     */
    public function setPasajeros($indice){
        $this->pasajeros[$indice]["nombre"]=$this->nombrePasajero;
        $this->pasajeros[$indice]["apellido"]=$this->apellidoPasajero;
        $this->pasajeros[$indice]["dni"]=$this->dniPasajero;
    }

    /**
     * Esta función elimina el pasajero del índice ingresado
     * @param INT $indice
     * @return NULL
     */
    public function eliminarPasajero($indice){
        array_splice($this->pasajeros,$indice,1);
    }

    public function __toString(){
        return "[Datos del viaje:\n"."Código: ".$this->codigo."\n"."Destino: ".$this->destino."\n"."Cupo: ".$this->cupo."]";
    }

    public function __destruct(){
        return $this. "Instancia destruida";
    }
}

/** 
 * Esta función crea un menú de opciones
 * @return NULL
 */
function crearMenu(){
    echo "\n***************************************************\n";
    echo "Bienvenido al menu de creacion de viaje \n";
    echo "***************************************************\n";
    echo "1) Cambiar código del viaje \n";
    echo "2) Cambiar destino del viaje \n";
    echo "3) Cambiar cupo del viaje \n";
    echo "4) Agregar pasajeros al viaje \n";
    echo "5) Eliminar pasajeros del viaje \n";
    echo "6) Modificar pasajeros del viaje \n";
    echo "7) Mostrar los datos del viaje \n";
    echo "8) Mostrar los datos de los pasajeros \n";
    echo "9) Salir \n";
    echo "***************************************************\n";
}

/**
 * Esta función permite seleccionar una opción dentro de las permitidas
 * @return INT
 */
function seleccionarOpcion(){
    $corte = 0;
    do {
        echo "Ingrese una opción: ";
        $opcion = trim(fgets(STDIN));
        if ($opcion >9 || $opcion<1){
            echo "Seleccione una opción correcta\n";
        } else {
            $corte = 1;
        }
    } while ($corte == 0);
    return $opcion;
}

/**
 * Esta función devuelve lo que se ingresó si es un número
 * @param INT $aux
 * @return INT
 */
function esNumero($aux){
    if (is_numeric($aux)){
        return $aux;
    }
}

/**
 * Esta función devuelve lo ingresado si es un string únicamente de letras
 * @param STRING $cadena
 * @return STRING
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 * Esta función cuenta los pasajeros del viaje
 * @param OBJECT $objeto
 * @return INT
 */
function contarPasajeros($objeto){
    return count($objeto->getPasajeros());
}

/**
 * Esta función permite leer un nombre
 * @return STRING
 */
function leerNombre(){
	do {
        echo "Ingrese el nombre del pasajero: ";
        $nombre = trim(fgets(STDIN));
        if (!esPalabra($nombre)){
			echo "ERROR. No es u nombre válido";
        }
    } while (!esPalabra($nombre));
    return $nombre;
}

/**
 * Esta función permite leer un apellido
 * @return STRING
 */
function leerApellido(){
	do {
		echo "Ingrese el apellido del pasajero: ";
		$apellido = trim(fgets(STDIN));
		if (!esPalabra($apellido)){
			echo "ERROR. No es un apellido válido";
		}
	} while (!esPalabra($apellido));
    return $apellido;
}

/**
 * Esta función permite leer un DNI
 * @return INT
 */
function leerDni(){
	do {
		echo "Ingrese el DNI del pasajero: ";
		$dni = trim(fgets(STDIN));
		if (!esNumero($dni)){
			echo "ERROR. No es un DNI válido";
		}
	} while (!esNumero($dni));
    return $dni;
}

?>