<?php
include "model.php";
$mode = new model;
if (isset($_POST['submit'])) {
    $mode->insert_values($_POST);
}

if (isset($_POST['update'])) {
    $mode->update_values($_POST);
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $mode->delete_values($delete_id);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oop crud</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .image {
            width: 25%;
        }
    </style>

</head>

<body>

    <h1 class="text-center text-info mt-5">CRUD OPERATION</h1>


    <div class="container ">





        <?php
        if (isset($_GET['msg']) && $_GET['msg'] == 'ins') {
            echo '<div class="alert alert-primary" role="alert">
            data is inserted successfully...!
          </div>';
        } else  if (isset($_GET['msg']) && $_GET['msg'] == 'empty') {
            echo '<div class="alert alert-danger" role="alert">
            no data is inserted!
          </div>';
        } else  if (isset($_GET['msg']) && $_GET['msg'] == 'updt') {
            echo '<div class="alert alert-warning" role="alert">
            data is updated successfully!
          </div>';
        } else  if (isset($_GET['msg']) && $_GET['msg'] == 'delet') {
            echo '<div class="alert alert-info" role="alert">
            data is deleted successfully!
          </div>';
        } else if (isset($_GET['msg']) && $_GET['msg'] == ' ') {
            echo '<div class="alert alert-danger" role="alert">
            no action happend!
          </div>';
        }


        ?>
        <div class="w-50 m-auto ">
            <?php
            if (isset($_GET['update_id'])) {
                $update_id = $_GET['update_id'];
                $value_update = $mode->return_row($update_id);
            ?>

                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" value="<?= $value_update['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $value_update['email'] ?>">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="product_name" class="form-label">product_name</label>
                        <input type="text" class="form-control" id="product_name" aria-describedby="emailHelp" name="product_name" value="<?= $value_update['product_name'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="product_price" class="form-label">product_price</label>
                        <input type="text" class="form-control" id="product_price" aria-describedby="emailHelp" name="product_price" value="<?= $value_update['product_price'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="product_image" class="form-label">product_image</label>
                        <input type="hidden" class="form-control" id="" aria-describedby="emailHelp" name="old_image" value="<?= $value_update['product_img'] ?>">
                        <input type="hidden" class="form-control" id="" aria-describedby="emailHelp" name="id" value="<?= $value_update['id'] ?>">

                        <img src="imgs/<?= $value_update['product_img'] ?>" class="w-50" alt="">
                        <input type="file" class="form-control" id="product_image" aria-describedby="emailHelp" name="product_image">

                    </div>
                    <button type="submit" name="update" class="btn btn-success ">update</button>
                </form>

            <?php
            } else {



            ?>





                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="product_name" class="form-label">product_name</label>
                        <input type="text" class="form-control" id="product_name" aria-describedby="emailHelp" name="product_name">
                    </div>

                    <div class="mb-3">
                        <label for="product_price" class="form-label">product_price</label>
                        <input type="text" class="form-control" id="product_price" aria-describedby="emailHelp" name="product_price">
                    </div>
                    <div class="mb-3">
                        <label for="product_image" class="form-label">product_image</label>
                        <input type="file" class="form-control" id="product_image" aria-describedby="emailHelp" name="product_image">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary ">Submit</button>
                </form>

            <?php
            };
            ?>
        </div>

        <!-- search form -->
        <form action="index.php" method="POST" class="d-flex align-align-items-center justify-content-center">
            <div class="mb-3 mt-3 w-50 d-flex align-align-items-center justify-content-center">
                <input type="text" class="form-control" id="product_search" aria-describedby="emailHelp" name="product_search" placeholder="search product name .....">
                <input type="submit" value="search" name="search_value" class="btn btn-success">
                <input type="submit" value="reset" name="reset_value" class="btn btn-secondary">

            </div>
        </form>

        <!-- display table here -->
        <div class=" ">
            <h2 class="text-center text-info mb-4">data is here </h2>
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">username</th>
                        <th scope="col">email</th>
                        <th scope="col">product name</th>
                        <th scope="col">product price</th>
                        <th scope="col">product image</th>
                        <th scope="row">operation</th>


                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $i = 1;
                    if (isset($_POST['search_value'])) {
                        $product_search = $_POST['product_search'];
                        $search_result = $mode->search($product_search);
                        // print_r($search_result);die;
                        if ($search_result == "no data is found") {

                        } else {
                            foreach ($search_result as $dta_search) :
                    ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $dta_search['name'] ?></td>
                                    <td><?= $dta_search['email'] ?></td>
                                    <td><?= $dta_search['product_name'] ?></td>
                                    <td><?= $dta_search['product_price'] ?></td>
                                    <td class="">
                                        <img src="imgs/<?= $dta_search['product_img'] ?>" alt="" class=" image">
                                    </td>
                                    <td class="">
                                        <a href="index.php?update_id=<?= $dta_search['id'] ?>" class="btn btn-success">update</a>
                                        <a href="index.php?delete_id=<?= $dta_search['id'] ?>" class="btn btn-danger">delete</a>

                                    </td>
                                </tr>

                            <?php
                            endforeach;
                        }
                    }else if(isset($_POST['reset_value'])) {
                    $data = $mode->display_data();
                    if ($data != "no data is found") {


                        foreach ($data as $dta) :
                            ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $dta['name'] ?></td>
                                <td><?= $dta['email'] ?></td>
                                <td><?= $dta['product_name'] ?></td>
                                <td><?= $dta['product_price'] ?></td>
                                <td class="">
                                    <img src="imgs/<?= $dta['product_img'] ?>" alt="" class=" image">
                                </td>
                                <td class="">
                                    <a href="index.php?update_id=<?= $dta['id'] ?>" class="btn btn-success">update</a>
                                    <a href="index.php?delete_id=<?= $dta['id'] ?>" class="btn btn-danger">delete</a>

                                </td>
                            </tr>
                    <?php
                        endforeach;
                    };
                }else{
                    $data = $mode->display_data();
                    if ($data != "no data is found") {


                        foreach ($data as $dta) :
                            ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $dta['name'] ?></td>
                                <td><?= $dta['email'] ?></td>
                                <td><?= $dta['product_name'] ?></td>
                                <td><?= $dta['product_price'] ?></td>
                                <td class="">
                                    <img src="imgs/<?= $dta['product_img'] ?>" alt="" class=" image">
                                </td>
                                <td class="">
                                    <a href="index.php?update_id=<?= $dta['id'] ?>" class="btn btn-success">update</a>
                                    <a href="index.php?delete_id=<?= $dta['id'] ?>" class="btn btn-danger">delete</a>

                                </td>
                            </tr>
                    <?php
                        endforeach;
                    };
                }
                    ?>


                </tbody>
            </table>
        </div>

    </div>

    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>