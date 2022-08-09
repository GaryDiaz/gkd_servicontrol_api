<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class DetalleServicioEntity extends Entity {
  protected $attributes = [
    "idServicio" => null,
    "item" => null,
    "fecha" => null,
    "artefacto" => null,
    "cantidad" => null,
    "marca" => null,
    "descripcion" => null,
    "falla" => null,
    "diagnostico" => null,
    "observaciones" => null,
    "estatus" => null,
  ];
}
