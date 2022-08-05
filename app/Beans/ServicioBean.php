<?php

namespace App\Beans;

use App\Entities\ServicioEntity;

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

  public static function extraerDatosActualizables(array $form): array {
    $data = [];
    $fechaServicio = array_key_exists("fechaServicio", $form) ? $form["fechaServicio"] : null;
    $fechaVisita = array_key_exists("fechaVisita", $form) ? $form["fechaVisita"] : null;
    $fechaFinServicio = array_key_exists("fechaFinServicio", $form) ? $form["fechaFinServicio"] : null;
    $fechaProximaVisita = array_key_exists("fechaProximaVisita", $form) ? $form["fechaProximaVisita"] : null;
    $observaciones = array_key_exists("observaciones", $form) ? $form["observaciones"] : null;
    $estatus = array_key_exists("estatus", $form) ? $form["estatus"] : null;
    $idUsuario = array_key_exists("idUsuario", $form) ? $form["idUsuario"] : null;
    $idEmpleado = array_key_exists("idEmpleado", $form) ? $form["idEmpleado"] : null;
    $idCliente = array_key_exists("idCliente", $form) ? $form["idCliente"] : null;
    if ($fechaServicio !== null) {
      $data["fechaServicio"] = $fechaServicio;
    }
    if ($fechaVisita !== null) {
      $data["fechaVisita"] = $fechaVisita;
    }
    if ($fechaFinServicio !== null) {
      $data["fechaFinServicio"] = $fechaFinServicio !== "" ? $fechaFinServicio : null;
    }
    if ($fechaProximaVisita !== null) {
      $data["fechaProximaVisita"] = $fechaProximaVisita !== "" ? $fechaProximaVisita : null;
    }
    if ($observaciones !== null) {
      $data["observaciones"] = $observaciones;
    }
    if ($estatus !== null) {
      $data["estatus"] = $estatus;
    }
    if ($idUsuario !== null) {
      $data["idUsuario"] = $idUsuario;
    }
    if ($idEmpleado !== null) {
      $data["idEmpleado"] = $idEmpleado;
    }
    if ($idCliente !== null) {
      $data["idCliente"] = $idCliente;
    }
    return $data;
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
}
