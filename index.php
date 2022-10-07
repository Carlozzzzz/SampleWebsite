<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/72c32f013b.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- PHP Link -->
    <?php require_once 'process.php'; ?>C

    <!-- Validation message -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>



    <!-- Getting records from database (crud) -->
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
    ?>

    <div class="container ">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
        <div class="row justify-content-center align-content-center vh-100">
            <div class="col-md-6">
                <!-- Form -->
                <form class="p-5 bg-dark text-white rounded-4" action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <h1>CRUD</h1>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" value="<?php echo $username ?>" name="username">

                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" value="<?php echo $password ?>" name="password">
                    </div>

                    <?php if ($update == true) : ?>
                        <button type="submit" class="btn btn-info text-white" name="update">Update</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary text-white" name="save">Save</button>
                    <?php endif; ?>

                </form>
            </div>

            <div class="col-md-6">
                <!-- Search Bar -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search Bar" aria-describedby="btnSearch">
                    <button class="btn btn-outline-primary" type="button" id="btnSearch"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <!-- Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td>
                                    <div class="container-fluid">
                                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary text-white">Edit</a>
                                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script> -->
</body>

</html>