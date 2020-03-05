<?php 
    @include './includes/config.php';

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    } else {
        header("Location: register.php");
    }

    // session_destroy();

    $count = 0;
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

<div class="container">
    <h1 class="text-center my-4">Prekes paieska</h1>
    <form method="POST" action="search.php">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label class="sr-only" for="inlineFormInput">paieska</label>
                <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="e.g. Samsung" name="q">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2" name="ieskoti">Ieskoti</button>
            </div>
        </div>
    </form>
    <br>
    <div class="tableForStudd">
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

        <?php 
            if(isset($_POST['ieskoti'])) {
                $q = $_POST['q'];
                $sql = mysqli_query($con, "SELECT * FROM prekes WHERE kategorija LIKE '%$q%' OR modelis LIKE '%$q%' OR gamintojas LIKE '%$q%'");
                $count = mysqli_num_rows($sql); ?>

        <?php if($count > 0) : ?>
            <?php while($row = mysqli_fetch_array($sql)) : ?>
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
            <?php endwhile; ?>

        <?php else :?>
            <p>Deja, nieko neradome</p>
        <?php endif; ?>
        <?php }?>
        </tbody>
        </table>
    </div>
    <a href="index.php" class="btn btn-info">Grysti i index puslapi</a>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


