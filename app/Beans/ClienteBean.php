<?php

namespace App\Beans;

use App\Entities\ClienteEntity;

class ClienteBean {
  const PREFIJOS_RIF = ["V", "E", "P", "J", "G"];
  const ESTATUS = ["Inactivo", "Activo"];
  const DESCRIPCION_PREFIJOS = [
    "V" => "Natural de Venezuela",
    "E" => "Extrangero con residencia en Venezuela",
    "P" => "Agente Registrado con Pasaporte",
    "J" => "Persona Jurídica",
    "G" => "Órgano o Ente Gubernamental",
  ];

  /**
   * @var int
   */
  public $id;
  /**
   * @var string
   */
  public $numeroRif;
  /**
   * @var string
   */
  public $prefijoRif;
  /**
   * @var bool
   */
  public $juridica;
  /**
   * @var string
   */
  public $razonSocial;
  /**
   * @var string
   */
  public $nombreContacto;
  /**
   * @var string
   */
  public $cargoContacto;
  /**
   * @var string
   */
  public $direccion;
  /**
   * @var string
   */
  public $direccionAnexo;
  /**
   * @var string
   */
  public $puntoReferencia;
  /**
   * @var string
   */
  public $telefono;
  /**
   * @var string
   */
  public $otroTelefono;
  /**
   * @var string
   */
  public $email;
  /**
   * @var string
   */
  public $estatus;

  public function __construct(ClienteEntity $cliente = null) {
    if ($cliente) {
      $this->setClienteEntity($cliente);
    }
  }

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
   * Get the value of numeroRif
   * @return string
   */
  public function getNumeroRif() {
    return $this->numeroRif;
  }

  /**
   * Set the value of numeroRif
   * @param string $numeroRif
   * @return self
   */
  public function setNumeroRif(string $numeroRif) {
    $this->numeroRif = $numeroRif;
    return $this;
  }

  /**
   * Get the value of prefijoRif
   * @return string
   */
  public function getPrefijoRif() {
    return $this->prefijoRif;
  }

  /**
   * Set the value of prefijoRif
   * @param string $prefijoRif
   * @return self
   */
  public function setPrefijoRif(string $prefijoRif) {
    $this->prefijoRif = $prefijoRif;
    return $this;
  }

  public function getRif(): string {
    return $this->prefijoRif . $this->numeroRif;
  }

  public function setRif(string $rif) {
    $this->prefijoRif = substr($rif, 0, 1);
    $this->numeroRif = substr($rif, 1, 10);
    $this->juridica = ($this->prefijoRif === "J" || $this->prefijo === "G");
  }

  /**
   * Get the value of jurica
   * @return bool
   */
  public function getJuridica() {
    return $this->juridica;
  }

  /**
   * Set the value of juridica
   * @param bool $juridica
   * @return self
   */
  public function setJuridica(bool $juridica) {
    $this->juridica = $juridica;
    return $this;
  }

  /**
   * Get the value of razonSocial
   * @return string
   */
  public function getRazonSocial() {
    return $this->razonSocial;
  }

  /**
   * Set the value of razonSocial
   * @param string $razonSocial
   * @return self
   */
  public function setRazonSocial(string $razonSocial) {
    $this->razonSocial = $razonSocial;
    return $this;
  }

  /**
   * Get the value of nombreContacto
   * @return string
   */
  public function getNombreContacto() {
    return $this->nombreContacto;
  }

  /**
   * Set the value of nombreContacto
   * @param string $nombreContacto
   * @return self
   */
  public function setNombreContacto(string $nombreContacto) {
    $this->nombreContacto = $nombreContacto;

    return $this;
  }

  /**
   * Get the value of cargoContacto
   * @return string
   */
  public function getCargoContacto() {
    return $this->cargoContacto;
  }

  /**
   * Set the value of cargoContacto
   * @param string $cargoContacto
   * @return self
   */
  public function setCargoContacto(string $cargoContacto) {
    $this->cargoContacto = $cargoContacto;
    return $this;
  }

  /**
   * Get the value of direccion
   * @return string
   */
  public function getDireccion() {
    return $this->direccion;
  }

  /**
   * Set the value of direccion
   * @param string $direccion
   * @return self
   */
  public function setDireccion(string $direccion) {
    $this->direccion = $direccion;
    return $this;
  }

  /**
   * Get the value of direccionAnexo
   * @return string
   */
  public function getDireccionAnexo() {
    return $this->direccionAnexo;
  }

  /**
   * Set the value of direccionAnexo
   * @param string $direccionAnexo
   * @return self
   */
  public function setDireccionAnexo(string $direccionAnexo) {
    $this->direccionAnexo = $direccionAnexo;

    return $this;
  }

  /**
   * Get the value of puntoReferencia
   * @return string
   */
  public function getPuntoReferencia() {
    return $this->puntoReferencia;
  }

  /**
   * Set the value of puntoReferencia
   * @param string $puntoReferencia
   * @return self
   */
  public function setPuntoReferencia(string $puntoReferencia) {
    $this->puntoReferencia = $puntoReferencia;
    return $this;
  }

  /**
   * Get the value of telefono
   * @return string
   */
  public function getTelefono() {
    return $this->telefono;
  }

  /**
   * Set the value of telefono
   * @param string $telefono
   * @return self
   */
  public function setTelefono(string $telefono) {
    $this->telefono = $telefono;
    return $this;
  }

  /**
   * Get the value of otroTelefono
   * @return string
   */
  public function getOtroTelefono() {
    return $this->otroTelefono;
  }

