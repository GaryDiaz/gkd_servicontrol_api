<?php

namespace Config;

use App\Controllers\UsuarioController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
  require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Home::index');
$routes->post("/login", "UsuarioController::login");

/**
 * Rutas protegidas por el filtro AccesoFilter
 */
$routes->group("", ['filter' => 'accesoFilter'], static function ($routes) {
  $routes->post("/usuario", "UsuarioController::create");
  $routes->get("/usuarios", "UsuarioController::index");
  $routes->get("/usuario/(:segment)", "UsuarioController::show/$1");
  $routes->put("/usuario/(:segment)", "UsuarioController::update/$1");
  $routes->delete("/usuario/(:segment)", "UsuarioController::update/$1");
  $routes->post("/cambiarclave", "UsuarioController::cambiarClave");

  $routes->post("/empleado", "EmpleadoController::create");
  $routes->get("/empleados", "EmpleadoController::index");
  $routes->get("/empleado/(:segment)", "EmpleadoController::show/$1");
  $routes->put("/empleado/(:segment)", "EmpleadoController::update/$1");
  $routes->delete("/empleado/(:segment)", "EmpleadoController::delete/$1");

  $routes->post("/cliente", "ClienteController::create");
  $routes->get("/clientes", "ClienteController::index");
  $routes->get("/cliente/(:segment)", "ClienteController::show/$1");
  $routes->put("/cliente/(:segment)", "ClienteController::update/$1");
  $routes->delete("/cliente/(:segment)", "ClienteController::delete/$1");

  $routes->post("/servicio", "ServicioController::create");
  $routes->get("/servicios", "ServicioController::index");
  $routes->get("/servicio/(:segment)", "ServicioController::show/$1");
  $routes->put("/servicio/(:segment)", "ServicioController::update/$1");
  $routes->delete("/servicio/(:segment)", "ServicioController::delete/$1");

  $routes->post("/detalleservicio", "DetalleServicioController::create");
  $routes->get("/detalleservicios/(:segment)", "DetalleServicioController::list/$1");
  $routes->get("/detalleservicio/(:segment)", "DetalleServicioController::show/$1");
  $routes->put("/detalleservicio/(:segment)", "DetalleServicioController::update/$1");
  $routes->delete("/detalleservicio/(:segment)", "DetalleServicioController::delete/$1");
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
