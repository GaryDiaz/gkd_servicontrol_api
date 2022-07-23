<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EmpleadoEntity extends Entity {
  protected $attributes = [
    "idEmpleado" => null,
    "cedula" => null,
    "nombre" => null,
    "apellido" => null,
    "cargo" => null,
    "telefonoPrincipal" => null,
    "telefono2" => null,
    "telefono3" => null,
    "estatus" => null,
  ];
  protected $datamap = ["id" => "idEmpleado"];
}
