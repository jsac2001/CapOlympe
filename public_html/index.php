<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/ressources/templates/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/ressources/library/databaseFunctions.php';

$posts = getPost(1);

var_dump($posts);
?>



<h1>FORMULAIRE D'INSCRIPTION</h1>
<form method="POST" action="traitement.php">
    <label for="nom">Votre Nom</label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom..." required>
    <br/>
    <label for="prenom">Votre Prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom..." required>
    <br/>
    <label for="pseudo">Votre Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo..." required>
    <br/>
    <label for="mail">Votre Mail</label>
    <input type="text" id="mail" name="mail" placeholder="Entrez votre adresse mail..." required>
    <br/>
    <label for="mdp">Votre Mot de Passe*</label>
    <input type="password" id="motdepasse" name="motdepasse" placeholder="Entrez votre mot de passe..." required>
    <br/>
    <input type="submit" value="M'inscrire" name="donnees">
</form>






<?php 
include 'templates/footer.php';
?>