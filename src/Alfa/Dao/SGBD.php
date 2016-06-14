<?php

namespace Alfa\Dao;

/**
 * Description of SGBD
 *
 * @author Adriano Barbosa
 */
class SGBD implements \Alfa\Abstracao\SGBD {

    private $endereco;
    private $porta;
    private $senha;
    private $usuario;

    function getEndereco() {
        return $this->endereco;
    }

    function getPorta() {
        return $this->porta;
    }

    function getSenha() {
        return $this->senha;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setPorta($porta) {
        $this->porta = $porta;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}
