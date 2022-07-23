<?php

namespace App\Beans;

use App\Entities\UsuarioEntity;

class UsuarioBean {
  const ADMIN = 2;
  const USUARIO_ADMIN = 1;
  const USUARIO = 0;
  const ROLES = ['Operador', 'Administrador de Usuarios', 'Administrador'];

  /**
   * @var int
   */
  public $id;
  /**
   * @var string
   */
  public $nick;
  /**
   * @var string
   */
  public $rol;
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
  public $estatus;
  private $estatusActividad = ['Inactivo', 'Activo'];

  public function __construct(UsuarioEntity $usuario = null) {
    if ($usuario) {
      $this->setId(intval($usuario->id));
      $this->setNick($usuario->nick);
      $this->setNivel(intval($usuario->nivel));
      $this->setNombre($usuario->nombre);
      $this->setApellido($usuario->apellido);
      $this->setEstatus(intval($usuario->estatus));
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
   * Get the value of nick
   * @return  string
   */
  public function getNick() {
    return $this->nick;
  }

  /**
   * Set the value of nick
   * @param  string  $nick
   * @return  self
   */
  public function setNick(string $nick) {
    $this->nick = $nick;

    return $this;
  }

  /**
   * Get the value of nivel
   * @return  int
   */
  public function getNivel() {
    for ($i = 0; $i < count(self::ROLES); $i++) {
      if (self::ROLES[$i] === $this->rol) {
        return $i;
      }
    }
    return 0;
  }

  /**
   * Set the value of nivel
   * @param  int  $nivel
   * @return  self
   */
  public function setNivel(int $nivel) {
    if ($nivel >= 0 && $nivel < count(self::ROLES)) {
      $this->rol = self::ROLES[$nivel];
    }
    return $this;
  }

  /**
   * Get the value of rol
   * @return  string
   */
  public function getRol() {
    return $this->rol;
  }

  /**
   * Set the value of rol
   * @param  string  $rol
   * @return  self
   */
  public function setRol(string $rol) {
    for ($i = 0; $i < count(self::ROLES); $i++) {
      if ($rol === self::ROLES[$i]) {
        $this->rol = $rol;
      }
    }
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
   * Get the value of estatus
   * @return  string
   */
  public function getEstatus() {
    return $this->estatus;
  }

  /**
   * Set the value of estatus
   * @param $estatus
   * @return  self
   */
  public function setEstatus($estatus) {
    if (is_numeric($estatus)) {
      $this->estatus = $this->estatusActividad[$estatus];
    } else {
      $this->estatus = $estatus;
    }

    return $this;
  }

  public function getNombreCompleto(): string {
    return $this->nombre . " " . $this->apellido;
  }

  public function getUsuarioEntity(): UsuarioEntity {
    $data = new UsuarioEntity(array(
      "idUsuario" => $this->getId(),
      "nick" => $this->getNick(),
      "apiKey" => $this->getNick(),
      "nivel" => $this->getNivel(),
      "nombre" => $this->getNombre(),
      "apellido" => $this->getApellido(),
      "estatus" => $this->getEstatus() === $this->estatusActividad[1] ? 1 : 0,
    ));
    return $data;
  }

  public function setUsuarioEntity(UsuarioEntity $usuario) {
    $this->setId(intval($usuario->id));
    $this->setNick($usuario->nick);
    $this->setNivel(intval($usuario->nivel));
    $this->setNombre($usuario->nombre);
    $this->setApellido($usuario->apellido);
    $this->setEstatus(intval($usuario->estatus));
  }

  public static function arrayEntitiesToBeans(array $usuarios): array {
    $beans = [];
    for ($i = 0; $i < count($usuarios); $i++) {
      $usuario = $usuarios[$i];
      $ub = new UsuarioBean($usuario);
      $beans[$i] = $ub;
    }
    return $beans;
  }

  public static function getInstanceCreateForm(array $form): UsuarioBean {
    $ub = new UsuarioBean();
    $ub->setId(0);
    $ub->setNick($form["nick"]);
    $ub->setRol($form["rol"]);
    $ub->setNombre($form["nombre"]);
    $ub->setApellido($form["apellido"]);
    $ub->setEstatus(1);
    return $ub;
  }
}
