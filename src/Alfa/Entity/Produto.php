<?php

namespace Alfa\Entity;

/**
 * Description of Produto
 *
 * @author Administrador
 */
class Produto extends \Alfa\Dao\Entidade {

    private $id;
    private $descricao;
    private $grupo;
    private $valor;

    public function __construct(\Alfa\Abstracao\BaseDeDados $baseDeDados) {
        parent::__construct($baseDeDados);
        $this->setNomeTabela("produto");
    }

    public function toArray() {
        return array(
            'descricao' => $this->descricao,
            'grupo' => $this->grupo,
            'valor' => $this->valor,
        );
    }

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getGrupo() {
        return $this->grupo;
    }

    function getValor() {
        return $this->valor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

}
