<?php
include "connection.php";
if (!isset($_GET['id'])) {
    header("location: index.php");
}
        $query = "SELECT * FROM `kosten` WHERE user_id='".$_SESSION["user_id"]."' AND categorie_id = '".$_GET['id']."' ORDER BY id DESC";
        $result=$conn->query($query);
        if ( $result === FALSE) {
            echo "error" . $query . "<br />" . $conn->error;
        } else {
            if ($result->num_rows>0) {
                while($row=$result->fetch_assoc())
                {
                    $bedrag[] = $row;
                }
            }
        }

        if (isset($_GET['categorie'])) {
            $categorie =  $_GET['categorie'];
            $categorie = "INSERT INTO `categorie`(categorie)
            VALUES ('$categorie')";
        if ( $conn->query($categorie) === FALSE) {
            echo "error" . $categorie . "<br />" . $conn->error;
    
        }
        }

        $id = intval($_GET['id']);

        $query2 = "SELECT * FROM `categorieen` WHERE id=$id";
        $result=$conn->query($query2);
        if ( $conn->query($query2) === FALSE) {
            echo "error" . $query2 . "<br />" . $conn->error;
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
        <a href="index.php">Terug</a>
        <a href="addamount.php?id=<?php echo $_GET['id']?>">Voeg een bedrag toe</a>
    <?php foreach ($categorie as $row): ?> 
        <h1><?php echo $row['categorie']?></h1>
    <?php endforeach; ?>
    </div>
        <?php if(empty($row['totaal'])): ?>
        <h2>Je hebt nog niks uitgegven aan deze categorie<?php echo $row['totaal']; ?></h2>
        <?php else: ?>
        <h2>Je hebt in totaal &euro;<?php echo $row['totaal']; ?>
        aan deze categorie uitgegeven.</h2>
        <?php endif; ?>
    <?php foreach ($bedrag as $row): ?>   
        <ul>
            <li>
                Bedrag &euro;
                <?php if(($row['deleted']) == ''):?>
                    <?php echo $row['bedrag'];?>
                    <br>
                    Om <?php echo $row['tijdstip']; ?>
                    <br>
                    <a href="deleteamount.php?id=<?php echo $row['id']?>">bedrag verwijderen</a>
                    <a href="updateamount.php?id=<?php echo $row['id']?>">bedrag wijzigen</a>
                <?php else: ?>
                    <s><?php echo $row['bedrag'];?></s>
                    <a href="undelete.php?id=<?php echo $row['id']?>">bedrag terughalen</a>
                <?php endif; ?>
            </li>    
        </ul>
<?php endforeach; ?>




<?php include "footer.php"; ?>
