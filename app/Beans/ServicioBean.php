<?php

namespace App\Beans;

use App\Entities\ServicioEntity;
use App\Traits\ArrayTrait;
use App\Beans\ClienteBean;
use App\Beans\EmpleadoBean;
use App\Beans\UsuarioBean;

class ServicioBean {
  const ESTATUS = [
    "Nuevo",
    "Atendiendo",
    "Mantenimiento",
    "Reclamo",
    "Realizado",
    "Cancelado"
  ];

  /**
   * @var int
   */
  public $id;
  /**
   * @var string
   */
  public $fechaServicio;
  /**
   * @var string
   */
  public $fechaVisita;
  /**
   * @var string
   */
  public $fechaFinServicio;
  /**
   * @var string
   */
  public $fechaProximaVisita;
  /**
   * @var string
   */
  public $observaciones;
  /**
   * @var string
   */
  public $estatus;
  /**
   * @var int
   */
  public $idUsuario;
  /**
   * @var int
   */
  public $idEmpleado;
  /**
   * @var int
   */
  public $idCliente;
  /**
   * @var UsuarioBean | null
   */
  public $usuario;
  /**
   * @var ClienteBean | null
   */
  public $cliente;
  /**
   * @var EmpleadoBean | null
   */
  public $empleado;

  /**
   * Get the value of id
   * @return int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set the value of id
   * @param int $id
   * @return self
   */
  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Get the value of fechaServicio
   * @return string
   */
  public function getFechaServicio() {
    return $this->fechaServicio;
  }

  /**
   * Set the value of fechaServicio
   * @param string $fechaServicio
   * @return self
   */
  public function setFechaServicio(string $fechaServicio) {
    $this->fechaServicio = $fechaServicio;
    return $this;
  }

  /**
   * Get the value of fechaVisita
   * @return string
   */
  public function getFechaVisita() {
    return $this->fechaVisita;
  }

  /**
   * Set the value of fechaVisita
   * @param string $fechaVisita
   * @return self
   */
  public function setFechaVisita(string $fechaVisita) {
    $this->fechaVisita = $fechaVisita;
    return $this;
  }

  /**
   * Get the value of fechaFinServicio
   * @return string
   */
  public function getFechaFinServicio() {
    return $this->fechaFinServicio;
  }

  /**
   * Set the value of fechaFinServicio
   * @param string $fechaFinServicio
   * @return self
   */
  public function setFechaFinServicio(string $fechaFinServicio) {
    $this->fechaFinServicio = $fechaFinServicio;
    return $this;
  }

  /**
   * Get the value of fechaProximaVisita
   * @return string
   */
  public function getFechaProximaVisita() {
    return $this->fechaProximaVisita;
  }

  /**
   * Set the value of fechaProximaVisita
   * @param string $fechaProximaVisita
   * @return self
   */
  public function setFechaProximaVisita(string $fechaProximaVisita) {
    $this->fechaProximaVisita = $fechaProximaVisita;
    return $this;
  }

  /**
   * Get the value of observaciones
   * @return string
   */
  public function getObservaciones() {
    return $this->observaciones;
  }

  /**
   * Set the value of observaciones
   * @param string $observaciones
   * @return self
   */
  public function setObservaciones(string $observaciones) {
    $this->observaciones = $observaciones;
    return $this;
  }

  /**
   * Get the value of estatus
   * @return string
   */
  public function getEstatus() {
    return $this->estatus;
  }

  /**
   * Set the value of estatus
   * @param string $estatus
   * @return self
   */
  public function setEstatus(string $estatus) {
    $this->estatus = $estatus;
    return $this;
  }

  public function getEstatusInt(): int {
    for ($i = 0; $i < count(self::ESTATUS); $i++) {
      if ($this->estatus === self::ESTATUS[$i]) {
        return $i;
      }
    }
    return 0;
  }

