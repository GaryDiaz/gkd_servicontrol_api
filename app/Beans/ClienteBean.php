<?php

namespace App\Beans;

use App\Entities\ClienteEntity;

class EmpleadoBean {
  const JURIDICA = ["V", "J", "E", "P", "G"];
  const ESTATUS = ["Inactivo", "Activo"];
  const PERSONALIDAD = [
    "V" => "Natural de Venezuela",
    "J" => "Persona Jurídica",
    "E" => "Extrangero con residencia en Venezuela",
    "P" => "Agente Registrado con Pasaporte",
    "G" => "Ente Gubernamental",
  ];

  /**
   * @var int
   */
  public $id;
  /**
   * @var string
   */
  public $rif;
  /**
   * @var string
   */
  public $prefijoRif;
  /**
   * @var string
   */
  public $personalidad;
  /**
   * @var string
   */
  public $nombreCompania;
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
      $this->setId($cliente->id);
      $this->setRif($cliente->rif);
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
   * Get the value of rif
   * @return string
   */
  public function getRif() {
    return $this->rif;
  }

  /**
   * Set the value of rif
   * @param string $rif
   * @return self
   */
  public function setRif(string $rif) {
    $this->rif = $rif;
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
    $this->personalidad = self::PERSONALIDAD[$this->prefijoRif];
    return $this;
  }

  /**
   * Get the value of personalidad
   * @return string
   */
  public function getPersonalidad() {
    return $this->personalidad;
  }

  /**
   * Set the value of personalidad
   * @param string $personalidad
   * @return self
   */
  public function setPersonalidad(string $personalidad) {
    $this->personalidad = $personalidad;
    return $this;
  }

  /**
   * Get the value of nombreCompania
   * @return string
   */
  public function getNombreCompania() {
    return $this->nombreCompania;
  }

  /**
   * Set the value of nombreCompania
   * @param string $nombreCompania
   * @return self
   */
  public function setNombreCompania(string $nombreCompania) {
    $this->nombreCompania = $nombreCompania;
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

  public function getJuridica(): int {
    for ($i = 0; $i < count(self::JURIDICA); $i++) {
      if (self::JURIDICA[$i] === $this->getPrefijoRif) {
        return $i;
      }
    }
    return 0;
  }

  public function setJuridica(int $juridica) {
    if ($juridica < count(self::JURIDICA)) {
      $this->setPrefijoRif(self::JURIDICA[$juridica]);
    } else {
      $this->setPrefijoRif(self::JURIDICA[0]);
    }
  }
}
