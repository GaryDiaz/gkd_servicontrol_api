<?php

namespace App\Models;

use App\Entities\EmpleadoEntity;
use CodeIgniter\Model;

class EmpleadoModel extends Model {
  protected $DBGroup          = 'default';
  protected $table            = 'empleado';
  protected $primaryKey       = 'idEmpleado';
  protected $useAutoIncrement = false;
  protected $insertID         = 0;
  protected $returnType       = EmpleadoEntity::class;
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'idEmpleado',
    'cedula',
    'nombre',
    'apellido',
    'cargo',
    'telefonoPrincipal',
    'telefono2',
    'telefono3',
    'estatus'
  ];

  // Validation
  protected $validationRules      = [
    'idEmpleado' => 'required|is_natural|is_unique[empleado.idEmpleado]',
    'cedula' => 'required|is_natural|es_clave_unica[empleado.cedula,idEmpleado,{idEmpleado}]',
    'nombre' => 'required|max_length[20]',
    'apellido' => 'required|max_length[20]',
    'cargo' => 'required|max_length[20]',
    'telefonoPrincipal' => 'required|max_length[15]',
    'telefono2' => 'max_length[15]',
    'telefono3' => 'max_length[15]',
    'estatus' => 'required|is_natural',
  ];
  protected $validationMessages   = [
    'idEmpleado' => [
      'required' => 'El id de empleado es obligatorio',
      'is_natural' => 'El id de empleado debe ser un número',
      'is_unique' => 'El id de empleado ya existe',
    ],
    'cedula' => [
      'required' => 'La cédula del empleado es obligatoria',
      'is_natural' => 'La cédula del empleado debe ser un número',
      'es_clave_unica' => 'La cédula ya existe',
    ],
    'nombre' => [
      'required' => 'El nombre es obligatorio',
      'max_length' => 'El máximo de caracteres es 20',
    ],
    'apellido' => [
      'required' => 'El apellido es obligatorio',
      'max_length' => 'El máximo de caracteres es 20',
    ],
    'cargo' => [
      'required' => 'El cargo es obligatorio',
      'max_length' => 'El máximo de caracteres es 20',
    ],
    'telefonoPrincipal' => [
      'required' => 'El teléfono es obligatorio',
      'max_length' => 'El máximo de caracteres es 15',
    ],
    'telefono2' => [
      'max_length' => 'El máximo de caracteres es 15',
    ],
    'telefono3' => [
      'max_length' => 'El máximo de caracteres es 15',
    ],
    'estatus' => [
      'required' => 'El estatus es obligatorio',
      'is_natural' => 'El estatus debe ser un número'
    ],
  ];
  protected $skipValidation       = false;

  public function nextId(): int {
    $builder = $this->db->table($this->table);
    $row = $builder->select("idEmpleado")->orderBy("idEmpleado", "DESC")
      ->limit(1)->get()->getRowArray();
    return $row ? $row["idEmpleado"] + 1 : 1;
  }

  public function findText($column, $value) {
    $builder = $this->db->table($this->table);
    return $builder->select()->like($column, $value)->get()->getResult($this->tempReturnType);
  }

  public function findNumber($value) {
    $builder = $this->db->table($this->table);
    return $builder->select()->where("cedula", $value)->get()->getResult($this->tempReturnType);
  }

  public function findTelefono($value) {
    $builder = $this->db->table($this->table);
    $builder->select()->like("telefonoPrincipal", $value);
    $builder->orLike("telefono2", $value);
    return $builder->orLike("telefono3", $value)->get()->getResult($this->tempReturnType);
  }
}
