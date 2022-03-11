<?php
    include "connection.php";
    if (isset($_POST['submit'])) {
        $categorie = $_POST['categorie'];
        $user_id =  $_SESSION['user_id'];
        $categorie = "INSERT INTO `categorieen` (categorie, user_id)
        VALUES('$categorie', '$user_id')"; 
        $result = $conn->query($categorie);

        if ( $result === FALSE) {
            echo "error" . $categorie . "<br />" . $conn->error;
        } else {
            header("Location: index.php"); 
        }
    }

    $conn->close();

?>

<?php include "header.php"; ?>
<p><a href="index.php">Terug</a></p>
<form method="POST">
    <input type="text" name="categorie" required>
    <button type="submit" class="btn"  name="submit"> Voeg categorie toe </button>
</form>

<?php include "footer.php"; ?>