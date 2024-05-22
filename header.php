<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Refuge Des Cœurs</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <div id="header">
        <div id="mainTitle">
            <img src="./images/logo.png" >
            <h1>Refuge Des Cœurs</h1>
        </div>
        

        <div id="menu">
            <a href="index.php">Accueil</a>
            <a href="propos.php">A propos</a>
            <a href="#site-footer">Nous contacter</a>
            <?php
            if (!isset($_SESSION['user'])) {
                echo "<a href='login.php' class='right'>Se connecter</a>";
            } else {
                echo "<div id='userNameContainer' class='right'>";
                echo "<div id='userName'>";
                echo "<svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16' id='profileLogo'>
                        <path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z'/>
                      </svg>";
                echo "<a href='profile.php'>" . ($_SESSION['name']) . "</a>";
                echo "</div>";
                echo "<a href='logout.php' class='right'>Déconnexion</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    
</body>
</html>
