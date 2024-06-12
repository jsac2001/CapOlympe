<?php
require '../ressources/library/databaseFunctions.php';
include '../ressources/templates/header.php';

$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;

$errors = array('surname' => '', 'name' => '', 'pseudo' => '', 'email' => '', 'password' => '', 'gender' => '', 'languages' => '', 'nationality' => '', 'image' => '', 'phone' => '');
$surname = $name = $pseudo = $email = $password = $gender = $languages = $nationality = $image = $phone = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $surname = htmlspecialchars($_POST['surname']);
        $name = htmlspecialchars($_POST['name']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $gender = isset($_POST['gender_type']) ? $_POST['gender_type'][0] : '';
        $languages = htmlspecialchars($_POST['languages']);
        $nationality = htmlspecialchars($_POST['nationality']);
        $phone = htmlspecialchars($_POST['phone']);

        // Gestion de l'upload de l'image de profil
        if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;
                } else {
                    $errors['image'] = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $errors['image'] = "Le fichier n'est pas une image.";
            }
        }

        // Validation supplémentaire pour les nouvelles entrées (à ajouter)

        if (!array_filter($errors)) {
            $sql = "INSERT INTO users (surname, name, pseudonym, email, password, gender, languages, nationality, image, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$surname, $name, $pseudo, $email, $password, $gender, $languages, $nationality, $image, $phone])) {
                header('Location: feed.php');
                exit;
            }
        }
    }
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

$conn = null;
?>
<div class="inscription_body">
    <h1>FORMULAIRE D'INSCRIPTION</h1>
    <form class="inscription_informations" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
        <div class="error"><?php echo $errors['surname']; ?></div>
        <label for="surname"><b>Votre Nom*</b></label>
        <input type="text" id="surname" name="surname" placeholder="Entrez votre nom..." required value="<?php echo $surname; ?>">
        
        <div class="error"><?php echo $errors['name']; ?></div>
        <label for="name"><b>Votre Prénom*</b></label>
        <input type="text" id="name" name="name" placeholder="Entrez votre prénom..." required value="<?php echo $name; ?>">
        
        <div class="error"><?php echo $errors['pseudo']; ?></div>
        <label for="pseudo"><b>Votre Pseudo (Optionnel)</b></label>
        <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo..." value="<?php echo $pseudo; ?>">
        
        <div class="error"><?php echo $errors['email']; ?></div>
        <label for="email"><b>Votre Mail*</b></label>
        <input type="email" id="email" name="email" placeholder="Entrez votre adresse mail..." required value="<?php echo $email; ?>">
        
        <div class="error"><?php echo $errors['password']; ?></div>
        <label for="password"><b>Votre Mot de Passe*</b></label>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe..." required>
        
        <div class="error"><?php echo $errors['gender']; ?></div>
        <label><b><u>Genre (Facultatif) :</u></b></label><br>
        <input type="checkbox" id="gender1" name="gender_type[]" value="Masculin" onclick="limitCheckboxes(this)">
        <label for="gender1">Masculin</label><br>
        <input type="checkbox" id="gender2" name="gender_type[]" value="Féminin" onclick="limitCheckboxes(this)">
        <label for="gender2">Féminin</label><br>
        <input type="checkbox" id="gender3" name="gender_type[]" value="Autre" onclick="limitCheckboxes(this)">
        <label for="gender3">Autre</label><br>

        <div class="error"><?php echo $errors['languages']; ?></div>
        <label for="languages"><b>Langues parlées</b></label>
        <input type="text" id="languages" name="languages" placeholder="Langues..." value="<?php echo $languages; ?>">

        <div class="error"><?php echo $errors['nationality']; ?></div>
        <label for="nationality"><b>Nationalité</b></label>
        <input type="text" id="nationality" name="nationality" placeholder="Nationalité..." value="<?php echo $nationality; ?>">

        <div class="error"><?php echo $errors['phone']; ?></div>
        <label for="phone"><b>Téléphone</b></label>
        <input type="text" id="phone" name="phone" placeholder="Téléphone..." value="<?php echo $phone; ?>">

        <div class="error"><?php echo $errors['image']; ?></div>
        <label for="image"><b>Photo de profil</b></label>
        <input type="file" id="image" name="image">
        
        <input type="submit" value="M'inscrire" name="donnees">
    </form>
</div>
    <?php include '../ressources/templates/footer.php';
