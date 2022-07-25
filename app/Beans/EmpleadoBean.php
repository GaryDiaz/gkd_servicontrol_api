<?php

namespace App\Beans;

use App\Entities\EmpleadoEntity;

class EmpleadoBean {
  const ESTATUS = ["Inactivo", "Activo"];

  /**
   * @var int
   */
  public $id;
  /**
   * @var int
   */
  public $cedula;
  /**
   * @var string
   */
  public $nombre;
  /**
   * @var string
   */
  public $apellido;
  /**
   * @var string
   */
  public $cargo;
  /**
   * @var string
   */
  public $telefonoPrincipal;
  /**
   * @var string
   */
  public $telefono2;
  /**
   * @var string
   */
  public $telefono3;
  /**
   * @var string
   */
  public $estatus;

  public function __construct(EmpleadoEntity $empleado = null) {
    if ($empleado) {
      $this->setId(intval($empleado->id));
      $this->setCedula(intval($empleado->cedula));
      $this->setNombre($empleado->nombre);
      $this->setApellido($empleado->apellido);
      $this->setCargo($empleado->cargo);
      $this->setTelefonoPrincipal($empleado->telefonoPrincipal);
      $this->setTelefono2($empleado->telefono2);
      $this->setTelefono3($empleado->telefono3);
      $this->setEstatusInt(intval($empleado->estatus));
    }
  }

