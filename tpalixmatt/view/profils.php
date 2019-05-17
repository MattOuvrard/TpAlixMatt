<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>Profils</title>
    <body>
    <h1><?= $params['profils']->getUserName(); ?></h1>
        <p>
            Nom: <?= $params['profils']->getNom(); ?> </br>
			Prenom: <?=$params['profils']->getPrenom();?>
        </p>
        <p>
            Type de magie: <?= $params['profils']->getTypeOfMagic(); ?>
        </p>
        <p>
            Maison: <?= $params['profils']->getHouse(); ?>
        </p>

        <a href="/../Test/">
            Back to Timeline
        </a>
    </body>
</html>