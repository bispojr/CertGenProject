<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registered
 *
 * @author pedro
 */
class Registered {
    
    private $id;
    private $name;
    private $type;
    
    public function __construct($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setType($type) {
        $this->type = $type;
    }
    
    public function makeForm () {
        
        return '<form method="post" action="app/model/Certificate.php">'
                . '<input name="id" type="hidden" value="' . $this->getId() . '">'
                . '<input name="nome" type="hidden" value="' . $this->getName() . '">'
                . '<input name="tipo" type="hidden" value="' . $this->getType() . '">'
                . '<button type="submit" class="btn btn-default">Gerar</button>'
                . '</form>';
    }
}
