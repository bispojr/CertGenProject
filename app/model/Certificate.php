<?php

require_once '../../fpdf/fpdf.php';
require_once '../../fpdi/fpdi.php';
$c = new Certificate();
$c->makeCert();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificate
 *
 * @author pedro
 */
class Certificate {
    
    private $id;
    private $name;
    private $type;
    private $date;
    
    public function __construct() {
        $this->init();
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
    
    public function getDate() {
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
    
    public function setDate($date) {
        $this->date = $date;
    }
    
    private function init() {
        
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setName(filter_input(INPUT_POST, 'nome'));
        $this->setType(filter_input(INPUT_POST, 'tipo'));
        $this->setDate(filter_input(INPUT_POST, 'data'));
    }

    public function makeCert() {
        
        $pdf = new FPDI();
        
        $pdf->setSourceFile('../../archives/certificateTemplate.pdf');
        $tplIdx = $pdf->importPage(1, '/MediaBox');
        
        $pdf->AddPage('L');        
        $pdf->useTemplate($tplIdx);
        
        $pdf->AddFont('LiberationSans', '', 'liberation.php');
        $pdf->AddFont('LiberationSans-Bold', '', 'liberationb.php');
        
        $pdf->SetXY(38,88);
        
        $pdf->SetFont('LiberationSans', '', 14);
        $str = 'Certificamos que ';
        $str .= mb_strtoupper($this->getName());
        
        if ($this->getType() == 1) {
            $str .= ' participou do "II WORKSHOP E II MOSTRA DE TRABALHOS: '
                    . 'Atualidades e Perspectivas para a Cultura do Milho" '
                    . 'realizado nos dias 20 e 21 de novembro de 2014 pelo '
                    . 'Programa de Pós-Graduação em Agronomia da Universidade '
                    . 'Federal de Goiás - Regional Jataí, perfazendo carga '
                    . 'horária de 16 horas.';
        }
        else {
            $str .= ' foi integrante da comissão organizadora do "II WORKSHOP '
                    . 'E II MOSTRA DE TRABALHOS: Atualidades e Perspectivas '
                    . 'para a Cultura do Milho" realizado nos dias 20 e 21 '
                    . 'de novembro de 2014 pelo Programa de Pós-Graduação '
                    . 'em Agronomia da Universidade Federal de Goiás - '
                    . 'Regional Jataí, perfazendo carga horária de 50 horas.';
        }
        
        $str = utf8_decode($str);
        $pdf->MultiCell(220, 7.5, $str, 0, 'J', 0);
        
        $pdf->SetXY(188,125);
        //setlocale(LC_TIME, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $str = getdate();
        $str = 'Jataí, ' . $str['mday'] . ' de ' . $str['month'] . ' de ' . $str['year'] . '.';
        
        $str = utf8_decode($str);
        $pdf->MultiCell(220, 7.5, $str, 0, 'J', 0);
        
        $pdf->SetFont('LiberationSans', '', 10);
        $pdf->SetXY(38,138);
        $str = 'Código do certificado: ';
        $str = utf8_decode($str);
        $pdf->MultiCell(220, 7.5, $str, 0, 'J', 0);
        
        $pdf->SetFont('LiberationSans', '', 12);
        $pdf->SetXY(73,138);
        //$str = hash('crc32b', $this->getId());
        $str = base64_encode(dechex($this->getId()));
        $str = utf8_decode($str);
        $pdf->MultiCell(220, 7.5, $str, 0, 'J', 0);
        
        $pdf->SetFont('LiberationSans', '', 8);
        $pdf->SetXY(38,144);
        $str = 'A autenticidade do certificado pode ser verificada em: http://www.certificado.com.br';
        $str = utf8_decode($str);
        $pdf->MultiCell(70, 4, $str, 0, 'J', 0);
        
        $pdf->Output();
        
        exit();
    }
}
