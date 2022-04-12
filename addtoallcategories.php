<?php

include "connection.php";
include "functions.php";
if (isset($_POST['submit'])) {
    $bedrag = $_POST['bedrag'];
    $user_id =  $_SESSION['user_id'];
    $query = "SELECT * FROM `categorieen` WHERE user_id = '".$_SESSION['user_id']."'";
    $result=$conn->query($query);
    if ($result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $categorie_ids[] = $row['id'];
            }
        }
    }


    if (!empty($categorie_ids)) {
        foreach($categorie_ids as $key => $value):
            addamount($bedrag, $value, $user_id, $conn);
        endforeach;
    } else { 
        header("Location: index.php");
    }
}

?>

<?php
    include "header.php";
?>


<p><a href="index.php">Terug</a></p>

<form action="" method="POST">
    <input type="hidden" value="<?php echo $_SESSION['user_id'];?>" 
    name="user_id" id="user_id" required>
    bedrag: <input type="number" name="bedrag" id="bedrag" required>
    <button type="submit" class="btn"  name="submit"> Voeg een bedrag toe </button>
</form>

<?php
    include "footer.php";
?>