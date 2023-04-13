<?php
    echo "Nous somme le ". date("d/m/Y"). " et il est exactement " . date("H:i:s") . "<br>";

    echo "<h1> Exo 1 : Trouvez le numéro de semaine de la date suivante : 14/07/2019. </h1>";

    $date1 = new DateTime("14-07-2019");
    echo $date1->format("W");

    echo "<h1> Exo 2 : Combien reste-t-il de jours avant la fin de votre formation. </h1>";
    
    function jours_restants_janvier_2024() {
        $date_cible = new DateTime("2024-01-20"); // Date cible (20 janvier 2024)
        $aujourdhui = new DateTime(); // Date d'aujourd'hui
        $interval = $date_cible->diff($aujourdhui); // Différence entre les deux dates
        $jours_restants = $interval->days; // Nombre de jours restants
        return $jours_restants;
    }
    
    echo "Il reste " . jours_restants_janvier_2024() . " jours avant le 20 janvier 2024.";

    echo "<h1> Exo 3 : Comment déterminer si une année est bissextile ? </h1>";

    function est_bissextile($annee) {
        $date = new DateTime("$annee-01-01"); // Création d'un objet DateTime pour le 1er janvier de l'année donnée
        $annee_bissextile = $date->format("L"); // Formatage de l'année pour récupérer un booléen (1 si bissextile, 0 sinon)
        return $annee_bissextile;
    }
    
    // Utilisation de la fonction pour déterminer si 2024 est bissextile
    if (est_bissextile(2025)) {
        echo "L'année 2024 est bissextile.";
    } else {
        echo "L'année 2024 n'est pas bissextile.";
    }

?>