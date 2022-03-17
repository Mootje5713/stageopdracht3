<?php
include "connection.php";
include "functions.php";
    if (isset($_POST['submit'])) {
        $bedrag = $_POST['bedrag'];
        $categorie_id = $_GET['id'];
        $user_id =  $_SESSION['user_id'];
        if (addamount($bedrag, $categorie_id, $user_id, $conn) === TRUE) {
            header("location: categorie.php?id=$categorie_id");
        } else {
            echo "fout in addamount";
        }
    }
?>

<?php include "header.php"; ?>
<div class="category">
<a href="categorie.php">Terug</a>
</div>
<form method="POST">
    <input type="number" name="bedrag" required>
    <button type="submit" class="btn"  name="submit"> Voeg een bedrag toe toe </button>
</form>

<?php include "footer.php"; ?>
