<?php
namespace models;
use lib\basedatos,
    PDO,
    PDOException;
class usuario{
    private string|null $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $password;
    private string $rol;

    protected array $errores;
    private basedatos $db;

    public function __construct(string|null $id, string $nombre, string $apellidos, string $email, string $password, string $rol)
    {
        $this->db=new basedatos();
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->email=$email;
        $this->password=$password;
        $this->rol=$rol;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return void
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return void
     */
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRol(): string
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     * @return void
     */
    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }

    /**
     * @param array $data
     * @return usuario
     */
    public static function fromArray(array $data):usuario{
        return new usuario(
            $data['id']?? null,
            $data['nombre']??'',
            $data['apellidos']??'',
            $data['email']??'',
            $data['password']??'',
            $data['rol']??'',
        );
    }

    /**
     * @return void
     */
    public function desconecta(){
        $this->db->cierraConexion();
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed{
        $this->db->consulta("SELECT * FROM usuarios");
        $usuarios=$this->db->extraer_todos();
        $this->db->cierraConexion();
        return $usuarios;
    }

    /**
     * @return bool
     */
    public function create(){
        $id=null;
        $nombre=$this->getNombre();
        $apellidos=$this->getApellidos();
        $email=$this->getEmail();
        $password=$this->getPassword();
        $rol='user';
        try{
            $ins=$this->db->prepara("INSERT INTO usuarios (id,nombre,apellidos,email,password,rol) values (:id,:nombre,:apellidos,:email,:password,:rol)");
            $ins->bindValue(':id',$id);
            $ins->bindValue(':nombre',$nombre);
            $ins->bindValue(':apellidos',$apellidos);
            $ins->bindValue(':email',$email);
            $ins->bindValue(':password',$password);
            $ins->bindValue(':rol',$rol);
            $ins->execute();
            $result=true;
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function obtenerPassword($email){
        $select= $this->db->prepara("SELECT * FROM usuarios WHERE email = :email");
        $select->bindValue(':email', $email);
        $select->execute();
        return $resultados = $select->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed|void
     */
    public function login(){
        $result=false;
        $email = $this->getEmail();
        $password=$this->getPassword();
        $usuario=$this->buscaMail($email);
        if ($usuario !==false){
            $verify=password_verify($password,$usuario->password);
            if ($verify){
                return $usuario;
            }
        }

    }

    /**
     * @param $email
     * @return false|mixed
     */
    public function buscaMail($email){
        $cons=$this->db->prepara("SELECT * FROM usuarios WHERE email=:email");
        $cons->bindValue(':email',$email,PDO::PARAM_STR);
        try{
            $cons->execute();
            if ($cons && $cons->rowCount()==1){
                $result=$cons->fetch(PDO::FETCH_OBJ);
            }
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function editar(){
        $id=$this->getId();
        $nombre=$this->getNombre();
        $email=$this->getEmail();
        try{
            $upd=$this->db->prepara("UPDATE usuarios SET nombre=:nombre,email=:email WHERE id=:id");
            $upd->bindValue(':id',$id);
            $upd->bindValue(':nombre',$nombre);
            $upd->bindValue(':email',$email);
            $upd->execute();
            $result=true;
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function borrar(){
        $id=$this->getId();
        try{
            $del=$this->db->prepara("DELETE FROM usuarios WHERE id=:id");
            $del->bindValue(':id',$id);
            $del->execute();
            $result=true;
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }

}