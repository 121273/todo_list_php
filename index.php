<?php 
require_once "connexion.php";

$msg = '';

if($_SERVER["REQUEST_METHOD"] === "POST"){

if($_POST['btn'] === 'insert'){

    $title = trim($_POST['title']) ?? '';
    if(empty($title)){
        $msg = 'un texte vide';
    }else{
            
        $msg = 'insertion reussi';
        
        $sql_insert = "INSERT INTO todo (title) VALUES (?) ";
        $stmt = $todo->prepare($sql_insert);
        $stmt->execute([$title]);
    }
}elseif($_POST['btn'] === 'delete'){
    
    $id = $_POST['id'];
    $sql_delete = " DELETE FROM todo WHERE id = ? ";
    $stmt = $todo->prepare($sql_delete);
    $stmt->execute([$id]);

    $msg = 'the task is deleted';
}
}

$sql_affiche = 'SELECT * FROM todo';
$todos = $todo->query($sql_affiche);

if( count($todos->fetchAll()) === 0 ){
    $sql_delete = "TRUNCATE TABLE todo ";
    $todo->query($sql_delete);
}








?> 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>


<body>


    <p class="text-dark"><?=  htmlspecialchars($msg) ?> </p>
    <h2 class="col bg-dark text-light p-2 ">TodoList</h2>

    <div class="d-flex col-6 m-4" >
        <form action="" method="POST">

            <input type="text" class="form-control" name="title">
            <button name="btn" value="insert" class="btn btn-primary" >add</button>
        </form>
    </div>

    <?php foreach($todos as $todo): ?> 
        
        <div class="d-flex border col-3 d-flex justify-content-between m-3 p-3">
            <p> <?= $todo['id'] ." && ". $todo['title']  ?> </p>
            <div>
                
                <button class="btn btn-warning">undo</button>
                <form action="" method="POST">
                    <input type="text" name="id" value="<?= $todo['id'] ?>" hidden>
                    <button name="btn" value="delete" class="btn btn-danger">X</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?> 
</body>
</html>