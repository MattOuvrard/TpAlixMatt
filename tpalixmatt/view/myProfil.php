<!-- ~/php/tp1/view/city.php -->
<style>
<?php include 'style1.css'; ?>
</style>
<!DOCTYPE HTML>
<html>
    <head>
        <!--<meta http-equiv="content-type" content="text/html;charset=utf-8" />-->
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style1.css" type="text/css"/>
        <title>One Profil</title>
    </head>

    <body>
    <header>
      <nav class="navig_class">
        <a class="bouton_nav" href="/Sorcier_Twitter/logout">Déconnexion</a>
        <form class="bouton_nav" action="/Sorcier_Twitter/search" method="post">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" name="submit-search">Go</button>
        </form>
      </nav>

<div class="centreHead">
  <h1> <?= $params['profil']->getUserName(); ?></h1>
  <a href="/Sorcier_Twitter/editProfil/<?php echo $params['profil']->getId()?>">Edit profil</a>
  <p></br></p>
  <a href="/Sorcier_Twitter/profils">All profils</a>
  <p></br></p>
  <cite>HogWard NetWork</cite>
  <!--<img src="/Sorcier_Twitter/house/<?php// echo $params['profil']->getHouse();?>" alt="House <?php //echo $params[profil]->getHouse();?>"/>-->
</div>
    </header>


  <div class="Corps_site">
<aside class="description">
  <h2>Profil : </h2>
  <p><?php echo $params['profil']->getUserName();?></p>
  <p></br></p>
  <h2>Description : </h2>
  <p><?php echo $params['profil']->getDescription(); ?></p>
  <p></br></p>
  <h2>House : </h2>
  <p><?php echo $params['profil']->getHouse(); ?></p>
  <p></br></p>
</aside>

    <section id="les_tweet">
    <div class="tweet-page">
        <form action="/Sorcier_Twitter/tweet" method="post">
            <input type="text" name="tweet" placeholder="Type here" class="form_tweet">
            <button type="submit" name="submit-tweet">Tweet</button>
        </form>
    </div>

    <div>
        <?php foreach ($params['tweet'] as $tweet) : ?>
        <div class="mes_tweets">
            <p class="form_tweet"><?php echo $tweet['contenu']?> </p>
            <p></br></p>
            <p><?php  echo $tweet['date']?>  </p>
            <p><?php echo $tweet['nom_utilisateur'];echo " "; echo $tweet['nb_retweet'];?> </p>
            <form action="/Sorcier_Twitter/retweet/<?php echo $tweet['id'];?>" method="post">
                <button type="submit" name="submit-retweet">Retweet</button>
            </form>
            <p></br></p>
        </div>
        <?php endforeach; ?>
    </div>
  </section>
  </div>

    </body>
</html>
