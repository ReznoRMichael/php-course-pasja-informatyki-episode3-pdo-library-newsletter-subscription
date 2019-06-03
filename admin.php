<?php
session_start();

if(isset($_SESSION['logged_id']))
{
	header('Location: list.php');
	exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="description" content="PDO usage - reading from MySQL database">
    <meta name="keywords" content="php, course, PDO, connection, MySQL">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <script src="cookiealert/cookiealert_1_2.js"></script><script>CookieAlert.init();</script>
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <header>
            <h1>Admin</h1>
        </header>

        <main>
            <article>
                <form method="post" action="list.php">
                    <label>Login <input type="text" name="login" <?= isset($_SESSION['given_login']) ? 'value="'.$_SESSION['given_login'].'"' : '' ?> ></label>
                    <label>Password <input type="password" name="pass"></label>
                    <label><input type="checkbox" name="guest"> Log in as Guest</label>
                    <input type="submit" value="Log in!">
					
					<?php
					
						if(isset($_SESSION['bad_attempt']))
						{
							echo '<p>Invalid username or password.</p>';
							unset($_SESSION['bad_attempt']);
							unset($_SESSION['given_login']);
						}
					
					?>
                </form>

                <p><a href="index.php"><button>Back to subscribe page</button></a></p>

            </article>
        </main>

    </div>
</body>
</html>