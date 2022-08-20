<?php

namespace App\Models;

use App\Entities\DetalleServicioEntity;
use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Model;
use ReflectionClass;
use ReflectionProperty;

class DetalleServicioModel extends Model {
  protected $DBGroup          = 'default';
  protected $table            = 'detalle_servicio';
  protected $primaryKey       = ["idServicio", "item"];
  protected $useAutoIncrement = false;
  protected $insertID         = 0;
  protected $returnType       = DetalleServicioEntity::class;
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    "idServicio",
    "item",
    "fecha",
    "artefacto",
    "cantidad",
    "marca",
    "descripcion",
    "falla",
    "diagnostico",
    "observaciones",
    "estatus",
  ];

  // Validation
  protected $validationRules      = [
    "idServicio" => "required|is_natural",
    "item" => "required|is_natural",
    "fecha" => "required|valid_date",
    "artefacto" => "required|max_length[100]",
    "cantidad" => "required|is_natural",
    "marca" => "max_length[30]",
    "descripcion" => "max_length[150]",
    "falla" => "max_length[70]",
    "diagnostico" => "max_length[100]",
    "observaciones" => "max_length[100]",
    "estatus" => "required|is_natural",
  ];
  protected $validationMessages   = [
    "idServicio" => [
      "required" => "El Id de Servicio es obligatorio",
      "is_natural" => "El Id de Servicio debe ser un número natural"
    ],
    "item" => [
      "required" => "El Id de Item es obligatorio",
      "is_natural" => "El Id de Item debe ser un número natural"
    ],
    "fecha" => [
      "required" => "La fecha es obligatoria",
      "valid_date" => "Debe introducir una fecha válida"
    ],
    "artefacto" => [
      "required" => "El nombre del artefactoes obligatorio",
      "max_length" => "La longitud máxima es de 100 caracteres"
    ],
    "cantidad" => [
      "required" => "La cantidad es obligatoria",
      "is_natural" => "La cantidad debe ser un número natural"
    ],
    "marca" => [
      "max_length" => "La longitud máxima es de 30 caracteres"
    ],
    "descripcion" => [
      "max_length" => "La longitud máxima es de 150 caracteres"
    ],
    "falla" => [
      "max_length" => "La longitud máxima es de 70 caracteres"
    ],
    "diagnostico" => [
      "max_length" => "La longitud máxima es de 100 caracteres"
    ],
    "observaciones" => [
      "max_length" => "La longitud máxima es de 100 caracteres"
    ],
    "estatus" => [
      "required" => "El estatus es obligatorio",
      "is_natural" => "El estatus debe ser un número natural"
    ],
  ];
  protected $skipValidation       = false;

  public function nextItem($idServicio): int {
    $builder = $this->db->table($this->table);
    $row = $builder->select("item")
      ->where("idServicio", $idServicio)->orderBy("item", "DESC")
      ->limit(1)->get()->getRowArray();
    return $row ? $row["item"] + 1 : 1;
  }

  protected function objectToRawArray($data, bool $onlyChanged = true, bool $recursive = false): ?array {
    if (method_exists($data, 'toRawArray')) {
      $properties = $data->toRawArray($onlyChanged, $recursive);
    } else {
      $mirror = new ReflectionClass($data);
      $props  = $mirror->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

      $properties = [];

      // Loop over each property,
      // saving the name/value in a new array we can return.
      foreach ($props as $prop) {
        // Must make protected values accessible.
        $prop->setAccessible(true);
        $properties[$prop->getName()] = $prop->getValue($data);
      }
    }

    return $properties;
  }

  /**
   * Método sobrescrito para solventar la clave primaria compuesta
   *
   * @param array $data Data
   * @return bool|Query
   */
  protected function doInsert(array $data) {
    $escape       = $this->escape;
    $this->escape = [];

    if (empty($data[$this->primaryKey[0]]) || empty($data[$this->primaryKey[1]])) {
      throw DataException::forEmptyPrimaryKey('insert');
    }

    $builder = $this->builder();

    // Must use the set() method to ensure to set the correct escape flag
    foreach ($data as $key => $val) {
      $builder->set($key, $val, $escape[$key] ?? null);
    }

    $result = $builder->insert();

    // If insertion succeeded then save the insert ID
    if ($result) {
      $this->insertID = $data[$this->primaryKey[0]] . "-" . $data[$this->primaryKey[1]];
    }
    return $result;
  }

  /**
   * Updates a single record in $this->table.
   * Método sobrescrito para solventar la clave primaria compuesta
   *
   * @param array|int|string|null $primaryKey
   * @param array|null            $data
   */
  protected function doUpdate($primaryKey = null, $data = null): bool {
    $escape       = $this->escape;
    $this->escape = [];

    $idServicio = null;
    $item = null;
    if (is_array($primaryKey)) {
      if (key_exists('idServicio', $primaryKey) && key_exists('item', $primaryKey)) {
        $idServicio = intval($primaryKey['idServicio']);
        $item = intval($primaryKey['item']);
      }
    }

    if (is_string($primaryKey)) {
      $arrayPk = explode("-", $primaryKey);
      $idServicio = intval($arrayPk[0]);
      $item = intval($arrayPk[1]);
    }

    if ($idServicio && $item) {
      $builder = $this->builder();
      $builder = $builder->where($this->table . '.idServicio', $idServicio)
        ->where($this->table . '.item', $item);

      // Must use the set() method to ensure to set the correct escape flag
      foreach ($data as $key => $val) {
        $builder->set($key, $val, $escape[$key] ?? null);
      }
      return $builder->update();
    }

    return null;
  }

  protected function doDelete($primaryKey = null, bool $purge = false) {
    $builder = $this->builder();

    if (empty($primaryKey)) {
      return false;
    }

    $result = $builder->where("idServicio", $primaryKey["idServicio"])
      ->where("item", $primaryKey["item"])->delete();

    return $result;
  }

  public function delete($primaryKey = null, bool $purge = false) {
    if (is_array($primaryKey)) {
      if (!array_key_exists("idServicio", $primaryKey) || !array_key_exists("item", $primaryKey)) {
        return false;
      }
    }

    $idServicio = null;
    $item = null;
    if (is_string($primaryKey)) {
      $arrayPk = explode("-", $primaryKey);
      $idServicio = intval($arrayPk[0]);
      $item = intval($arrayPk[1]);
      $primaryKey = ["idServicio" => $idServicio, "item" => $item];
    }

    return $this->doDelete($primaryKey, $purge);
  }

  /**
   * Sobrescribiendo el método find debido a que la clave primaria no es simple sino
   * compuesta
   *
   * @param array|string|null $primaryKey     La clave primaria en array ['idServicio','item'] o Concatenado en string separado por - guión
   * @return DetalleServicioEntity|null       Devuelve un objeto de detalle servicio o null
   */
  public function find($primaryKey = null) {
    $idServicio = null;
    $item = null;
    if (is_array($primaryKey)) {
      if (key_exists('idServicio', $primaryKey) && key_exists('item', $primaryKey)) {
        $idServicio = intval($primaryKey['idServicio']);
        $item = intval($primaryKey['item']);
      }
    }

    if (is_string($primaryKey)) {
      $arrayPk = explode("-", $primaryKey);
      $idServicio = intval($arrayPk[0]);
      $item = intval($arrayPk[1]);
    }

    if ($idServicio && $item) {
      $builder = $this->builder();

      $result = $builder->where($this->table . ".idServicio", $idServicio)
        ->where($this->table . ".item", $item)->get()
        ->getFirstRow($this->tempReturnType);
      return $result;
    }
    return null;
  }

  /**
   * Metodo anulado, se recomienda usar findByIdServicio($idServicio) para recibir una
   * lista de detalle de servicio relacionado con un mismo servicio
   * @ignore
   */
  public function findAll(int $limit = 0, int $offset = 0) {
    return [];
  }

  /**
   * Buscar detalles de servicios mediante el id de Servicios
   * @param int $idServicio
   * @return array|null
   */
  public function findByIdServicio(int $idServicio) {
    $builder = $this->db->table($this->table);
    $result = $builder->where("idServicio", $idServicio)
      ->get()->getResult($this->tempReturnType);
    return $result;
  }
}
