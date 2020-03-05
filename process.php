<?php 
    @include 'includes/config.php';

    $ID = 0;
    $update = false;
    $kategorija = '';
    $modelis = '';
    $gamintojas = '';

    // $mysqli = new mysqli('localhost', "root", "", "balttest") or die(mysqli_error($mysqli));

    if(isset($_POST['save'])) {
        $kategorija = $_POST['kategorija'];
        $modelis = $_POST['modelis'];
        $gamintojas = $_POST['gamintojas'];
        $yraSandelyje = $_POST['yraSandelyje'];

        $con->query("INSERT INTO prekes (id, kategorija, modelis, gamintojas, yraSandelyje) VALUES ('', '$kategorija', '$modelis', '$gamintojas', '$yraSandelyje')") OR die($con->error);
        
        $_SESSION['message'] = "Ikelta nauja preke";
        $_SESSION['msg-type'] = "success";
        header("Location: index.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $con->query("DELETE FROM prekes WHERE id=$id");
        
        $_SESSION['message'] = "Preke pasalinta is tinklo";
        $_SESSION['msg-type'] = "danger";
        header("Location: index.php");
    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true; 
        $resutlt = $con->query("SELECT * FROM prekes WHERE id=$id");
        if(count($resutlt) ==1) {
            $row = $resutlt->fetch_array();
            $id = $row['id'];
            $kategorija = $row['kategorija'];
            $modelis = $row['modelis'];
            $gamintojas = $row['gamintojas'];
            $yraSandelyje = $row['yraSandelyje'];
        }
    }

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $kategorija = $_POST['kategorija'];
        $modelis = $_POST['modelis'];
        $gamintojas = $_POST['gamintojas'];
        $yraSandelyje = $_POST['yraSandelyje'];


        $con->query("UPDATE prekes SET kategorija='$kategorija', modelis='$modelis', gamintojas='$gamintojas', yraSandelyje='$yraSandelyje' WHERE id=$id") OR die($con->error);

        $_SESSION['message'] = "Preke atanaujinta";
        $_SESSION['msg-type'] = "warning";

        header('Location: index.php');
    }
?>