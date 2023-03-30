<?php
include 'empresaTransporte.php';

/* PROGRAMA PRINCIPAL */
/* Este programa crea un viaje y permite cargar los datos del mismo y de los pasajeros */
/* INT $opcion, $pasajerosTotales, $aux, $aux2, $codigo, $cupo, $nuevoCodigo, $nuevoCupo
STRING $destino, $nuevoDestino
OBJECT $p */
$opcion=0;
$pasajerosTotales=0;
$aux=0;
$aux2=0;

echo "Bienvenido al creador de viajes\n";

do {
    echo "Ingrese código del viaje: ";
    $codigo = trim(fgets(STDIN));
    if (!esNumero($codigo)){
        echo "Ingrese un código númerico. \n";
    }
} while (!esNumero($codigo));

do {
    echo "Ingrese el destino del viaje: ";
    $destino = trim(fgets(STDIN));
    if (!esPalabra($destino)){
        echo "Ingrese un destino válido (Solo letras). \n";
    }
} while (!esPalabra($destino));

do {
    echo "Ingrese el cupo del viaje: ";
    $cupo = trim(fgets(STDIN));
    if (!esNumero($cupo)){
        echo "Ingrese un número válido. \n";
    }
} while (!esNumero($cupo));    
    
$p = new viaje($codigo,$destino,$cupo);

do {
    crearMenu();
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1:
            echo "Ingrese el código modificado: ";
            $nuevoCodigo = trim(fgets(STDIN));
            if (esNumero($nuevoCodigo)){
                $p->setCodigo($nuevoCodigo);
                echo "Ahora el código del viaje es: ",$p->getCodigo(),"\n";
            } else {
                echo "ERROR. No es un código numérico";
            }
            sleep(2);
            break;

        case 2:
            echo "Ingrese el destino modificado: ";
            $nuevoDestino = trim(fgets(STDIN));
            if (esPalabra($nuevoDestino)){
                $p->setDestino($nuevoDestino);
                echo "Ahora el destino del viaje es: ",$p->getDestino(),"\n";
            } else {
                echo "ERROR. No es una palabra";
            }
            sleep(2);
            break;

        case 3:
            echo "Ingrese el cupo modificado: ";
            $nuevoCupo = trim(fgets(STDIN));
            if (esNumero($nuevoCupo)){
                $p->setCupo($nuevoCupo);
                echo "Ahora el código del viaje es: ",$p->getCupo(),"\n";
            } else {
                echo "ERROR. No es un número";
            }
            sleep(2);
            break;

        case 4:
            if ($pasajerosTotales<($p->getCupo())){
                $p->setNombrePasajero(leerNombre());
                $p->setApellidoPasajero(leerApellido());
                $p->setDniPasajero(leerDni());
                $p->setPasajeros($aux-1);
                
                if ($pasajerosTotales==0){
                    $p->setPasajeros($pasajerosTotales);
                    echo "Pasajero agregado con éxito";
                    $pasajerosTotales++;
                } else {
                    for ($i=1;$i<=contarPasajeros($p);$i++){
                        if ($p->getPasajeros()[$i-1]["dni"] == $dni){
                            echo "ERROR. Este pasajero ya está registrado.";
                        } else {
                            $p->setPasajeros($pasajerosTotales);
                            echo "Pasajero agregado con éxito";
                            $pasajerosTotales++;
                        }
                    }
                }
            } else {
                echo "Error. No hay más cupo para el viaje \nPruebe modificando el cupo del mismo o seleccione otro viaje.\n";
            }
            sleep(2);
            break;

        case 5:
            if ($pasajerosTotales<1){
                echo "Error. No hay pasajeros para eliminar";
            } else {
                echo "Indica el pasajero a eliminar del 1 al ",contarPasajeros($p),": ";
                $aux = trim(fgets(STDIN));
                if ($aux<=contarPasajeros($p) && $aux>=1){
                    print_r($p->getPasajeros()[$aux-1]);
                    echo "Desea eliminar a este pasajero?\n 1:Si ; 0:No : ";
                    $aux2 = trim(fgets(STDIN));
                    if ($aux2 == 1){
                        $p->eliminarPasajero($aux-1);
                        echo "Pasajero eliminado con éxito.\n";
                        $pasajerosTotales--;
                    } else {
                        echo "Volviendo al menú. \n";
                        sleep(2);
                    }
                } else {
                    echo "ERROR. Ingrese un número válido.\n";
                    echo "Volviendo al Menú. \n";
                }
            }
            sleep(1);
            break;
        case 6:
            if ($pasajerosTotales==0){
                echo "No hay pasajeros para modificar.";
            } else {
                echo "Ingrese que pasajero desea modificar del 1 al ", contarPasajeros($p),": ";
                $aux = trim(fgets(STDIN));
                if ($aux>contarPasajeros($p)||$aux<1){
                    echo "ERROR. Pasajero no se encuentra.";
                } else {
                    $p->setNombrePasajero(leerNombre());
                    $p->setApellidoPasajero(leerApellido());
                    $p->setDniPasajero(leerDni());
                    $p->setPasajeros($aux-1);
                    echo "El pasajero se modificó con éxito.";
                }
            }
            sleep(2);
            break;
        
        case 7:
            echo $p->__toString();
            sleep(2);
            break;

        case 8:
            if ($pasajerosTotales<1){
                echo "No hay pasajeros para mostrar.\n";
                echo "Quedan ", $p->getCupo()-$pasajerosTotales, " espacios libres.";
                sleep(2);
            } else {
                for ($i=1; $i<=$pasajerosTotales;$i++){
                    print_r($p->getPasajeros()[$i-1]);
                }
                echo "Quedan ", $p->getCupo()-$pasajerosTotales, " espacios libres.";
                sleep(4);
            }
            break;
    }
} while ($opcion!=9);

?>