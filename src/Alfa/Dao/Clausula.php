<?php

namespace Alfa\Dao;

/**
 * Classe para abstração dos clausula
 *
 * @author Adriano
 */
class Clausula {

    const IGUAL = '=';
    const MAIOR_QUE = '>';
    const MENOR_QUE = '<';
    const MENOR_IGUAL = '<=';
    const MAIOR_IGUAL = '>=';
    const LIKE = 'like';
    const ENTRE = 'in';
    const FORA = 'not in';
    const E_CRITERIO = 'AND';
    const OU_CRITERIO = 'OR';
    const CRESCENTE = "ASC";
    const DECRESCENTE = "DESC";

    private $criterios = null;
    private $ordenacao = null;
    private $limitacao = null;
    private $groupBy = null;

    public function setCriterios($criterios) {
        $this->criterios = $criterios;
    }

    public function getCriterios() {
        return $this->criterios;
    }

    public function add($campo, $operador, $valor, $relacaoComAnterior = self::E_CRITERIO, $parenteses = false) {
        if ($this->criterios == null) {
            if ($operador == 'in') {
                if ($parenteses) {
                    $this->criterios = " WHERE ( {$campo} {$operador} {$valor} ) ";
                } else {
                    $this->criterios = " WHERE {$campo} {$operador} {$valor} ";
                }
            } else {
                if ($parenteses) {
                    $this->criterios = " WHERE ( {$campo} {$operador} '{$valor}' ) ";
                } else {
                    $this->criterios = " WHERE {$campo} {$operador} '{$valor}' ";
                }
            }
        } else {
            if ($operador == 'in') {
                if ($parenteses) {
                    $this->criterios.=" {$relacaoComAnterior} ( {$campo} {$operador} {$valor} ) ";
                } else {
                    $this->criterios.=" {$relacaoComAnterior} {$campo} {$operador} {$valor} ";
                }
            } else {
                if ($parenteses) {
                    $this->criterios.=" {$relacaoComAnterior} ( {$campo} {$operador} '{$valor}' ) ";
                } else {
                    $this->criterios.=" {$relacaoComAnterior} {$campo} {$operador} '{$valor}' ";
                }
            }
        }
    }

    public function addOrdem($campo, $ordem = self::CRESCENTE) {
        if ($this->ordenacao == null) {
            $this->ordenacao = " ORDER BY {$campo} {$ordem} ";
        } else {
            $this->ordenacao.=" , {$campo} {$ordem} ";
        }
    }

    public function addGroup($campo) {
        if ($this->groupBy == null) {
            $this->groupBy = " GROUP BY {$campo} ";
        } else {
            $this->groupBy.=" , {$campo} ";
        }
    }

    public function addLimitacao($inicio, $fim) {
        $this->limitacao = " LIMIT {$inicio}, {$fim} ";
    }

    public function serializar() {
        $res = $this->criterios;
        if ($this->ordenacao) {
            $res.= $this->ordenacao;
        }
        if ($this->limitacao) {
            $res.= $this->limitacao;
        }
        if ($this->groupBy) {
            $res.= $this->groupBy;
        }
        return $res;
    }

}
