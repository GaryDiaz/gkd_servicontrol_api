<?php

namespace App\Controllers;

use App\Beans\ClienteBean;
use CodeIgniter\RESTful\ResourceController;

class ClienteController extends ResourceController {
  protected $modelName = "App\Models\ClienteModel";
  protected $format = "json";

  public function index() {
    if ($clientes = $this->model->findAll()) {
      return $this->respond([
        "data" => ClienteBean::arrayEntitiesToBeans($clientes)
      ]);
    }
    return $this->failNotFound("No se encontraron clientes");
  }

  public function show($id = null) {
    if ($cliente = $this->model->find($id)) {
      return $this->respond([
        "data" => new ClienteBean($cliente)
      ]);
    }
    return $this->failNotFound("No se encontraró al cliente con id $id");
  }

  public function create() {
    $form = $this->request->getJSON(true);
    $cb = ClienteBean::getInstanceCreateForm($form);
    $cliente = $cb->getClienteEntity();
    $cliente->idCliente = $this->model->nextId();

    if (!$id = $this->model->insert($cliente)) {
      return $this->failValidationErrors($this->model->errors());
    }

    $cli = $this->model->find($id);
    return $this->respond([
      "message" => "El cliente ha sido registrado satisfactoriamente",
      "data" => new ClienteBean($cli),
    ]);
  }

  public function update($id = null) {
    $form = $this->request->getJSON(true);
    if (empty($form)) {
      return $this->failValidationErrors("Nada que actualizar");
    }

    if (!$this->model->find($id)) {
      return $this->failNotFound("El cliente que intenta editar no existe");
    }

    $data = ClienteBean::extraerDatosActualizables($form);
    if (!$this->model->update($id, $data)) {
      return $this->failValidationErrors($this->model->errors());
    }

    return $this->respondUpdated([
      "message" => "Datos de cliente actualizados con éxito",
      "data" => new ClienteBean($this->model->find($id)),
    ]);
  }

  public function delete($id = null) {
    if (!$this->model->find($id)) {
      return $this->failNotFound("El cliente que intenta eliminar no existe");
    }

    $this->model->delete($id);

    return $this->respondDeleted([
      "message" => "El cliente cod id $id ha sido eliminado satisfactoriamente"
    ]);
  }
}
