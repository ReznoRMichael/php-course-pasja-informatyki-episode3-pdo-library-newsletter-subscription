<?php

session_start();

if (isset($_POST['email'])) // jesli zostal wyslany email
{
	// walidacja danego maila po stronie php
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // 1-zrodlo danych, 2-indeks zmiennej, 3-typ filtra danych
	
	if(empty($email)) // jesli zmienna email to false lub NULL
	{
		$_SESSION['given_email'] = $_POST['email']; // zmienna sesyjna, aby poinformowac usera o blednie wpisanym emailu
		header('Location: index.php');
		exit();
	}

	// Bot or not?
	$secret = require_once 'secret.php';
	$botornot = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
	$botornot_decoded = json_decode($botornot);
	// check = bot or not
	if ($botornot_decoded->success==false)
	{
		$_SESSION['e_bot']="You have not confirmed that you are not a bot.";
		header('Location: index.php');
		exit();
	}
	else
	{
		require_once 'database.php'; // polaczenie z baza danych
		
		$valid_email_query = $db -> query("SELECT * FROM reznor_newsletter_users WHERE email = '{$_POST['email']}'");
		$valid_email = $valid_email_query -> fetch();
		if($valid_email)
		{
			$_SESSION['given_email_exists'] = $_POST['email']; // zmienna sesyjna, aby poinformowac usera o emailu istniejacym w bazie
			header('Location: index.php');
			exit();
		}
		else
		{
			$query = $db -> prepare('INSERT INTO reznor_newsletter_users VALUES (NULL, :email)'); // przygotowanie zapytania z etykietą (dane jeszcze nie zostają zapisane w bazie)
			$query -> bindValue(':email', $email, PDO::PARAM_STR); // przypisz wartosc do etykiety zdefiniowanej wyzej; 1-nazwa etykiety, 2-zmienna z ktorej pobrac, 3-typ zmiennej
			$query -> execute(); // wykonaj zapytanie
			//echo $_POST['email'].'<br>'.$email;
		}
	}
}
else // jesli nie zostal wyslany
{
	header('Location: index.php'); // przekierowanie z powrotem
	exit(); // nie procesujemy dalszej czesci pliku, aby nie obciazac
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Subscribe to the newsletter</title>
    <meta name="description" content="PDO usage - saving into MySQL database">
    <meta name="keywords" content="php, course, PDO, connection, MySQL">

    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">

        <header>
            <h1>Newsletter</h1>
        </header>

        <main>
            <article>
                <p>Thank you for subscribing to our newsletter!</p>
            </article>
        </main>

    </div>

</body>
</html>