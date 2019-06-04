<!-- ~/php/tp1/view/city.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>One Profil</title>
    <body>
    <h1> <?= $params['profil']->getUserName(); ?></h1>
        <p>
            Name : <?= $params['profil']->getNom(); ?> <?= $params['profil']->getPrenom(); ?> </br>
			Age : <?= $params['profil']->getAge(); ?>
        </p>
        <p>
            Type de Magie: <?= $params['profil']->getTypeOfMagic(); ?>
        </p>
        <p>
            House: <?= $params['profil']->getHouse(); ?>
        </p>

        <a href="/tpalixmatt">
            Back to timeline
        </a> </br>
		<a href="/tpalixmatt/profils">
            All profils
        </a>
    </body>
</html>