<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // Tableau associatif avec le nombre de jours de chaque mois
    $mois = array(
        "Janvier" => 31,
        "Février" => 28,
        "Mars" => 31,
        "Avril" => 30,
        "Mai" => 31,
        "Juin" => 30,
        "Juillet" => 31,
        "Août" => 31,
        "Septembre" => 30,
        "Octobre" => 31,
        "Novembre" => 30,
        "Décembre" => 31
    );

    // Tri du tableau par ordre croissant de nombre de jours
    asort($mois);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>Mois</th>
                <th>Nombre de jours</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mois as $nomMois => $nbJours) { ?>
                <tr>
                    <td><?php echo $nomMois; ?></td>
                    <td><?php echo $nbJours; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php

    $capitales = array(
        "Bucarest" => "Roumanie",
        "Bruxelles" => "Belgique",
        "Oslo" => "Norvège",
        "Ottawa" => "Canada",
        "Paris" => "France",
        "Port-au-Prince" => "Haïti",
        "Port-d'Espagne" => "Trinité-et-Tobago",
        "Prague" => "République tchèque",
        "Rabat" => "Maroc",
        "Riga" => "Lettonie",
        "Rome" => "Italie",
        "San José" => "Costa Rica",
        "Santiago" => "Chili",
        "Sofia" => "Bulgarie",
        "Alger" => "Algérie",
        "Amsterdam" => "Pays-Bas",
        "Andorre-la-Vieille" => "Andorre",
        "Asuncion" => "Paraguay",
        "Athènes" => "Grèce",
        "Bagdad" => "Irak",
        "Bamako" => "Mali",
        "Berlin" => "Allemagne",
        "Bogota" => "Colombie",
        "Brasilia" => "Brésil",
        "Bratislava" => "Slovaquie",
        "Varsovie" => "Pologne",
        "Budapest" => "Hongrie",
        "Le Caire" => "Egypte",
        "Canberra" => "Australie",
        "Caracas" => "Venezuela",
        "Jakarta" => "Indonésie",
        "Kiev" => "Ukraine",
        "Kigali" => "Rwanda",
        "Kingston" => "Jamaïque",
        "Lima" => "Pérou",
        "Londres" => "Royaume-Uni",
        "Madrid" => "Espagne",
        "Malé" => "Maldives",
        "Mexico" => "Mexique",
        "Minsk" => "Biélorussie",
        "Moscou" => "Russie",
        "Nairobi" => "Kenya",
        "New Delhi" => "Inde",
        "Stockholm" => "Suède",
        "Téhéran" => "Iran",
        "Tokyo" => "Japon",
        "Tunis" => "Tunisie",
        "Copenhague" => "Danemark",
        "Dakar" => "Sénégal",
        "Damas" => "Syrie",
        "Dublin" => "Irlande",
        "Erevan" => "Arménie",
        "La Havane" => "Cuba",
        "Helsinki" => "Finlande",
        "Islamabad" => "Pakistan",
        "Vienne" => "Autriche",
        "Vilnius" => "Lituanie",
        "Zagreb" => "Croatie"
    );

    ksort($capitales);

    ?>

    <?php foreach ($capitales as $nomcapitales => $pays) { ?>
        <tr>
            <td><?php echo $nomcapitales; ?></td>
            <td><?php echo $pays."<br>"; ?></td>
        </tr>
    <?php } ?>

    <?php

    asort($capitales);

    ?>
    <br><br>

    <?php foreach ($capitales as $nomcapitales => $pays) { ?>
        <tr>
            <td><?php echo $pays; ?></td>
            <td><?php echo $nomcapitales."<br>"; ?></td>

        </tr>
    <?php } ?>

    <p>Il y a <?php echo count($capitales) ?> pays dans le tableau </p>

    <?php

        foreach ($capitales as $nomcapitales => $pays){
            if(str_starts_with($nomcapitales, 'B')){?>
        <tr>
            <td><?php echo $pays; ?></td>
            <td><?php echo $nomcapitales."<br>"; ?></td>

        </tr><?php
            };
        };

    ?>


</body>

</html>