<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>All Cities</title>
    <body>
    <h1>All Cities</h1>
    <?php if(isset($params['flash'])) {
        echo "
           <p style='color: green'>
            " . $params['flash'] . " 
           </p>
        ";
    } ?>
    <table>
        <?php foreach ($params['cities'] as $city) : ?>
        <tr>
            <td><a href="/Test/city/<?php echo $city->getId();?>"><?=
            $city['name']; ?></a></td>
            <td><?= $city->getCountry(); ?></td>
            <td>Quality of life: <?= $city->getLife(); ?></td> <!--added property life-->
        </tr>
        
        <?php endforeach; ?>

    </table>
    <p>
        <a href="/Test/recherche/">Search cities by name</a>
    </p>
    <p>
        <a href="/Test/create/">Create a new city</a>
    </p>
    <p>
        <a href="/Test/countries/">Countries</a>
    </p>

    </body>
</html>