  /**
   * Get the value of id
   * @return  int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set the value of id
   * @param  int  $id
   * @return  self
   */
  public function setId(int $id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Get the value of cedula
   * @return  int
   */
  public function getCedula() {
    return $this->cedula;
  }

  /**
   * Set the value of cedula
   * @param  int  $cedula
   * @return  self
   */
  public function setCedula(int $cedula) {
    $this->cedula = $cedula;
    return $this;
  }

  /**
   * Get the value of nombre
   * @return  string
   */
  public function getNombre() {
    return $this->nombre;
  }

  /**
   * Set the value of nombre
   * @param  string  $nombre
   * @return  self
   */
  public function setNombre(string $nombre) {
    $this->nombre = $nombre;
    return $this;
  }

  /**
   * Get the value of apellido
   * @return  string
   */
  public function getApellido() {
    return $this->apellido;
  }

  /**
   * Set the value of apellido
   * @param  string  $apellido
   * @return  self
   */
  public function setApellido(string $apellido) {
    $this->apellido = $apellido;
    return $this;
  }

  /**
   * Get the value of cargo
   * @return  string
   */
  public function getCargo() {
    return $this->cargo;
  }

  /**
   * Set the value of cargo
   * @param  string  $cargo
   * @return  self
   */
  public function setCargo(string $cargo) {
    $this->cargo = $cargo;
    return $this;
  }

  /**
   * Get the value of telefonoPrincipal
   * @return  string
   */
  public function getTelefonoPrincipal() {
    return $this->telefonoPrincipal;
  }

  /**
   * Set the value of telefonoPrincipal
   * @param  string  $telefonoPrincipal
   * @return  self
   */
  public function setTelefonoPrincipal(string $telefonoPrincipal) {
    $this->telefonoPrincipal = $telefonoPrincipal;
    return $this;
  }

  /**
   * Get the value of telefono2
   * @return  string
   */
  public function getTelefono2() {
    return $this->telefono2;
  }

  /**
   * Set the value of telefono2
   * @param  string  $telefono2
   * @return  self
   */
  public function setTelefono2(string $telefono2) {
    $this->telefono2 = $telefono2;
    return $this;
  }

  /**
   * Get the value of telefono3
   * @return  string
   */
  public function getTelefono3() {
    return $this->telefono3;
  }

  /**
   * Set the value of telefono3
   * @param  string  $telefono3
   * @return  self
   */
  public function setTelefono3(string $telefono3) {
    $this->telefono3 = $telefono3;
    return $this;
  }

  /**
   * Get the value of estatus
   * @return  string
   */
  public function getEstatus() {
    return $this->estatus;
  }

  /**
   * Set the value of estatus
   * @param  string  $estatus
   * @return  self
   */
  public function setEstatus(string $estatus) {
    $this->estatus = $estatus;
    return $this;
  }

  /**
   * Get the value of estatus
   * @return  int
   */
  public function getEstatusInt() {
    for ($i = 0; $i < count(self::ESTATUS); $i++) {
      if ($this->estatus === self::ESTATUS[$i]) {
        return $i;
      }
    }
    return 0;
  }

  /**
   * Set the value of estatus
   * @param  int  $estatus
   * @return  self
   */
  public function setEstatusInt(int $estatus) {
    $this->estatus = $estatus === 0 ? self::ESTATUS[0] : self::ESTATUS[1];
    return $this;
  }

  public function getNombreCompleto(): string {
    return $this->nombre . " " . $this->apellido;
  }

  public function getEmpleadoEntity(): EmpleadoEntity {
    $ee = new EmpleadoEntity(array(
      "idEmpleado" => $this->getId(),
      "cedula" => $this->getCedula(),
      "nombre" => $this->getNombre(),
      "apellido" => $this->getApellido(),
      "cargo" => $this->getCargo(),
      "telefonoPrincipal" => $this->getTelefonoPrincipal(),
      "telefono2" => $this->getTelefono2(),
      "telefono3" => $this->getTelefono3(),
      "estatus" => $this->getEstatusInt(),
    ));
    return $ee;
  }

  public function setEmpleadoEntity(EmpleadoEntity $empleado) {
    $this->setId($empleado->id);
    $this->setCedula($empleado->cedula);
    $this->setNombre($empleado->nombre);
    $this->setApellido($empleado->apellido);
    $this->setCargo($empleado->cargo);
    $this->setTelefonoPrincipal($empleado->telefonoPrincipal);
    $this->setTelefono2($empleado->telefono2);
    $this->setTelefono3($empleado->telefono3);
    $this->setEstatusInt($empleado->estatus);
  }

  public static function arrayEntitiesToBeans(array $empleados): array {
    $beans = [];
    for ($i = 0; $i < count($empleados); $i++) {
      $ee = $empleados[$i];
      $eb = new EmpleadoBean($ee);
      $beans[$i] = $eb;
    }
    return $beans;
  }

  public static function extraerDatosActualizables(array $form): array {
    $data = [];
    $nombre = array_key_exists("nombre", $form) ? $form["nombre"] : null;
    $apellido = array_key_exists("apellido", $form) ? $form["apellido"] : null;
    $cargo = array_key_exists("cargo", $form) ? $form["cargo"] : null;
    $telefonoPrincipal = array_key_exists("telefonoPrincipal", $form)
      ? $form["telefonoPrincipal"]
      : null;
    $telefono2 = array_key_exists("telefono2", $form) ? $form["telefono2"] : null;
    $telefono3 = array_key_exists("telefono3", $form) ? $form["telefono3"] : null;
    if ($nombre !== null) {
      $data["nombre"] = $nombre;
    }
    if ($apellido !== null) {
      $data["apellido"] = $apellido;
    }
    if ($cargo !== null) {
      $data["cargo"] = $cargo;
    }
    if ($telefonoPrincipal !== null) {
      $data["telefonoPrincipal"] = $telefonoPrincipal;
    }
    if ($telefono2 !== null) {
      $data["telefono2"] = $telefono2;
    }
    if ($telefono3 !== null) {
      $data["telefono3"] = $telefono3;
    }
    return $data;
  }

  public static function getInstanceCreateForm(array $form): EmpleadoBean {
    $eb = new EmpleadoBean();
    $eb->setId(0);
    $eb->setCedula($form["cedula"]);
    $eb->setNombre($form["nombre"]);
    $eb->setApellido($form["apellido"]);
    $eb->setCargo($form["cargo"]);
    $eb->setTelefonoPrincipal($form["telefonoPrincipal"]);
    $eb->setTelefono2($form["telefono2"]);
    $eb->setTelefono3($form["telefono3"]);
    $eb->setEstatusInt(1);
    return $eb;
  }
}
