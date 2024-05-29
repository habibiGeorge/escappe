<?php

function dimeDia($e)
{
    switch ($e) {
        case "Sunday":
            return "domingo";
        case "Monday":
            return "lunes";
        case "Tuesday":
            return "martes";
        case "Wednesday":
            return "miércoles";
        case "Thursday":
            return "jueves";
        case "Friday":
            return "viernes";
        case "Saturday":
            return "sábado";
    }
}

function dimeMes($e)
{
    switch ($e) {
        case "1":
            return "enero";
        case "2":
            return "febrero";
        case "3":
            return "marzo";
        case "4":
            return "abril";
        case "5":
            return "mayo";
        case "6":
            return "junio";
        case "7":
            return "julio";
        case "8":
            return "agosto";
        case "9":
            return "septiembre";
        case "10":
            return "octubre";
        case "11":
            return "noviembre";
        case "12":
            return "deciembre";
    }
}

function dameFechaEsp($date)
{

    $fecha = dimeDia(date('l', strtotime($date))) . ", ";
    $fecha .= date('d', strtotime($date)) . " de ";
    $fecha .= dimeMes(date('m', strtotime($date))) . " de ";
    $fecha .= date('Y', strtotime($date));
    return $fecha;
}



// PROBAR Cerrar la sesión después de un tiempo
// session_name("loginUsuario");
// session_start(); // comprobar que el usuario está logueado

// if (!$_SESSION["autentificado"]) {
//     // si no lo está, se devuelve al index.php
//     header("Location: index.php");
// } else {
//     // si lo está, calculamos el tiempo transcurrido
//     $fechaGuardada = $_SESSION["ultimoAcceso"];
//     $ahora = time();
//     $tiempo_transcurrido = $ahora - $fechaGuardada;

//     // comparamos el tiempo transcurrido
//     if ($tiempo_transcurrido >= 600) {
//         // si pasaron 10 minutos (600 segundos) o más
//         session_destroy(); // destruimos la sesión
//         header("Location: index.php");        
//     } else {
//         // sino, actualizamos la fecha de la sesión
//         $_SESSION["ultimoAcceso"] = $ahora;
//     }
// }