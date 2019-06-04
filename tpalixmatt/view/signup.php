<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>
<body>

<header>
    <nav>
        <div class="signup-welcome-page">
            <ul>
                <li href="signup.php">Create your account<a></a></li>
            </ul>
            </div>
        </div>
    </nav>
</header>

<section>
    <div class="signup-creation-page">
        <h2>Signup</h2>
        <form class="signup-form" action="../Includes/signup.inc.php" method="post">
            <input type="text" name="lastname" placeholder="Lastname">
            <input type="text" name="firstname" placeholder="Firstname">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit">Sign up</button>
        </form>
        <a href="/tpalixmatt">Home page</a>
    </div>
</section>

</body>
</html>
