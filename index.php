<?php
    include "connection.php";
    if (isset($_GET['categorie'])) {
        $categorie = $_GET['categorie'];
        $categorie = "INSERT INTO `categorieen` (categorie)
        VALUES('$categorie')"; 

    if ( $conn->query($categorie) === FALSE) {
        echo "error" . $categorie . "<br />" . $conn->error;
    }
}
    $query = "SELECT * FROM `categorieen` WHERE user_id='".$_SESSION["user_id"]."' ORDER BY id DESC";
    $result=$conn->query($query);
    if ( $conn->query($query) === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $categorie[] = $row;
            }
        }
    }
    $conn->close();
?>

<?php include "header.php"; ?>
<div class="category">
    <a href="addcategory.php">Voeg een categorie toe</a>
    <h1>categorie</h1>
</div>

<?php if (!isset($categorie)): 
    echo "<h3>Je hebt nog geen categorieen toegevoegd!!</h3>";    
        else: 
        ?>
<?php foreach ($categorie as $row): ?> 
    <ul>
        <li>
        <table>
            <tr>
            <a href="categorie.php?id=<?php echo $row['id']?>">
                <h2><?php echo $row['categorie']?></h2>
            </a>
            </tr>
        </table>
        </li>
    </ul>
    <?php endforeach; ?>
    <?php endif; ?>
<?php include "footer.php"; ?>