  public function setEstatusInt(int $estatus) {
    if ($estatus >= 0 && $estatus < count(self::ESTATUS)) {
      $this->estatus = self::ESTATUS[$estatus];
    } else {
      $this->estatus = self::ESTATUS[0];
    }
  }

  /**
   * Get the value of idUsuario
   * @return int
   */
  public function getIdUsuario() {
    return $this->idUsuario;
  }

  /**
   * Set the value of idUsuario
   * @param int $idUsuario
   * @return self
   */
  public function setIdUsuario(int $idUsuario) {
    $this->idUsuario = $idUsuario;
    return $this;
  }

  /**
   * Get the value of idEmpleado
   * @return int
   */
  public function getIdEmpleado() {
    return $this->idEmpleado;
  }

  /**
   * Set the value of idEmpleado
   * @param int $idEmpleado
   * @return self
   */
  public function setIdEmpleado(int $idEmpleado) {
    $this->idEmpleado = $idEmpleado;
    return $this;
  }

  /**
   * Get the value of idCliente
   * @return int
   */
  public function getIdCliente() {
    return $this->idCliente;
  }

  /**
   * Set the value of idCliente
   * @param int $idCliente
   * @return self
   */
  public function setIdCliente(int $idCliente) {
    $this->idCliente = $idCliente;
    return $this;
  }

  public function __construct(ServicioEntity $servicio = null) {
    if ($servicio !== null) {
      $this->setServicioEntity($servicio);
    }
  }

  public function getServicioEntity(): ServicioEntity {
    $fechaFinServicio = $this->getFechaFinServicio() !== "" ? $this->getFechaFinServicio() : null;
    $fechaProximaVisita = $this->getFechaProximaVisita() !== "" ? $this->getFechaProximaVisita() : null;
    $se = new ServicioEntity(array(
      "idServicio" => $this->getId(),
      "fechaServicio" => $this->getFechaServicio(),
      "fechaVisita" => $this->getFechaVisita(),
      "fechaFinServicio" => $fechaFinServicio,
      "fechaProximaVisita" => $fechaProximaVisita,
      "observaciones" => $this->getObservaciones(),
      "estatus" => $this->getEstatusInt(),
      "idUsuario" => $this->getIdUsuario(),
      "idEmpleado" => $this->getIdEmpleado(),
      "idCliente" => $this->getIdCliente(),
    ));
    return $se;
  }

  public function setServicioEntity(ServicioEntity $servicio) {
    $this->setId($servicio->id);
    $this->setFechaServicio($servicio->fechaServicio);
    $this->setFechaVisita($servicio->fechaVisita);
    $fechaFinServicio = $servicio->fechaFinServicio !== null ? $servicio->fechaFinServicio : "";
    $this->setFechaFinServicio($fechaFinServicio);
    $fechaProximaVisita = $servicio->fechaProximaVisita !== null ? $servicio->fechaProximaVisita : "";
    $this->setFechaProximaVisita($fechaProximaVisita);
    $this->setObservaciones($servicio->observaciones);
    $this->setEstatusInt($servicio->estatus);
    $this->setIdUsuario($servicio->idUsuario);
    $this->setIdEmpleado($servicio->idEmpleado);
    $this->setIdCliente($servicio->idCliente);
  }

  public static function arrayEntitiesToBeans(array $servicios): array {
    $beans = [];
    for ($i = 0; $i < count($servicios); $i++) {
      $se = $servicios[$i];
      $sb = new ServicioBean($se);
      $beans[$i] = $sb;
    }
    return $beans;
  }

  public static function arrayViewToBeans($servicios): array {
    $beans = [];
    for ($i = 0; $i < count($servicios); $i++) {
      $se = $servicios[$i];
      $sb = self::getInstanceFromView($se);
      $beans[$i] = $sb;
    }
    return $beans;
  }

