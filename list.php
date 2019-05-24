<?php
session_start();

require_once 'database.php';

if(!isset($_SESSION['logged_id'])) // jesli nie jestesmy aktualnie zalogowani
{
	if(isset($_POST['login']) && !isset($_POST['guest']))
	{
		$login = filter_input(INPUT_POST, 'login'); // pobranie i zapisanie wartosci z input login - admin.php
		$password = filter_input(INPUT_POST, 'pass'); // pobranie i zapisanie wartosci z input pass - admin.php
		
		//echo $login." ".$password;
		
		$userQuery = $db -> prepare('SELECT id, password FROM reznor_newsletter_admins WHERE login = :login'); // przygotowanie zapytania SQL
		$userQuery -> bindValue(':login', $_POST['login'], PDO::PARAM_STR); // przypisanie wartosci do etykiety :login
		$userQuery -> execute();
		
		//echo $userQuery -> rowCount();
		
		$user = $userQuery -> fetch(); // pobranie danych z bazy danych i zapisanie ich w tablicy asocjacyjnej
		
		//echo $user['id']. "<br>". $user['password'];
		
		if ($user && password_verify($password, $user['password']) ) // jesli login i haslo sa poprawne
		{
			$_SESSION['logged_id'] = $user['id'];
			unset($_SESSION['bad_attempt']);
		}
		else // jesli logowanie sie nie powiodlo
		{
			$_SESSION['bad_attempt'] = true;
			$_SESSION['given_login'] = $_POST['login'];
			header('Location: admin.php');
			exit();
		}
	}
	else if(isset($_POST['guest']))
	{
		$userQuery = $db -> prepare('SELECT id FROM reznor_newsletter_admins WHERE login = :login'); // przygotowanie zapytania SQL
		$userQuery -> bindValue(':login', "adam", PDO::PARAM_STR); // przypisanie wartosci do etykiety :login
		$userQuery -> execute();

		$user = $userQuery -> fetch();

		$_SESSION['logged_id'] = $user['id'];
		unset($_SESSION['bad_attempt']);
	}
	else
	{
		header('Location: admin.php');
		exit();
	}
}

$usersQuery = $db -> query('SELECT * FROM reznor_newsletter_users');
$users = $usersQuery -> fetchAll();

// echo $users;
// print_r( $users );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="description" content="PDO usage - reading from MySQL database">
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
			
				<table>
					<thead>
						<tr><th colspan="2">Total records: <?= $usersQuery->rowCount() ?></th></tr>
						<tr><th>ID</th>  <th>E-mail</th></tr>
					</thead>
					<tbody>
						<?php
						
							// typ pętli do użytku "dla kazdego z" (bez iteratora); $users = nazwa tablicy, $user = pomocniczy bufor/zmienna
							foreach($users as $user)
							{
								echo "<tr><td>{$user['id']}</td><td>{$user['email']}</td></tr>";
							}
						
						?>
					</tbody>
				</table>
				
				<p><a href="logout.php"><button>Log out</button></a></p>
  
            </article>
        </main>

    </div>

</body>
</html>