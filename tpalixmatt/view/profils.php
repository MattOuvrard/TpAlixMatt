<!-- ~/php/tp1/view/cities.php -->
<style>
<?php include 'style1.css'; ?>
</style>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />

            <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <title>All profils</title>
    <body>
      <footer>
        <nav class="navig_class">
          <a class="bouton_nav" href="/Sorcier_Twitter/logout">Déconnexion</a>
          <form class="bouton_nav" action="/Sorcier_Twitter/search" method="post">
              <input type="text" name="search" placeholder="Search">
              <button type="submit" name="submit-search">Go</button>
          </form>
        </nav>
        </footer>
    <h1>All Profils</h1>
    <?php if(isset($params['flash'])) {
        echo "
           <p style='color: green'>
            " . $params['flash'] . "
           </p>
        ";
    } ?>
    <table class="description">
        <?php foreach ($params['profils'] as $profil) :  ?>
        <tr>

            <td><a href="/Sorcier_Twitter/otherProfil/<?php echo $profil["id"];?>">
			<?= $profil["nom_utilisateur"]; ?></a></td>
            <td>House: <?= $profil["maison"]; ?></td> <!--added property life-->
        </tr>

        <?php endforeach; ?>

    </table>
    <footer>
    <p>
        <a href="/Sorcier_Twitter/myProfil/<?php echo $_SESSION['uId']; ?>">Mon profils</a>
    </p>
    </footer>
    </body>
</html>
