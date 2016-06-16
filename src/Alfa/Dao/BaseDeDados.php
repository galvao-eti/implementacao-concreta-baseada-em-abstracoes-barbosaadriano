<?php

namespace Alfa\Dao;

/**
 * Description of BaseDeDados
 *
 * @author Administrador
 */
class BaseDeDados implements \Alfa\Abstracao\BaseDeDados {

    private $nome;
    private static $conexao;

    /**
     *
     * @var \Alfa\Abstracao\SGBD 
     */
    private $sgbd;

    /**
     * 
     * @param \Alfa\Abstracao\SGBD $server
     * @param string $nome
     */
    function __construct(\Alfa\Abstracao\SGBD $server, $nome = null) {
        $this->sgbd = $server;
        $this->nome = $nome;
    }

    /**
     * 
     * @return \PDO
     * @throws \Exception
     */
    public function conectar() {
        if (!self::$conexao) {
            if (!$this->nome) {
                throw new \Exception("Não é possível conectar sem informar o nome da base de dados!");
            }
            try {
                self::$conexao = new \PDO("mysql:host={$this->sgbd->getEndereco()};"
                        . " port={$this->sgbd->getPorta()}; "
                        . " dbname={$this->getNome()}", $this->sgbd->getUsuario()
                        , $this->sgbd->getSenha(), array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (\Exception $exc) {
                throw new \Exception("Erro ao tentar iniciar uma conexão! " . $exc->getMessage());
            }
        }
        return self::$conexao;
    }

    public function desconectar() {
        self::$conexao = null;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}
