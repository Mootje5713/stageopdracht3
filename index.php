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
$categorietotalen = [];
    $query = "SELECT * FROM `categorieen` WHERE user_id='".$_SESSION["user_id"]."' ORDER BY id ASC";
    $result=$conn->query($query);
    if ( $conn->query($query) === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $categorie[] = $row;
                $categorietotalen[$row['id']] = $row['totaal'];
            }
        }
    }
    $conn->close();
?>


<?php include "header.php"; ?>
<div class="category">
    <a href="addcategory.php">Voeg een categorie toe</a>
    <a href="addtoallcategories.php">Voeg een extra bedrag toe</a>

    <h1>categorieen</h1>
</div>
<h2>Je hebt in totaal <?php echo array_sum($categorietotalen);?> uitgegeven aan 
alle categorieen</h2>
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
                <h2><?php echo $row['categorie']?></a></h2>
                <?php echo ($categorietotalen[$row['id']]);?>
            </tr>
        </table>
        </li>
    </ul>
    <?php endforeach; ?>
    <?php endif; ?>
<?php include "footer.php"; ?>