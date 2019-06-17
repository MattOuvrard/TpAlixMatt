<!-- ~/php/tp1/view/city.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />

            <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <title>One Profil</title>
    <body>
    <h1> <?= $params['profil']->getUserName(); ?></h1>
        <p>
        </p>
    <div class="tweet-page">
        <form action="/Sorcier_Twitter/tweet" method="post">
            <input type="text" name="tweet" placeholder="Type here">
            <button type="submit" name="submit-tweet">Tweet</button>
        </form>
    </div>
    <div>

    </div>

        <a href="/Sorcier_Twitter">
            Back to timeline
        </a> </br>
		<a href="/Sorcier_Twitter/profils">
            All profils
        </a>
    </body>
</html>
