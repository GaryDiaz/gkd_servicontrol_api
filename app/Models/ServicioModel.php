<?php

namespace App\Models;

use App\Entities\ServicioEntity;
use CodeIgniter\Model;

class ServicioModel extends Model {
  protected $DBGroup          = 'default';
  protected $table            = 'servicio';
  protected $primaryKey       = 'idServicio';
  protected $useAutoIncrement = false;
  protected $insertID         = 0;
  protected $returnType       = ServicioEntity::class;
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    "idServicio",
    "fechaServicio",
    "fechaVisita",
    "fechaFinServicio",
    "fechaProximaVisita",
    "observaciones",
    "estatus",
    "idUsuario",
    "idEmpleado",
    "idCliente",
  ];

  // Validation
  protected $validationRules      = [
    "idServicio" => "required|is_natural|is_unique[servicio.idServicio]",
    "fechaServicio" => "required|valid_date",
    "fechaVisita" => "required|valid_date",
    "observaciones" => "max_length[255]",
    "estatus" => "required|is_natural",
    "idUsuario" => "required|is_natural|is_not_unique[usuario.idUsuario]",
    "idEmpleado" => "required|is_natural|is_not_unique[empleado.idEmpleado]",
    "idCliente" => "required|is_natural|is_not_unique[cliente.idCliente]",
  ];
  protected $validationMessages   = [
    "idServicio" => [
      "required" => "El campo id es obligatoria",
      "is_natural" => "El id debe ser un numero entero",
      "is_unique" => "El id suministrado ya existe",
    ],
    "fechaServicio" => [
      "required" => "La fecha de servicio es obligatoria",
      "valid_date" => "La fecha de servicio no tiene un formato valido",
    ],
    "fechaVisita" => [
      "required" => "La fecha de visita es obligatoria",
      "valid_date" => "La fecha de visita no tiene un formato valido",
    ],
    "observaciones" => [
      "max_length[255]" => "No puede exceder 255 caracteres"
    ],
    "estatus" => [
      "required" => "El campo estatus es obligatoria",
      "is_natural" => "El estatus debe ser un numero entero",
    ],
    "idUsuario" => [
      "required" => "El id de usuario es obligatorio",
      "is_natural" => "El id debe ser un numero entero",
      "is_not_unique" => "No se encuenta un usuario con el id suministrado",
    ],
    "idEmpleado" => [
      "required" => "El id de empleado es obligatorio",
      "is_natural" => "El id debe ser un numero entero",
      "is_not_unique" => "No se encuenta un empleado con el id suministrado",
    ],
    "idCliente" => [
      "required" => "El id de usuario es obligatorio",
      "is_natural" => "El id debe ser un numero entero",
      "is_not_unique" => "No se encuenta un cliente con el id suministrado",
    ],
  ];
  protected $skipValidation       = false;

  public function nextId(): int {
    $builder = $this->db->table($this->table);
    $row = $builder->select("idServicio")->orderBy("idServicio", "DESC")
      ->limit(1)->get()->getRowArray();
    return $row ? $row["idServicio"] + 1 : 1;
  }

  public function findAllView() {
    $builder = $this->db->table("servicio_view");
    return $builder->select()->get()->getResultObject();
  }

  public function findView(int $id) {
    $builder = $this->db->table("servicio_view");
    return $builder->select()->where("idServicio", $id)->get()->getRowObject();
  }
}
