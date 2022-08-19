<?php

namespace App\Beans;

use App\Entities\DetalleServicioEntity;
use App\Traits\ArrayTrait;

class DetalleServicioBean {
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
  public $idServicio;
  /**
   * @var int
   */
  public $item;
  /**
   * @var int
   */
  public $fecha;
  /**
   * @var string
   */
  public $artefacto;
  /**
   * @var int
   */
  public $cantidad;
  /**
   * @var string
   */
  public $marca;
  /**
   * @var string
   */
  public $descripcion;
  /**
   * @var string
   */
  public $falla;
  /**
   * @var string
   */
  public $diagnostico;
  /**
   * @var string
   */
  public $observaciones;
  /**
   * @var string
   */
  public $estatus;

  public function __construct(?DetalleServicioEntity $dse = null) {
  }



  /**
   * @return int
   */
  public function getIdServicio() {
    return $this->idServicio;
  }

  /**
   * @param  int  $idServicio  
   */
  public function setIdServicio(int $idServicio) {
    $this->idServicio = $idServicio;
  }

  /**
   * @return int
   */
  public function getItem() {
    return $this->item;
  }

  /**
   * @param  int  $item  
   */
  public function setItem(int $item) {
    $this->item = $item;
  }

  /**
   * @return int
   */
  public function getFecha() {
    return $this->fecha;
  }

  /**
   * @param  int  $fecha  
   */
  public function setFecha(int $fecha) {
    $this->fecha = $fecha;
  }

  /**
   * @return string
   */
  public function getArtefacto() {
    return $this->artefacto;
  }

  /**
   * @param  string  $artefacto  
   */
  public function setArtefacto(string $artefacto) {
    $this->artefacto = $artefacto;
  }

  /**
   * @return int
   */
  public function getCantidad() {
    return $this->cantidad;
  }

  /**
   * @param  int  $cantidad  
   */
  public function setCantidad(int $cantidad) {
    $this->cantidad = $cantidad;
  }

  /**
   * @return string
   */
  public function getMarca() {
    return $this->marca;
  }

  /**
   * @param  string  $marca  
   */
  public function setMarca(string $marca) {
    $this->marca = $marca;
  }

  /**
   * @return string
   */
  public function getDescripcion() {
    return $this->descripcion;
  }

  /**
   * @param  string  $descripcion  
   */
  public function setDescripcion(string $descripcion) {
    $this->descripcion = $descripcion;
  }

  /**
   * @return string
   */
  public function getFalla() {
    return $this->falla;
  }

  /**
   * @param  string  $falla  
   */
  public function setFalla(string $falla) {
    $this->falla = $falla;
  }

  /**
   * @return string
   */
  public function getDiagnostico() {
    return $this->diagnostico;
  }

  /**
   * @param  string  $diagnostico  
   */
  public function setDiagnostico(string $diagnostico) {
    $this->diagnostico = $diagnostico;
  }

  /**
   * @return string
   */
  public function getObservaciones() {
    return $this->observaciones;
  }

  /**
   * @param  string  $observaciones  
   */
  public function setObservaciones(string $observaciones) {
    $this->observaciones = $observaciones;
  }

  /**
   * @return string
   */
  public function getEstatus() {
    return $this->estatus;
  }

  /**
   * @return int
   */
  public function getEstatusInt() {
    for ($i = 0; $i < count(self::ESTATUS); $i++) {
      if (self::ESTATUS[$i] === $this->estatus) {
        return $i;
      }
    }
    return 0;
  }

  /**
   * @param  string|int  $estatus
   */
  public function setEstatus($estatus) {
    if (is_int($estatus)) {
      $this->estatus = $estatus >= 0 && $estatus < count(self::ESTATUS)
        ? self::ESTATUS[$estatus]
        : self::ESTATUS[0];
    } else {
      $this->estatus = $estatus;
    }
  }

  public function getDetalleServicioEntity(): DetalleServicioEntity {
    $dse = new DetalleServicioEntity(array(
      "idServicio" => $this->getIdServicio(),
      "item" => $this->getItem(),
      "fecha" => $this->getFecha(),
      "artefacto" => $this->getArtefacto(),
      "cantidad" => $this->getCantidad(),
      "marca" => $this->getMarca(),
      "descripcion" => $this->getDescripcion(),
      "falla" => $this->getFalla(),
      "diagnostico" => $this->getDiagnostico(),
      "observaciones" => $this->getObservaciones(),
      "estatus" => $this->getEstatusInt(),
    ));
    return $dse;
  }

  public function setDetalleServicioEntity(DetalleServicioEntity $dse) {
    $this->setIdServicio($dse->idServicio);
    $this->setItem($dse->item);
    $this->setFecha($dse->fecha);
    $this->setArtefacto($dse->artefacto);
    $this->setCantidad($dse->cantidad);
    $this->setMarca($dse->marca);
    $this->setDescripcion($dse->descripcion);
    $this->setFalla($dse->falla);
    $this->setDiagnostico($dse->diagnostico);
    $this->setObservaciones($dse->observaciones);
    $this->setEstatus($dse->estatus);
  }

  public static function arrayEntitiesToBeans(array $detalles): array {
    $beans = [];
    for ($i = 0; $i < count($detalles); $i++) {
      $dse = $detalles[$i];
      $dsb = new DetalleServicioBean($dse);
      $beans[$i] = $dsb;
    }
    return $beans;
  }

  public static function extraerDatosActualizables(array $form): array {
    $keys = ["fecha", "artefacto", "cantidad", "marca", "descripcion", "falla", "diagnostico", "observaciones", "estatus"];
    return ArrayTrait::filtrarCampos($keys, $form);
  }

  public static function getInstanceCreateForm(array $form): DetalleServicioBean {
    $dsb = new DetalleServicioBean();
    $dsb->setIdServicio($form["idServicio"]);
    $dsb->setItem(0);
    $dsb->setFecha($form["fecha"]);
    $dsb->setArtefacto($form["artefacto"]);
    $dsb->setCantidad($form["cantidad"]);
    $dsb->setMarca($form["marca"]);
    $dsb->setDescripcion($form["descripcion"]);
    $dsb->setFalla($form["falla"]);
    $dsb->setDiagnostico($form["diagnostico"]);
    $dsb->setObservaciones($form["observaciones"]);
    $dsb->setEstatus(0);
    return $dsb;
  }
}
