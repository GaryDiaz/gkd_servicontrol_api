<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ClienteEntity extends Entity {
  protected $attributes = [
    "idCliente" => null,
    "rif" => null,
    "juridica" => null,
    "nombreCompania" => null,
    "nombreContacto" => null,
    "cargoContacto" => null,
    "direccion" => null,
    "direccionAnexo" => null,
    "puntoReferencia" => null,
    "telefono" => null,
    "otroTelefono" => null,
    "email" => null,
    "estatus" => null,
  ];
  protected $datamap = ["id" => "idCliente"];
}
