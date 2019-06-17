<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />

            <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<title>One Profil</title>
<body>
<header>
    <a href="/Sorcier_Twitter/logout">Déconnexion</a>
</header>
<h1> <?= $params['profil']->getUserName(); ?></h1>
<form action="/Sorcier_Twitter/follow/<?php echo $params['profil']->getId();?>" method="post">
    <button type="submit" name="submit-follow">Follow</button>
</form>
<div>
    <?php foreach ($params['tweet'] as $tweet) : ?>
        <tr>
            <p><?php echo $tweet['contenu'];echo " "; echo $tweet['date']?>  </p>
            <p><?php echo $tweet['nom_utilisateur'];echo " "; echo $tweet['nb_retweet'];?> </p>
            <form action="/Sorcier_Twitter/retweet/<?php echo $tweet['id'];?>" method="post">
                <button type="submit" name="submit-retweet">Retweet</button>
            </form>
            <p></br></p>
        </tr>
    <?php endforeach; ?>
</div>

<a href="/Sorcier_Twitter/myProfil/<?php echo $_SESSION['uId']; ?>" >
    Back to profil
</a> </br>
<a href="/Sorcier_Twitter/profils">
    All profils
</a>
</body>
</html>
