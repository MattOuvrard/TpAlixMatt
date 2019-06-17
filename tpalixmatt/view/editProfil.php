<!-- ~/php/tp1/view/city.php -->
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
<title>Edit profil</title>
<body>
<div>
<header class="bleu">
  <nav class="navig_class">
    <a class="bouton_nav" href="/Sorcier_Twitter/logout">Déconnexion</a>
    <form class="bouton_nav" action="/Sorcier_Twitter/search" method="post">
        <input type="text" name="search" placeholder="Search">
        <button type="submit" name="submit-search">Go</button>
    </form>
  </nav>

      <p><?php echo $params['profil']->getDescription()?></p>
      <form class="form_tweet" action="/Sorcier_Twitter/editDescription/<?php echo $params['profil']->getId()?>" method="post">
          <input type="text" name="description" placeholder="Description">
          <button type="submit" name="submit-edit">Edit</button>
      </form>

      <p><?php echo $params['profil']->getHouse()?></p>

      <form  class="form_tweet" action="/Sorcier_Twitter/editHouse/<?php echo $params['profil']->getId()?>" method="post">
        <select name="house">

        <option  value="Griffondor">Griffondor</option>
        <option  value="Poufsoufle">Poufsoufle</option>
        <option value="Serdaigle">Serdaigle</option>
        <option value="Serpentard">Serpentard</option>
      </select>
        <!--  <input type="text" name="house" placeholder="House">-->
          <button type="submit" name="submit-edit">Edit</button>
      </form>
    </header>

</div>
<footer>
<a href="/Sorcier_Twitter/myProfil/<?php echo $_SESSION['uId']; ?>" >
    Back to profil
</a> </br>
<a href="/Sorcier_Twitter/profils">
    All profils
</a>
</footer>
</body>
</html>
