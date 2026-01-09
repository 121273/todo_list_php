
<?php 
$dbname = 'todolist';
$username = 'root';
$password = '';
$host = 'localhost';
$port = '3306';


try {
    $todo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset = Utf8mb4",$username, $password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);


} catch (Exception $e) {
    die("erreur de connexion: ".$e->getMessage());
}

?> 