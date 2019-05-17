<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>All Countries</title>
    <body>
    <h1>All Countries</h1>
    <table>
        <?php foreach ($params['countries'] as $country) : ?>
        <tr>
            <td><a href="/Test/countries/country/<?= $country['country']; ?>"><?=
            $country['country']; ?></a></td>
        </tr>
        
        <?php endforeach; ?>
    </table>
    </body>
</html>