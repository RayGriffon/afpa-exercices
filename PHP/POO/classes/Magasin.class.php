<?php

class Magasin{

    private $_nom;
    private $_adresse;
    private $_codePostal;
    private $_ville;
    private $_restauration;

    function __construct($_nom,$_adresse,$_codePostal,$_ville, $_restauration)
    {
        $this->_nom=$_nom;
        $this->_adresse=$_adresse;
        $this->_codePostal=$_codePostal;
        $this->_ville=$_ville;
        $this->_restauration=$_restauration;
    }

    function modeRestauration(){
        if ($this->_restauration){
            echo "L'employé mange à la cantine <br>";
        }else{
            echo "L'employé a des tickets resto <br>";
        }
    }


}