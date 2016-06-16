<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Sao_Paulo");
error_reporting(E_ALL);
require_once '../autoload.php';

try {
    $srv = new \Alfa\Dao\SGBD();
    $srv->setEndereco("localhost");
    $srv->setPorta(3306);
    $srv->setUsuario("root");
    $srv->setSenha("");
    $db = new \Alfa\Dao\BaseDeDados($srv, "test");
    $p = new Alfa\Entity\Produto($db);
    $p->setDescricao("Produto ABC");
    $p->setGrupo("GRUPO A");
    $p->setValor(22.5);
    $p->create();

    $y = clone $p;
    $y->create();

    $x = clone $y;

    $y->setDescricao("Produto y");
    $y->create();

    $p->setDescricao("Descrição Nova");
    $c = new Alfa\Dao\Clausula();
    $c->add("id", Alfa\Dao\Clausula::IGUAL, 28);
    $p->update($c);


    var_dump($p->retrieve($c));
    
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}


