<?php

namespace Alfa\Abstracao;

interface Entidade {

    public function setNomeTabela($nome);

    public function getNomeTabela();

    public function create();

    public function retrieve(\Alfa\Dao\Clausula $clausula);

    public function update(\Alfa\Dao\Clausula $clausula);

    public function delete(\Alfa\Dao\Clausula $clausula);
}
