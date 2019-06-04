<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>All profils</title>
    <body>
    <h1>All Profils</h1>
    <?php if(isset($params['flash'])) {
        echo "
           <p style='color: green'>
            " . $params['flash'] . " 
           </p>
        ";
    } ?>
    <table>
        <?php foreach ($params['profils'] as $profil) :  ?>
        <tr>
			
            <td><a href="/tpalixmatt/profil/<?php echo $profil["id"];?>">
			<?= $profil["nom_utilisateur"]; ?></a></td>
            <td><?= $profil["age"]; ?></td>
            <td>House: <?= $profil["maison"]; ?></td> <!--added property life-->
        </tr>
        
        <?php endforeach; ?>

    </table>
    <p>
        <a href="">Mon profils</a>
    </p>
    <p>
        <a href="/tpalixmatt/">Ma Timeline</a>
    </p>

    </body>
</html>