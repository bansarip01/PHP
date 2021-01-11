<?php
[ "login","passwd","nombre","correo", "plan", "estado"];

class Usuario
{    
    private $login;
    private $passwd;
    private $nombre;
    private $correo;
    private $plan;
    private $estado;
    
    // Getter con método mágico
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágico
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
    
}