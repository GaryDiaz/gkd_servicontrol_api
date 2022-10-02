<?php

namespace App\Controllers;

use App\Beans\EmpleadoBean;
use CodeIgniter\RESTful\ResourceController;

class EmpleadoController extends ResourceController {
  protected $modelName = "App\Models\EmpleadoModel";
  protected $format = "json";
  const COLUMNAS_BUSCAR = [
    "nombre" => true,
    "apellido" => true,
    "cargo" => true,
    "cedula" => true,
    "telefono" => true,
  ];

  public function index() {
    if ($empleados = $this->model->findAll()) {
      return $this->respond([
        "data" => EmpleadoBean::arrayEntitiesToBeans($empleados)
      ]);
    }
    return $this->failNotFound("No se encontraron empleados");
  }

  public function show($id = null) {
    if ($empleado = $this->model->find($id)) {
      return $this->respond([
        "data" => new EmpleadoBean($empleado)
      ]);
    }
    return $this->failNotFound("No se encontró ningún empleado con id $id");
  }

  public function findText($column = null, $valor = null) {
    if (!$column || !$valor) {
      return $this->failNotFound("Nada que buscar");
    }
    if (!key_exists($column, self::COLUMNAS_BUSCAR)) {
      return $this->failNotFound("No se encontro la columna $column");
    }

    if ($column === "cedula") {
      $empleados = $this->model->findNumber($valor);
    } else if ($column === "telefono") {
      $empleados = $this->model->findTelefono($valor);
    } else {
      $empleados = $this->model->findText($column, $valor);
    }

    if (!$empleados) {
      return $this->failNotFound("No se encontro ningún empleado con $column: $valor");
    }
    return $this->respond(["data" => EmpleadoBean::arrayEntitiesToBeans($empleados)]);
  }

  public function create() {
    $form = $this->request->getJSON(true);
    $eb = EmpleadoBean::getInstanceCreateForm($form);
    $empleado = $eb->getEmpleadoEntity();
    $empleado->idEmpleado = $this->model->nextId();

    if (!$id = $this->model->insert($empleado)) {
      return $this->failValidationErrors($this->model->errors());
    }

    $emp = $this->model->find($id);
    return $this->respond([
      "message" => "El empleado ha sido registrado satisfactoriamente",
      "data" => new EmpleadoBean($emp)
    ]);
  }

  public function update($id = null) {
    $form = $this->request->getJSON(true);
    if (empty($form)) {
      return $this->failValidationErrors("Nada que actualizar");
    }

    if (!$this->model->find($id)) {
      return $this->failNotFound("El empleado que intenta editar no existe");
    }

    $data = EmpleadoBean::extraerDatosActualizables($form);

    if (!$this->model->update($id, $data)) {
      return $this->failValidationErrors($this->model->errors());
    }

    return $this->respondUpdated([
      "message" => "Datos de empleado actualizados con éxito",
      "data" => new EmpleadoBean($this->model->find($id))
    ]);
  }

  public function delete($id = null) {
    if (!$this->model->find($id)) {
      return $this->failNotFound("El empleado que intenta eliminar no existe");
    }

    $this->model->delete($id);

    return $this->respondDeleted([
      "message" => "El empleado con id ($id) ha sido eliminado satisfactoriamente"
    ]);
  }
}
