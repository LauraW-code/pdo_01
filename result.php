<?php

require 'connec.php';

$pdo = new PDO(DSN, USER, PASS);
//Vérification des données transmises dans le formulaire
$data = array_map('trim', $_POST); //Nettoyage avec trim
$data = array_map('htmlentities', $data); //Protection faille XSS

$errors = [];

if(!isset($data['firstname']) || empty($data['firstname'])){
    $errors[] = 'Le prénom est obligatoire';
}
if(mb_strlen($data['firstname']) > 45) {
    $errors[]= 'Le prénom doit contenir moins de 45 caractères';
}
if(!isset($data['lastname']) || empty($data['lastname'])){
    $errors[] = 'Le nom est obligatoire';
}
if(mb_strlen($data['lastname']) > 45) {
    $errors[]= 'Le nom doit contenir moins de 45 caractères';
}

if(empty($errors)){
    // A exécuter afin d'insérer une ligne dans votre table friends
$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo->prepare($query);
$statement->bindValue(':firstname', $data['firstname']);
$statement->bindValue(':lastname', $data['lastname']);
$statement->execute();

    header('Location: /index.php');
}
elseif(count($errors)>0){
    foreach($errors as $error){
        echo $error . '<br>';
    };
    
}
?>
    