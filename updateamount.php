<?php
include "connection.php";
include "functions.php";
$categorie_id = getcategorieid($_GET['id'], $conn);

if (isset($_POST['bedrag'])) {
    $id = $_GET['id'];
    $bedrag = $_POST['bedrag'];
    $user_id = $_SESSION["user_id"];
    if (updateamount($id, $bedrag, $user_id, $conn) === TRUE) {
        header("location: categorie.php?id=$categorie_id");
    } else {
        echo "fout in updateamount";
    }
}


?>


<?php
include "header.php";
?>

<form action="" method="POST">
    <input type="number" name="bedrag" value="<?php echo $bedrag[0]['bedrag'] ?>" id="bedrag" required>
    <button type="submit" class="btn" name="submit"> wijzig </button>
</form>

<?php
include "footer.php";
?>