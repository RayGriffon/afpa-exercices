<?php
include ("classes/Employe.class.php");
include ("classes/Magasin.class.php");

$magasin1 = new Magasin("Boutique1", "rue des cêpes", 83000, "Draguignan", false);
$magasin2 = new Magasin("Boutique2", "impasse des chênes", 34000, "Montpellier", true);

$employe1 = new Employe("Dupont", "Jean", "2010-01-01", "Comptable", 30, "Comptabilité", $magasin1, [1,2]);
$employe2 = new Employe("Martin", "Pierre", "2012-06-30", "Vendeur", 25, "Commercial", $magasin1, null);
$employe3 = new Employe("Durand", "Lucie", "2008-12-15", "Responsable RH", 40, "Ressources Humaines", $magasin1, [14,19,25,1]);
$employe4 = new Employe("Lefebvre", "Anne", "2015-03-20", "Assistant de direction", 27, "Direction", $magasin2, [4,17]);
$employe5 = new Employe("Leclerc", "Paul", "2005-09-01", "Directeur des ventes", 60, "Commercial", $magasin2, [5]);


$employe1->get_magasin()->modeRestauration();
$employe2->get_magasin()->modeRestauration();
$employe3->get_magasin()->modeRestauration();
$employe4->get_magasin()->modeRestauration();
$employe5->get_magasin()->modeRestauration();

$employe2->montantChequeNoel();
?>