<?php

namespace App\Beans;

use App\Beans\UsuarioBean;
use App\Entities\UsuarioEntity;
use App\Models\UsuarioModel;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AccesoBean extends UsuarioBean {
  /**
   * @var string
   */
  private $apiKey;
  /**
   * @var string
   */
  private $clave;
  /**
   * @var string
   */
  private $ultimoAcceso;

  /**
   * Get the value of apiKey
   * @return  string
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * Set the value of apiKey
   * @param  string  $apiKey
   * @return  self
   */
  public function setApiKey(string $apiKey) {
    $this->apiKey = $apiKey;
    return $this;
  }

  /**
   * Set the value of clave
   * @param  string  $clave
   * @return  self
   */
  public function setClave(string $clave) {
    $this->clave = $clave;
    return $this;
  }

  /**
   * Get the value of ultimoAcceso
   * @return  string
   */
  public function getUltimoAcceso() {
    return $this->ultimoAcceso;
  }

  /**
   * Set the value of ultimoAcceso
   * @param  string  $ultimoAcceso
   * @return  self
   */
  public function setUltimoAcceso(string $ultimoAcceso) {
    $this->ultimoAcceso = $ultimoAcceso;
    return $this;
  }

  public function __construct(UsuarioEntity $usuario = null) {
    parent::__construct($usuario);
    if ($usuario) {
      $this->apiKey = $usuario->apiKey;
      $this->clave = $usuario->clave;
      $this->ultimoAcceso = $usuario->ultimoAcceso;
    }
  }

  public function getUsuarioEntity(): UsuarioEntity {
    $data = new UsuarioEntity(array(
      "id" => $this->getId(),
      "nick" => $this->getNick(),
      "clave" => $this->clave,
      "apiKey" => $this->getApiKey(),
      "nivel" => $this->getNivel(),
      "nombre" => $this->getNombre(),
      "apellido" => $this->getApellido(),
      "estatus" => $this->getEstatus(),
      "ultimoAcceso" => $this->getUltimoAcceso(),
    ));
    return $data;
  }

  public function setUsuarioEntity(UsuarioEntity $usuario) {
    $this->setId(intval($usuario->id));
    $this->setNick($usuario->nick);
    $this->setClave($usuario->clave);
    $this->setNivel(intval($usuario->nivel));
    $this->setNombre($usuario->nombre);
    $this->setApellido($usuario->apellido);
    $this->setEstatus(intval($usuario->estatus));
    $this->setUltimoAcceso($usuario->estatus);
  }

  public function generarToken(): string {
    $key = getenv('JWT_SECRET');
    $payload = array(
      "nick" => $this->getNick(),
      "apiKey" => $this->getApiKey(),
      "rol" => $this->getRol(),
      "nombre" => $this->getNombreCompleto(),
      "iat" => $this->getUltimoAcceso(),
    );

    return JWT::encode($payload, $key, 'HS256');
  }

  public static function decodificarToken($jwt) {
    try {
      if ($jwt) {
        $key = getenv('JWT_SECRET');
        $payload = JWT::decode($jwt, new Key($key, "HS256"));
        return $payload;
      } else {
        throw new Exception("Se requiere iniciar sesión");
      }
    } catch (Exception $exc) {
      throw new Exception("Se requiere iniciar sesión");
    }
  }

  public static function validarToken($payload) {
    try {
      $nick = $payload->nick;
      $model = new UsuarioModel();
      $usuario = $model->findByNick($nick);
      if ($usuario) {
        if ($usuario["apiKey"] === $payload->apiKey) {
          return $usuario;
        } else {
          throw new Exception("No posee un token válido o su token ha expirado, se requiere iniciar sesión");
        }
      } else {
        throw new Exception("No posee un token válido (no se reconoce el usuario), se requiere iniciar sesión");
      }
    } catch (Exception $th) {
      throw new Exception("No posee un token válido, se requiere iniciar sesión");
    }
  }

  public static function getInstanceDataArray(array $data): AccesoBean {
    $ab = new AccesoBean();
    $ab->setId($data["idUsuario"]);
    $ab->setNick($data["nick"]);
    $ab->setNivel(intval($data["nivel"]));
    $ab->setNombre($data["nombre"]);
    $ab->setApellido($data["apellido"]);
    $ab->setEstatus($data["estatus"]);
    $ab->setClave($data["clave"]);
    $ab->setApiKey($data["apiKey"]);
    $ab->setUltimoAcceso($data["ultimoAcceso"]);
    return $ab;
  }
}
