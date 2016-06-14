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
    private $sgbd;

    function __construct(\Alfa\Abstracao\SGBD $server, $nome = null) {
        $this->sgbd = $server;
        $this->nome;
    }

    public function conectar() {
        if (!self::$conexao) {
            if (!$this->nome) {
                throw new \Exception("Não é possível conectar sem informar o nome da base de dados!");
            }
            try {
                self::$conexao = new \PDO($dsn, $username, $passwd, $options);
            } catch (\Exception $exc) {
                throw new \Exception("Erro ao tentar iniciar uma conexão! " . $exc->getMessage());
            }
        }
    }

    public function desconectar() {
        
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}
