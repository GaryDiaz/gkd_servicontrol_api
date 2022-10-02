<?php

namespace App\Controllers;

use App\Beans\ClienteBean;
use App\Beans\EmpleadoBean;
use App\Beans\ServicioBean;
use App\Beans\UsuarioBean;
use App\Models\ClienteModel;
use App\Models\EmpleadoModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class ServicioController extends ResourceController {
  protected $modelName = "App\Models\ServicioModel";
  protected $format = "json";

  public function index() {
    if ($servicios = $this->model->findAllView()) {
      return $this->respond([
        "data" => ServicioBean::arrayViewToBeans($servicios)
      ]);
    }
    return $this->failNotFound("No se encontraron servicios");
  }

  public function show($id = null) {
    if ($servicio = $this->model->findView($id)) {
      return $this->respond([
        "data" => [
          "servicio" => ServicioBean::getInstanceFromView($servicio),
        ],
      ]);
    }
    return $this->failNotFound("No se encontró ningún servicio con id $id");
  }

  /**public function find($column=null, $valor=null) {
    if ($servicio = $this->model->findView($id)) {
      return $this->respond([
        "data" => [
          "servicio" => ServicioBean::getInstanceFromView($servicio),
        ],
      ]);
    }
    return $this->failNotFound("No se encontró ningún servicio con id $id");
  }*/



  public function create() {
    $form = $this->request->getJSON(true);
    $sb = ServicioBean::getInstanceCreateForm($form);
    $servicio = $sb->getServicioEntity();
    $servicio->idServicio = $this->model->nextId();

    if (!$id = $this->model->insert($servicio)) {
      return $this->failValidationErrors($this->model->errors());
    }

    $srv = $this->model->find($id);
    $usrModel = new UsuarioModel();
    $ub = new UsuarioBean($usrModel->find($srv->idUsuario));
    $empModel = new EmpleadoModel();
    $eb = new EmpleadoBean($empModel->find($srv->idEmpleado));
    $cliModel = new ClienteModel();
    $cb = new ClienteBean($cliModel->find($srv->idCliente));
    return $this->respond([
      "message" => "El servicio ha sido registrado satisfactoriamente",
      "data" => [
        "servicio" => new ServicioBean($srv),
        "usuario" => $ub,
        "empleado" => $eb,
        "cliente" => $cb,
      ]
    ]);
  }

  public function update($id = null) {
    $form = $this->request->getJSON(true);
    if (empty($form)) {
      return $this->failValidationErrors("Nada que actualizar");
    }

    if (!$this->model->find($id)) {
      return $this->failNotFound("El servicio que intenta editar no existe");
    }

    $data = ServicioBean::extraerDatosActualizables($form);
    if (!$this->model->update($id, $data)) {
      return $this->failValidationErrors($this->model->errors());
    }

    $srv = $this->model->find($id);
    $usrModel = new UsuarioModel();
    $ub = new UsuarioBean($usrModel->find($srv->idUsuario));
    $empModel = new EmpleadoModel();
    $eb = new EmpleadoBean($empModel->find($srv->idEmpleado));
    $cliModel = new ClienteModel();
    $cb = new ClienteBean($cliModel->find($srv->idCliente));

    return $this->respondUpdated([
      "message" => "Datos de servicio actualizados con éxito",
      "data" => [
        "servicio" => new ServicioBean($srv),
        "usuario" => $ub,
        "empleado" => $eb,
        "cliente" => $cb,
      ]
    ]);
  }

  public function delete($id = null) {
    if (!$this->model->find($id)) {
      return $this->failNotFound("El servicio que intenta eliminar no existe");
    }

    $this->model->delete($id);

    return $this->respondDeleted([
      "message" => "El servicio con id $id ha sido eliminado satisfactoriamente"
    ]);
  }
}
