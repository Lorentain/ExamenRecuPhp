<?php
namespace models;

use lib\basedatos;
use PDO;
use PDOException;


/**
 *
 */
class correos {
    private basedatos $db;
    private null|int $id;
    private null|string $id_usuario;
    private string $de;
    private string $asunto;
    private string $cuerpo;
    private string $fecha;

    /**
     * @param string $de
     * @param string $asunto
     * @param string $cuerpo
     * @param string $fecha
     */
    public function __construct(?int $id,?int $id_usuario,string $de, string $asunto, string $cuerpo, string $fecha)
    {
        $this->db = new basedatos();
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->de = $de;
        $this->asunto = $asunto;
        $this->cuerpo = $cuerpo;
        $this->fecha = $fecha;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getIdUsuario(): ?string
    {
        return $this->id_usuario;
    }

    /**
     * @param string|null $id_usuario
     * @return void
     */
    public function setIdUsuario(?string $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return string
     */
    public function getDe(): string
    {
        return $this->de;
    }

    /**
     * @param string $de
     * @return void
     */
    public function setDe(string $de): void
    {
        $this->de = $de;
    }

    /**
     * @return string
     */
    public function getAsunto(): string
    {
        return $this->asunto;
    }

    /**
     * @param string $asunto
     * @return void
     */
    public function setAsunto(string $asunto): void
    {
        $this->asunto = $asunto;
    }

    /**
     * @return string
     */
    public function getCuerpo(): string
    {
        return $this->cuerpo;
    }

    /**
     * @param string $cuerpo
     * @return void
     */
    public function setCuerpo(string $cuerpo): void
    {
        $this->cuerpo = $cuerpo;
    }

    /**
     * @return string
     */
    public function getFecha(): string
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     * @return void
     */
    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @param array $data
     * @return correos
     */
    public static function fromArray(array $data):correos {
        return new correos(
            $data['id'] ?? null,
            $data['id_usuario'] ?? null,
            $data['de'] ?? '',
            $data['asunto'] ?? '',
            $data['cuerpo'] ?? '',
            $data['fecha'] ?? '',
        );
    }

    /**
     * @return void
     */
    public function desconecta() {
        $this->db->cierraConexion();
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed {
        $this->db->consulta("SELECT * FROM mensajes");
        $productos = $this->db->extraer_todos();
        $this->db->cierraConexion();
        return $productos;
    }

    /**
     * @return bool
     */
    public function eliminar() {
        $id=$this->getId();
        try {
            $stmt = $this->db->prepara("DELETE FROM mensajes WHERE id=:id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = true;
        }catch (PDOException $err) {
            $result = false;
        }
        return $result;
    }

    public function crear() {
        $id_usuario = $this->getIdUsuario();
        $de = $this->getDe();
        $asunto = $this->getAsunto();
        $cuerpo = $this->getCuerpo();
        $fecha = $this->getFecha();
        try {
            $stmt = $this->db->prepara("INSERT INTO mensajes (id_usuario,de,asunto,cuerpo,fecha) VALUES (:id_usuario,:de,:asunto,:cuerpo,:fecha)");
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->bindValue(':de', $de);
            $stmt->bindValue(':asunto', $asunto);
            $stmt->bindValue(':cuerpo', $cuerpo);
            $stmt->bindValue(':fecha', $fecha);
            $stmt->execute();
            $result = true;
        }catch (PDOException $err) {
            $result = false;
        }
        return $result;
    }

}
