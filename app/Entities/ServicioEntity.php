<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ServicioEntity extends Entity {
  protected $attributes = [
    "idServicio" => null,
    "fechaServicio" => null,
    "fechaVisita" => null,
    "fechaFinServicio" => null,
    "fechaProximaVisita" => null,
    "observaciones" => null,
    "estatus" => null,
    "idUsuario" => null,
    "idEmpleado" => null,
    "idCliente" => null,
  ];
  protected $datamap = ["id" => "idServicio"];
}
