<?php
include "connection.php";
include "functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $categorie_id = getcategorieid($_GET['id'], $conn);
    if (undeleteamount($id, $user_id, $conn) === TRUE) {
        header("location: categorie.php?id=$categorie_id");
    } else {
        echo "fout in undeleteamount";
    }
}

?>

<?php
include "header.php";
?>


<?php
include "footer.php";
?>