  /**
   * Set the value of otroTelefono
   * @param string $otroTelefono
   * @return self
   */
  public function setOtroTelefono(string $otroTelefono) {
    $this->otroTelefono = $otroTelefono;
    return $this;
  }

  /**
   * Get the value of email
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Set the value of email
   * @param string $email
   * @return self
   */
  public function setEmail(string $email) {
    $this->email = $email;
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

  public function getClienteEntity(): ClienteEntity {
    $ce = new ClienteEntity(array(
      "idCliente" => $this->getId(),
      "rif" => $this->getRif(),
      "juridica" => $this->getJuridica() ? 1 : 0,
      "razonSocial" => $this->getRazonSocial(),
      "nombreContacto" => $this->getNombreContacto(),
      "cargoContacto" => $this->getCargoContacto(),
      "direccion" => $this->getDireccion(),
      "direccionAnexo" => $this->getDireccionAnexo(),
      "puntoReferencia" => $this->getPuntoReferencia(),
      "telefono" => $this->getTelefono(),
      "otroTelefono" => $this->getOtroTelefono(),
      "email" => $this->getEmail(),
      "estatus" => $this->getEstatusInt(),
    ));
    return $ce;
  }

  public function setClienteEntity(ClienteEntity $cliente) {
    $this->setId($cliente->id);
    $this->setRif($cliente->rif);
    $this->setRazonSocial($cliente->getRazonSocial);
    $this->setNombreContacto($cliente->getNombreContacto);
    $this->setCargoContacto($cliente->cargoContacto);
    $this->setDireccion($cliente->direccion);
    $this->setDireccionAnexo($cliente->direccionAnexo);
    $this->setPuntoReferencia($cliente->puntoReferencia);
    $this->setTelefono($cliente->telefono);
    $this->setOtroTelefono($cliente->otroTelefono);
    $this->setEmail($cliente->email);
    $this->setEstatusInt($cliente->estatus);
  }

  public static function arrayEntitiesToBeans(array $clientes): array {
    $beans = [];
    for ($i = 0; $i < count($clientes); $i++) {
      $ce = $clientes[$i];
      $cb = new ClienteBean($ce);
      $beans[$i] = $cb;
    }
    return $beans;
  }

  public static function extraerDatosActualizables(array $form): array {
    $data = [];
    $numeroRif = array_key_exists("numeroRif", $form) ? $form["numeroRif"] : null;
    $prefijoRif = array_key_exists("prefijoRif", $form) ? $form["prefijoRif"] : null;
    $rif = ($numeroRif && $prefijoRif) ? $numeroRif . $prefijoRif : null;
    $xj = array_key_exists("juridica", $form) ? $form["juridica"] : null;
    $juridica = $xj ? 1 : 0;
    $razonSocial = array_key_exists("razonSocial", $form) ? $form["razonSocial"] : null;
    $nombreContacto = array_key_exists("nombreContacto", $form) ? $form["nombreContacto"] : null;
    $cargoContacto = array_key_exists("cargoContacto", $form) ? $form["cargoContacto"] : null;
    $direccion = array_key_exists("direccion", $form) ? $form["direccion"] : null;
    $direccionAnexo = array_key_exists("direccionAnexo", $form) ? $form["direccionAnexo"] : null;
    $puntoReferencia = array_key_exists("puntoReferencia", $form) ? $form["puntoReferencia"] : null;
    $telefono = array_key_exists("telefono", $form) ? $form["telefono"] : null;
    $otroTelefono = array_key_exists("otroTelefono", $form) ? $form["otroTelefono"] : null;
    $email = array_key_exists("email", $form) ? $form["email"] : null;
    if ($rif !== null) {
      $data["rif"] = $rif;
    }
    if ($juridica !== null) {
      $data["juridica"] = $juridica;
    }
    if ($razonSocial !== null) {
      $data["razonSocial"] = $razonSocial;
    }
    if ($nombreContacto !== null) {
      $data["nombreContacto"] = $nombreContacto;
    }
    if ($cargoContacto !== null) {
      $data["cargoContacto"] = $cargoContacto;
    }
    if ($direccion !== null) {
      $data["direccion"] = $direccion;
    }
    if ($direccionAnexo !== null) {
      $data["direccionAnexo"] = $direccionAnexo;
    }
    if ($puntoReferencia !== null) {
      $data["puntoReferencia"] = $puntoReferencia;
    }
    if ($telefono !== null) {
      $data["telefono"] = $telefono;
    }
    if ($otroTelefono !== null) {
      $data["otroTelefono"] = $otroTelefono;
    }
    if ($email !== null) {
      $data["email"] = $email;
    }
    return $data;
  }

  public static function getInstanceCreateForm(array $form): ClienteBean {
    $cb = new ClienteBean();
    $cb->setId(0);
    $cb->setRif($form["rif"]);
    $cb->setRazonSocial($form["razonSocial"]);
    $cb->setNombreContacto($form["nombreContacto"]);
    $cb->setCargoContacto($form["cargoContacto"]);
    $cb->setDireccion($form["direccion"]);
    $cb->setDireccionAnexo($form["direccionAnexo"]);
    $cb->setPuntoReferencia($form["puntoReferencia"]);
    $cb->setTelefono($form["telefono"]);
    $cb->setOtroTelefono($form["otroTelefono"]);
    $cb->setEmail($form["email"]);
    $cb->setEstatusInt(1);
    return $cb;
  }
}
