<?php 
    @include 'includes/config.php';
    @include 'process.php';

    // session_destroy();
   
    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    } else {
        header("Location: register.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BaltTest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css
    ">
</head>
<body>

<?php if(isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['msg-type'] ?>">
        <?php 
           echo $_SESSION['message'];
           unset($_SESSION['message']);
            
        ?>
    </div>
<?php endif ?>

<div class="container">
    <h1 class="text-center my-4">Prekiu duomenu baze</h1>

    <div class="tableForStudd">
        <?php  
            $result = $con->query("SELECT * FROM prekes") OR die($con->error);
            function pre_r($data) {
                echo "<pre>";
                print_r($data);
                echo "</pre>";
            }
        ?>

        <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Prekes kategorija</th>
            <th scope="col">Modelis</th>
            <th scope="col">Gamintojas</th>
            <th scope="col">Yra sandelyje</th>
            <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) : ?>
                <tr>
                    <th scope="row"><?php echo $row['id'] ?></th>
                    <td><?php echo $row['kategorija'] ?></td>
                    <td><?php echo $row['modelis'] ?></td>
                    <td><?php echo $row['gamintojas'] ?></td>
                    <td><?php echo $row['yraSandelyje'] ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Pasalini</a>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
        </table>
    </div>

    <form method="POST" action="process.php">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-row">
            <div class="col-md mb-3">
                <label for="prekesKategorija">Prekes Kategorija</label>
                <input type="text" name="kategorija" class="form-control" id="prekesKategorija" value="<?php echo $kategorija ?>" required>
            </div>
            <div class="col-md mb-3">
                <label for="validationDefault04">Gamintojas</label>
                <input type="text" name="gamintojas" id="validationDefault04" class="form-control" value="<?= $gamintojas ?>" required >
            </div>
        </div>
        <div class="form-row">
            <div class="col-md mb-3">
                <label for="Modelis">Modelis</label>
                <input type="text" class="form-control" name="modelis" id="Modelis" value="<?= $modelis ?>" required>
            </div>
            <div class="col-md mb-3">
                
            <label for="yraSandely">Preke sandelyje</label>
            <select class="custom-select" name="yraSandelyje" id="yraSandelyje" aria-valuenow=""  required>
                <option selected disabled value="">-</option>
                <option>Yra</option>
                <option>Nera</option>
            </select>
            </div>
        </div>
        <?php if($update) : ?>
            <button class="btn btn-info" name="update" type="submit">Atnaujinti preke</button>
        <?php else : ?>
            <button class="btn btn-primary" name="save" type="submit">Prideti preke</button>
        <?php endif ?>
        <a href="search.php" class="btn btn-info ml-1">Ieskoti prekes</a>

    </form>
</div>





    

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
