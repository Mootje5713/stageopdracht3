<?php
include "connection.php";
    if (isset($_POST['submit'])) {
        $bedrag = $_POST['bedrag'];
        $categorie_id = $_GET['id'];
        $user_id =  $_SESSION['user_id'];
        $bedrag = "INSERT INTO `kosten` (bedrag, categorie_id, user_id)
        VALUES('$bedrag', '$categorie_id', '$user_id')"; 
        $result = $conn->query($bedrag);
        if ( $result === FALSE) {
            echo "error" . $bedrag . "<br />" . $conn->error;
        } else {
            $query = "SELECT sum(bedrag) as totaal FROM kosten WHERE user_id= $user_id
            AND categorie_id=$categorie_id";
            $result=$conn->query($query);

            if ($result === FALSE) {
                echo "error" . $query . "<br />" . $conn->error;
            } else {
                if ($result->num_rows>0) {
                    while($row=$result->fetch_assoc())
                    {
                        $totaal = $row['totaal'];
                    }
                }
            }

            $query = "UPDATE categorieen SET totaal = $totaal WHERE id = $categorie_id";
            $result = $conn->query($query);
            if ( $result === FALSE) {
                echo "error" . $query . "<br />" . $conn->error;
            } else {
                header("location: categorie.php?id=$categorie_id");
            }
        }
    }
?>

<?php include "header.php"; ?>
<p><a href="bedrag.php">Terug</a></p>
<form method="POST">
    <input type="number" name="bedrag" required>
    <button type="submit" class="btn"  name="submit"> Voeg een bedrag toe toe </button>
</form>

<?php include "footer.php"; ?>
