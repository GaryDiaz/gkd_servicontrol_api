<?php

namespace App\Beans;

use App\Entities\ClienteEntity;

class EmpleadoBean {
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
   * @var string
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

  /**
   * Get the value of jurica
   * @return string
   */
  public function getJuridica() {
    return $this->juridica;
  }

  /**
   * Set the value of juridica
   * @param string $juridica
   * @return self
   */
  public function setJuridica(string $juridica) {
    $this->juridica = $juridica;
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
}
