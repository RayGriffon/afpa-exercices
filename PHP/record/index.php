<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

    <div class="position-fixed end-0 my-5 mx-5"><a href="add_form.php"><button type="button" class="btn btn-primary btn-sm">Ajouter</button></a></div>
    <?php include "conDisc.php"; ?>
    <div class="container-fluid" style="font-size: x-small;">
        <div class="row">
            <?php foreach ($tableauToutDisc as $disc) : ?>

                <div class="col-6 mt-3">
                    <div class="row">
                    <div class="col-2">
                    <img src="pictures/<?= $disc->disc_picture ?>" width="150px">
                    </div>
                    <div class="col-10 my-3 mt-0">
                    <h5><?= $disc->disc_title ?></h5>
                    <h6><?= $disc->artist_name ?></h6>
                    <p class="mb-0"><b>Label :</b> <?= $disc->disc_label ?></p>
                    <p class="mb-0"><b>Year :</b> <?= $disc->disc_year ?></p>
                    <p class="mb-0"><b>Genre :</b> <?= $disc->disc_genre ?></p>
                    <a href="details.php?id=<?= $disc->disc_id ?>"><button type="button" class="btn btn-primary btn-sm">Détails</button></a>
                    </div></div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>