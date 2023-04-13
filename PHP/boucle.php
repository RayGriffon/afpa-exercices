<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <table border="1">
        <thead>
            <tr>
                <th>0</th>
                <?php for ($i = 1; $i <= 9; $i++) { ?>
                    <th><?php echo $i; ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 9; $i++) { ?>
                <tr>
                    <th><?php echo $i; ?></th>
                    <?php for ($j = 1; $j <= 9; $j++) { ?>
                        <td><?php echo $i * $j; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php

    for ($i = 0; $i < 151; $i++) {
        if ($i % 2 != 0) {
            echo $i . " ";
        };
    };

    for ($i = 0; $i < 501; $i++) {
        echo " Je dois faire des sauvegardes régulières de mes fichiers";
    };

    ?>


</body>

</html>