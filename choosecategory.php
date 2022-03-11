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

    $query = "SELECT * FROM `categorieen` WHERE user_id='".$_SESSION["user_id"]."'";
    $result = $conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $categorie[] = $row;
            }
        } 
    }

?>

<?php include "header.php"?>
<div class="box">
    <h1>categorie</h1>
</div>

<p><a href="index.php">Terug</a></p>

<form action="" method="POST">
    <input type="hidden" value="<?php echo $_SESSION['user_id'];?>" 
    name="user_id" id="user_id" required>
    Categorie: 
    <select name="categorie" required>
        <?php foreach ($categorie as $row): ?>
            <?php echo $row['user_id'];?> 
        <option value="<?php echo $row['categorie']; ?>"><?php echo $row['categorie']; ?></option>
        <?php endforeach; ?> 
    </select>
    <button type="submit" class="btn" name="submit"> kies een categorie uit </button>
</form>

<?php include "footer.php"?>