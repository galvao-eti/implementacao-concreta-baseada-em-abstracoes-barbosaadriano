<?php

namespace Alfa\Dao;

/**
 * Description of Entidade
 *
 * @author Administrador
 */
abstract class Entidade implements \Alfa\Abstracao\Entidade {

    private $nomeTabela;

    /**
     *
     * @var BaseDeDados 
     */
    private $baseDeDados;

    function __construct(\Alfa\Abstracao\BaseDeDados $baseDeDados) {
        $this->baseDeDados = $baseDeDados;
    }

    public function create() {
        $cols = implode("`,`", array_keys($this->toArray()));
        $vals = implode("','", array_values($this->toArray()));
        $sql = "insert into {$this->getNomeTabela()} (`{$cols}`) values ('{$vals}')";
        try {
            $this->query($sql);
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function delete(Clausula $clausula) {
        $sql = "delete from {$this->getNomeTabela()} " . $clausula->serializar();
        try {
            $this->query($sql);
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function retrieve(Clausula $clausula) {
        $cols = implode("`,`", array_keys($this->toArray()));
        $sql = "select `{$cols}` from {$this->getNomeTabela()} " . $clausula->serializar();
        try {
            return $this->query($sql);
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    public function update(Clausula $clausula) {
        $tmp = "";
        $valores = array_values($this->toArray());
        $colunas = array_keys($this->toArray());
        foreach ($colunas as $k => $v) {
            $tmp.="`$v`='{$valores[$k]}', ";
        }
        $tmp = rtrim($tmp, ", ");
        $sql = "update {$this->getNomeTabela()} set {$tmp} " . $clausula->serializar();
        try {
            $this->query($sql);
        } catch (\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }

    function getNomeTabela() {
        return $this->nomeTabela;
    }

    function setNomeTabela($nomeTabela) {
        $this->nomeTabela = $nomeTabela;
    }

    /**
     * 
     * @param string $sql
     * @return array
     * @throws \Exception
     */
    protected function query($sql) {
        $con = $this->baseDeDados->conectar();
        $con->beginTransaction();
        $sth = $con->prepare($sql);
        try {
            $sth->execute();
            $con->commit();
        } catch (\Exception $exc) {
            $con->rollBack();
            throw new \Exception("Erro ao executar comando! Detalhes:" . $exc->getMessage() . " - " . $sql);
        }
        if ($sth->rowCount() > 0) {
            return $sth->fetchAll();
        } else {
            return array();
        }
    }

    abstract function toArray();
}