  public static function extraerDatosActualizables(array $form): array {
    $keys = ["fechaServicio", "fechaVisita", "fechaFinServicio", "fechaProximaVisita", "observaciones", "estatus", "idUsuartio", "idEmpleado", "idCliente"];
    return ArrayTrait::filtrarCampos($keys, $form);
  }

  public static function getInstanceCreateForm(array $form): ServicioBean {
    $sb = new ServicioBean();
    $sb->setId(0);
    $sb->setFechaServicio($form["fechaServicio"]);
    $sb->setFechaVisita($form["fechaVisita"]);
    $fechaFinServicio = $form["fechaFinServicio"];
    $sb->setFechaFinServicio($fechaFinServicio);
    $fechaProximaVisita = $form["fechaProximaVisita"];
    $sb->setFechaProximaVisita($fechaProximaVisita);
    $sb->setObservaciones($form["observaciones"]);
    $sb->setEstatusInt(0);
    $sb->setIdUsuario($form["idUsuario"]);
    $sb->setIdEmpleado($form["idEmpleado"]);
    $sb->setIdCliente($form["idCliente"]);
    return $sb;
  }

  public static function getInstanceFromView($servicio): ServicioBean {
    $sb = new ServicioBean();
    $sb->setId($servicio->idServicio);
    $sb->setFechaServicio($servicio->fechaServicio);
    $sb->setFechaVisita($servicio->fechaVisita);
    $sb->setFechaFinServicio($servicio->fechaFinServicio !== null ? $servicio->fechaFinServicio : "");
    $sb->setFechaProximaVisita($servicio->fechaProximaVisita !== null ? $servicio->fechaProximaVisita : "");
    $sb->setObservaciones($servicio->observaciones);
    $sb->setEstatusInt($servicio->estatus);
    $sb->setIdUsuario($servicio->idUsuario);
    $sb->setIdEmpleado($servicio->idEmpleado);
    $sb->setIdCliente($servicio->idCliente);
    //empleado
    $eb = new EmpleadoBean();
    $eb->setId($servicio->idEmpleado);
    $eb->setCedula($servicio->cedulaEmpleado);
    $eb->setNombre($servicio->nombreEmpleado);
    $eb->setApellido($servicio->apellidoEmpleado);
    $eb->setCargo($servicio->cargoEmpleado);
    $eb->setTelefonoPrincipal($servicio->telefonoPrincipalEmpleado);
    $eb->setTelefono2($servicio->telefono2Empleado);
    $eb->setTelefono3($servicio->telefono3Empleado);
    $eb->setEstatusInt($servicio->estatusEmpleado);
    $sb->empleado = $eb;
    //cliente
    $cb = new ClienteBean();
    $cb->setId($servicio->idCliente);
    $cb->setRif($servicio->rifCliente);
    $cb->setJuridica($servicio->juridicaCliente);
    $cb->setRazonSocial($servicio->razonSocialCliente);
    $cb->setNombreContacto($servicio->nombreContactoCliente);
    $cb->setCargoContacto($servicio->cargoContactoCliente);
    $cb->setDireccion($servicio->direccionCliente);
    $cb->setDireccionAnexo($servicio->direccionAnexoCliente);
    $cb->setPuntoReferencia($servicio->puntoReferenciaCliente);
    $cb->setTelefono($servicio->telefonoCliente);
    $cb->setOtroTelefono($servicio->otroTelefonoCliente);
    $cb->setEmail($servicio->emailCliente);
    $cb->setEstatusInt($servicio->estatusCliente);
    $sb->cliente = $cb;
    //usuario
    $ub = new UsuarioBean();
    $ub->setId($servicio->idUsuario);
    $ub->setNick($servicio->nickUsuario);
    $ub->setNivel($servicio->nivelUsuario);
    $ub->setNombre($servicio->nombreUsuario);
    $ub->setApellido($servicio->apellidoUsuario);
    $ub->setEstatus($servicio->estatusUsuario);
    $sb->usuario = $ub;

    return $sb;
  }
}
