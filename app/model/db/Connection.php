<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author pedro
 */
class Connection {
    
    private $dbLink;
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    
    public function __construct ($dbHost, $dbUser, $dbPass, $dbName) {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
    }

    public function getDbLink() {
        return $this->dbLink;
    }

    public function getDbHost() {
        return $this->dbHost;
    }

    public function getDbUser() {
        return $this->dbUser;
    }

    public function getDbPass() {
        return $this->dbPass;
    }

    public function getDbName() {
        return $this->dbName;
    }

    public function setDbLink($dbLink) {
        $this->dbLink = $dbLink;
    }

    public function setDbHost($dbHost) {
        $this->dbHost = $dbHost;
    }

    public function setDbUser($dbUser) {
        $this->dbUser = $dbUser;
    }

    public function setDbPass($dbPass) {
        $this->dbPass = $dbPass;
    }

    public function setDbName($dbName) {
        $this->dbName = $dbName;
    }

    public function connect() {
        
        $this->dbLink = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
        if (!$this->dbLink) {
            die ('Erro ao tentar conectar ao banco de dados: ' . mysql_error());
        }
        
        $dbSelect = mysql_select_db($this->dbName, $this->dbLink);
        if (!$dbSelect) {
            die ('Erro ao tentar selecionar o banco de dados: ' . mysql_error());
        }
    }
    
    public function perfQuery ($query) {
        
        return mysql_query($query);
    }
}
