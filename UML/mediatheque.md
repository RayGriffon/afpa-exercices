Les différents acteurs du cas médiathèque:

-Usager (lecteur)
-Employé
-Bénévole

Les différents cas d'usage

-L'usager peur consulter la liste des documents
-L'usager peut constuler un CD-ROM
-L'employé peur référencer des emprunts
-L'employé peut inscrire de nouveaux usagers (lecteur)
-L'employé peut enregistrer de nouveau document
-Le bénévole peut référencer des emprunts
-L'employé peut mettre à jour les fiches lecteurs et mettre hors service un document qui a été perdu ou volé
-L'employé peut consulter les états des lecteurs

1. Description :

    Ce cas d'utilisation permet de saisir les informations concernant l'emprunt d'une ressource.

2. Flux d'évènements
    a. Conditions
        L'usager doit être enregistré dans le système (avoir une carte de lecteur)
        Un employé ou un bénévole peut enregistrer l'emprunt
        L'usager ne peut pas emprunter plus de 5 ressources simultanément.
        L'usager doit verser une caution.

    b. Résultats
        L'emprunt est enregistré.

3. Flot Nominal
    L'usager se présente au guichet.
    L'usager présente sa carte de lecteur.
    L'usager a moins de 5 ressources empruntées.
    L'usager ne peut emprunter que s'il a payé sa cotisation
    Si la ressource est un CD-ROM:
        L'usager doit verser une caution
    Si la ressource est un microfilm:
        L'employé vérifie s'il y a un écran libre
    L'employé ou un le bénévole peut enregistrer l'emprunt dans le système.

4. Flot Alternatifs
    a. L'usager n'a pas de carte de lecteur
        L'employé enregistre l'usager dans le système
        Une fois cette action menée, l'emprunt peut reprendre

    b. L'usager a plus de 5 ressources empruntés simultanément.
        Si l'usager rend une ressource, l'emprunt peut reprendre.
        Sinon, fin de l'emprunt.
    
    c. L'usager n'a pas payé sa cotisation
        L'usage paie sa cotisaion, l'emprunt peut reprendre
        Sinon, fin de l'emprunt.

    d. L'usager ne verse pas de caution.
        Fin de l'emprunt.

    e. Il n'y a pas d'écran libre
        Fin de l'emprunt.