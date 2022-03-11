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
    <a href="addamount.php?id=<?php echo $_GET['id']?>">Voeg een bedrag toe</a>
    <h1>categorie</h1>
    <?php foreach ($categorie as $row): ?> 
        <h2><?php echo $row['categorie']?></h2>
        <?php if(empty($row['totaal'])): ?>
        <h2>Je hebt nog niks uitgegven aan deze categorie<?php echo $row['totaal']; ?></h2>
        <?php else: ?>
        <h2>Je hebt in totaal &euro;<?php echo $row['totaal']; ?>
        aan deze categorie uitgegeven.</h2>
    <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <p><a href="index.php">Terug</a></p>

<table class="charts-css column show-4-secondary-axes">
    <tbody>
    <?php foreach ($bedrag as $row): ?>   
        <ul>
            <li>
                Bedrag &euro;
                    <?php echo $row['bedrag'];?>
                    <br>
                    Om <?php echo $row['tijdstip']; ?>
                <tr style="--color: <?php if($row['bedrag']/10)
                    echo "red"; else echo "gray"; ?>;">  
                </tr>
            </li>    
        </ul>
    </tbody>
</table>
<?php endforeach; ?>

<?php include "footer.php"; ?>
