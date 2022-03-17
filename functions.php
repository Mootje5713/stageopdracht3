<?php
function addamount($bedrag, $categorie_id, $user_id, $conn) {
    $bedrag = "INSERT INTO `kosten` (bedrag, categorie_id, user_id)
        VALUES('$bedrag', $categorie_id, '$user_id')"; 
        $result = $conn->query($bedrag);
        if ( $result === FALSE) {
            echo "error" . $bedrag . "<br />" . $conn->error;
            return FALSE;
        } else {
            if (updateCategorieTotaal($categorie_id, $user_id, $conn) === TRUE) {
                return TRUE;
            } else {
                echo "fout in addamount";
            }
        }
    }


function updateamount($id, $bedrag, $user_id, $conn) {
    $categorie_id = getcategorieid($id, $conn);
    $query = "UPDATE `kosten` SET bedrag=$bedrag WHERE user_id=$user_id AND id=$id"; 
    $result = $conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
        return FALSE;
    } 
    else {
        if (updateCategorieTotaal($categorie_id, $user_id, $conn) === TRUE) {
            return TRUE;
        } else {
            echo "fout in updatecategorietotaal";
        }
    }
}   

function getcategorieid($id, $conn) {
    if ($id) {
        $query = "SELECT * FROM `kosten` WHERE id='$id'";
        $result = $conn->query($query);
        if ($result === FALSE) {
            echo "error" . $query . "<br />" . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bedrag[] = $row;
                }
            }
        }
        $categorie_id = $bedrag[0]['categorie_id'];
    }
    return $categorie_id;
}

function deleteamount($id, $user_id, $conn) {
    $categorie_id = getcategorieid($id, $conn);
    $query = "UPDATE `kosten` SET deleted = NOW() WHERE user_id=$user_id AND id=$id"; 
    $result = $conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
        return FALSE;
    } 
    else {
        if (updateCategorieTotaal($categorie_id, $user_id, $conn) === TRUE) {
            return TRUE;
        } else {
            echo "fout in deleteamount";
        }
    }
}

function undeleteamount($id, $user_id, $conn) {
    $categorie_id = getcategorieid($id, $conn);
    $query = "UPDATE `kosten` SET deleted = NULL WHERE user_id=$user_id AND id=$id"; 
    $result = $conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
        return FALSE;
    } 
    else {
        if (updateCategorieTotaal($categorie_id, $user_id, $conn) === TRUE) {
            return TRUE;
        } else {
            echo "fout in undeleteamount";
        }
    }
}

function updateCategorieTotaal($categorie_id, $user_id, $conn) {
    $query = "SELECT sum(bedrag) as totaal FROM kosten WHERE user_id= $user_id
    AND deleted IS NULL AND categorie_id=$categorie_id";
    $result=$conn->query($query);

    if ($result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
        return FALSE;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $totaal = $row['totaal'];
            }
        }
    }
    if (!$totaal) $totaal = 0;

    $query = "UPDATE categorieen SET totaal = $totaal WHERE id = $categorie_id";
    $result = $conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $query . "<br />" . $conn->error;
        return FALSE;
    } else {
        return true;
    }

}
?>