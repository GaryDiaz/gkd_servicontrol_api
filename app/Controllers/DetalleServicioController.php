<?php

namespace App\Controllers;

use App\Beans\DetalleServicioBean;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class DetalleServicioController extends ResourceController {
  protected $modelName = "App\Models\DetalleServicioModel";
  protected $format = "json";

  /**
   * Lista los detalles de servicio a partir del id de servicio
   * @param int $id id de servicio
   */
  public function list($id = null) {
    if ($detalles = $this->model->findByIdServicio($id)) {
      return $this->respond([
        "data" => DetalleServicioBean::arrayEntitiesToBeans($detalles)
      ]);
    }
    return $this->failNotFound("No se encontraron detalles de servicio para el id de servicio: $id");
  }

  /**
   * Muestra el detalle de servicio a específico a partir de la concatenación del
   * id de servicio y el item correpondiente al detalle, separadado por "-"
   * @param string $id idServicio-item ejemplo: 1-1
   */
  public function show($id = null) {
    $validacionPk = $this->validarClavePrimaria($id);
    if (!$validacionPk["ok"]) {
      return $this->fail($validacionPk["message"]);
    }
    $pk = $validacionPk["arrayPk"];
    if ($dse = $this->model->find($pk)) {
      return $this->respond([
        "data" => new DetalleServicioBean($dse)
      ]);
    }
    return $this->failNotFound("No se encontró el detalle de servicio con id $id");
  }

  /**
   * Para crear un detalle de servicio a un servicio, recibe la data en el request
   */
  public function create() {
    $form = $this->request->getJSON(true);
    $dsb = DetalleServicioBean::getInstanceCreateForm($form);
    $detalle = $dsb->getDetalleServicioEntity();
    $detalle->item = $this->model->nextItem($dsb->getIdServicio());

    if (!$id = $this->model->insert($detalle)) {
      return $this->failValidationErrors($this->model->errors());
    }

    $det = $this->model->find($id);
    return $this->respond([
      "message" => "El Detalle de Servicio ha sido registrado satisfactoriamente",
      "data" => new DetalleServicioBean($det)
    ]);
  }

  /**
   * Para actualizar los datos del detalle de servicio recibe el $id concatenado
   * idServicio-item, además de la data a actualizar en el request
   * @param string $id idServicio-item ejemplo: 1-1
   */
  public function update($id = null) {
    $validacionPk = $this->validarClavePrimaria($id);
    if (!$validacionPk["ok"]) {
      return $this->fail($validacionPk["message"]);
    }

    $form = $this->request->getJSON(true);
    if (empty($form)) {
      return $this->failValidationErrors("Nada que actualizar");
    }

    $pk = $validacionPk["arrayPk"];
    if (!$this->model->find($pk)) {
      return $this->failNotFound("El Detalle de Servicio que intenta editar no existe");
    }

    $data = DetalleServicioBean::extraerDatosActualizables($form);
    if (!$this->model->update($pk, $data)) {
      return $this->failValidationErrors($this->model->errors());
    }

    $detalle = $this->model->find($pk);
    return $this->respondUpdated([
      "message" => "Detalle de Servicio actualizados con exito",
      "data" => new DetalleServicioBean($detalle)
    ]);
  }

  /**
   * Para eliminar un detalle de servicio, recibe el $id concatenado idServicio-item
   * @param string $id idServicio-item ejemplo: 1-1
   */
  public function delete($id = null) {
    $validacionPk = $this->validarClavePrimaria($id);
    if (!$validacionPk["ok"]) {
      return $this->fail($validacionPk["message"]);
    }

    $pk = $validacionPk["arrayPk"];
    if (!$this->model->find($pk)) {
      return $this->failNotFound("El Detalle de Servicio que intenta eliminar no existe");
    }

    if (!$this->model->delete($pk)) {
      return $this->fail("No se pudo eliminar el Detalle de Servicio con $id");
    }

    return $this->respondDeleted([
      "message" => "El Detalle de Servicio con id $id has sido eliminado satisfactoriamente",
    ]);
  }

  /**
   * Válida que esté bien conformada la clave primaria compuesta y devuelve un array
   * con un valor boolean llamado ok, si "ok"=false, devuelve un "message" con la descripcion
   * del error, si "ok"=true, devuelve un "arrayPk" con los valores de la clave primaria
   * compuesta con sus respectivos campos
   * @param string $pk clave primaria concatenada
   * @return array con un valor boolean de nombre ok
   */
  private function validarClavePrimaria(string $primaryKey) {
    $arrayPk = explode("-", $primaryKey);
    if (count($arrayPk) !== 2) {
      return [
        "ok" => false,
        "message" => "El id de detalle de servicio debe estar combinado idServicio-item (separado por guión)"
      ];
    }
    if (!is_numeric($arrayPk[0]) || !is_numeric($arrayPk[1])) {
      return [
        "ok" => false,
        "message" => "El id de servicio y item son valores numericos separados por guión"
      ];
    }
    $idServicio = intval($arrayPk[0]);
    $item = intval($arrayPk[1]);

    return [
      "ok" => true,
      "arrayPk" => [
        "idServicio" => $idServicio,
        "item" => $item
      ]
    ];
  }
}
