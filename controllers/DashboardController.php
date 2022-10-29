<?php

namespace Controllers;

use MVC\Router;
use Model\Evento;
use Model\Usuario;
use Model\Registro;

class DashboardController {

    public static function index(Router $router) {

        // Obtener últimos registros
        $registros = Registro::get(5);
        
        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        // Calcular los ingresos
        $virtuales = Registro::total('paquete_id', 2);
        $presenciales = Registro::total('paquete_id', 1);

        // 46,41€ -> Cantidad que se ingresa en la cuenta descontadas las comisiones de Paypal del pase Virtual
        // 189,54€ -> Cantidad que se ingresa en la cuenta descontadas las comisiones de Paypal del pase Presencial
        // 0€ -> Cantidad que se ingresa en la cuenta del pase Gratis
        $ingresos = ($virtuales * 46.41) + ($presenciales * 189.54);

        // Obtener eventos con más y menos plazas disponibles
        $menos_disponibles = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $mas_disponibles = Evento::ordenarLimite('disponibles', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_disponibles' => $menos_disponibles,
            'mas_disponibles' => $mas_disponibles
        ]);
    }
}