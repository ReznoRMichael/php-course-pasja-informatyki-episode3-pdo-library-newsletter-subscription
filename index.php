<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Newsletter - subscribe!</title>
    <meta name="description" content="PDO usage - saving into MySQL database">
    <meta name="keywords" content="php, course, PDO, connection, MySQL">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <script src="cookiealert/cookiealert_1_2.js"></script><script>CookieAlert.init();</script>
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container">

        <header>
            <h1>Newsletter</h1>
        </header>

        <main>
            <article>
                <form method="post" action="save.php">
                    <label>Input your e-mail address
                        <input type="email" name="email" <?= isset($_SESSION['given_email']) ? 'value="'.$_SESSION['given_email'].'"' : '' ?>
						<?= isset($_SESSION['given_email_exists']) ? 'value="'.$_SESSION['given_email_exists'].'"' : '' ?> >
						<!-- skrocony zapis warunku w php -->
                    </label>
                    <div class="g-recaptcha" data-sitekey="6Lc4UKUUAAAAADdrV0fml7TbDEn7DS_Ta359-txn"></div><br>
                    <input type="submit" value="Subscribe!">
					
					<?php
					
						if(isset($_SESSION['given_email']))
						{
							echo '<p>This is not a valid e-mail address.</p>';
							unset($_SESSION['given_email']);
						}
                        if(isset($_SESSION['given_email_exists']))
                        {
                            echo '<p>This address already exists in the database.<br>Please input another e-mail address.</p>';
                            unset($_SESSION['given_email_exists']);
                        }
                        if(isset($_SESSION['e_bot']))
                        {
                            echo '<p>Please confirm that you are not a bot.</p>';
                            unset($_SESSION['e_bot']);
                        }
					?>
					
                </form>

                <p><a href="admin.php"><button>Admin Panel</button></a></p>
            </article>
        </main>

    </div>
</body>
</html>