<!-- ~/php/tp1/view/city.php -->

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>One city</title>
    <body>
    <h1>City <?= $params['city']['name']; ?></h1>
        <p>
            Name of the city: <?= $params['city']['name']; ?>
        </p>
        <p>
            Country: <?= $params['city']['country']; ?>
        </p>
        <p>
            Quality of life: <?= $params['city']['life']; ?>
        </p>

        <a href="/tp1_php/">
            Back to list of cities
        </a>
    </body>
</html>