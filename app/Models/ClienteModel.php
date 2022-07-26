<?php

namespace App\Models;

use App\Entities\ClienteEntity;
use CodeIgniter\Model;

class ClienteModel extends Model {
  protected $DBGroup          = 'default';
  protected $table            = 'cliente';
  protected $primaryKey       = 'idCliente';
  protected $useAutoIncrement = false;
  protected $insertID         = 0;
  protected $returnType       = ClienteEntity::class;
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    "idCliente",
    "rif",
    "juridica",
    "razonSocial",
    "nombreContacto",
    "cargoContacto",
    "direccion",
    "direccionAnexo",
    "puntoReferencia",
    "telefono",
    "otroTelefono",
    "email",
    "estatus",
  ];

  // Validation
  protected $validationRules      = [
    "idCliente" => "required|is_natural|is_unique[cliente.idCliente]",
    "rif" => "max_length[10]",
    "juridica" => "required|is_natural",
    "razonSocial" => "required|max_length[45]",
    "nombreContacto" => "max_length[45]",
    "cargoContacto" => "max_length[20]",
    "direccion" => "required|max_length[255]",
    "direccionAnexo" => "max_length[255]",
    "puntoReferencia" => "max_length[255]",
    "telefono" => "required|max_length[15]",
    "otroTelefono" => "max_length[15]",
    "email" => "max_length[80]",
    "estatus" => "required|is_natural",
  ];
  protected $validationMessages   = [
    "idCliente" => [
      "required" => "El id es obligatorio",
      "is_natural" => "El id debe ser un número natural",
      "is_unique" => "El id ya existe",
    ],
    "rif" => [
      "max_length" => "El RIF no puede tener mas de 10 caracteres",
    ],
    "juridica" => [
      "required" => "Debe contener un valo válido",
      "is_natural" => "Debe ser un número natural",
    ],
    "razonSocial" => [
      "required" => "El nombre o Razón Social es un campo obligatorio",
      "max_length" => "El nombre o Razón Social no puede tener más de 45 caracteres",
    ],
    "nombreContacto" => [
      "max_length" => "El nombre de contacto no puede tener más de 45 caracteres",
    ],
    "cargoContacto" => [
      "max_length" => "El cargo no puede tener más de 20 caracteres",
    ],
    "direccion" => [
      "required" => "Debe escribir una dirección",
      "max_length" => "Ha pasado el límite de caracteres (255), continúe en el siguiente campo",
    ],
    "direccionAnexo" => [
      "max_length" => "Ha superado el límite de caracteres de anexo (255)",
    ],
    "puntoReferencia" => [
      "max_length" => "El punto de referencia no puede tener más de 255 caracteres",
    ],
    "telefono" => [
      "required" => "El teléfono es obligatorio",
      "max_length" => "Máximo de caracteres (255)",
    ],
    "otroTelefono" => [
      "max_length" => "Máximo de caracteres (255)",
    ],
    "email" => [
      "max_length" => "Máximo de caracteres (80)",
    ],
    "estatus" => [
      "required" => "El estatus es obligatorio",
      "is_natural" => "El estatus debe ser un número",
    ],
  ];
  protected $skipValidation       = false;

  public function nextId(): int {
    $builder = $this->db->table($this->table);
    $row = $builder->select("idCliente")->orderBy("idCliente", "DESC")
      ->limit(1)->get()->getRowArray();
    return $row ? $row["idCliente"] + 1 : 1;
  }
}
