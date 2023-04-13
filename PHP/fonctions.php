<?php

    function generationLien($lien, $titre){
        echo "<a href=".$lien.">".$titre."</a>";
    };

    function sommeTableau($tab){
        return array_sum($tab);
    };

    function complexiteMotDePasse($mdp){
        $complexe = false;

        if(strlen($mdp)>8 && filter_var($mdp, FILTER_SANITIZE_NUMBER_INT) != null ){
            if(preg_match('/[A-Z]/', $mdp) && preg_match('/[a-z]/', $mdp)){
                $complexe = true;
            };
        };

        return $complexe;
        echo "<p>valeur :".$complexe."</p>";
    };

?>