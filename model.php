<?php

class model
{
    private $localhost = "localhost";
    private $root = "root";
    private $password = "";
    private $db_name = "users";
    private $conn;
    public $errors = [];
    function __construct()
    {
        $this->conn = new mysqli($this->localhost, $this->root, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            // echo "error";
        } else {
            // echo "connected";
        }
    }
    public function insert_values($POST)
    {
        if (!empty($POST['username']) && !empty($POST['email']) && !empty($POST['product_name']) && !empty($POST['product_price']) && !empty($_FILES['product_image']['name'])) {
            $name = $POST['username'];
            $email = $POST['email'];
            $product_name = $POST['product_name'];
            $product_price = $POST['product_price'];
            $product_img_name = $_FILES['product_image']['name'];
            $product_img_temp_name = $_FILES['product_image']['tmp_name'];
            $sql = "INSERT INTO `data`( `name`, `email`, `product_name`, `product_price`, `product_img`) VALUES ('$name','$email','$product_name','$product_price','$product_img_name')";
            $result = $this->conn->query($sql);
            if ($result) {
                move_uploaded_file($product_img_temp_name, "imgs/" . $product_img_name);
                header("location:index.php?msg=ins");
            } else {
                echo "error";
            }
        } else {
            header("location:index.php?msg=empty");
        }
    }
    public function display_data()
    {
        $sql = "SELECT * FROM `data`";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "no data is found";
        }
    }
    public function return_row($id)
    {
        $sql = "SELECT * FROM `data` WHERE id=$id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    public function update_values($POST)
    {
        if (!empty($POST['username']) && !empty($POST['email']) && !empty($POST['product_name']) && !empty($POST['product_price'])) {
            $id = $POST['id'];
            $name = $POST['username'];
            $email = $POST['email'];
            $product_name = $POST['product_name'];
            $product_price = $POST['product_price'];
            $old_img = $POST['old_image'];

            $sql = "UPDATE `data` SET `name`='$name',`email`='$email',`product_name`='$product_name',`product_price`='$product_price' WHERE id= $id";
            $result = $this->conn->query($sql);
            if ($result) {

                header("location:index.php?msg=updt");
            } else {
                echo "error";
            }
            if (!empty($_FILES['product_image']['name'])) {
                $product_img_name = $_FILES['product_image']['name'];
                $product_img_temp_name = $_FILES['product_image']['tmp_name'];
                $update_img = "UPDATE `data` SET `product_img`='$product_img_name' WHERE id= $id";
                $result_img = $this->conn->query($update_img);
                move_uploaded_file($product_img_temp_name, "imgs/" . $product_img_name);
                unlink('imgs/'. $old_img);
            }
        } else {
            header("location:index.php?msg=empty");
        }
    }

    public function delete_values($id){
        $sql="DELETE FROM `data` WHERE id=$id";
        $result = $this->conn->query($sql);
        if($result){
            header("location:index.php?msg=delet");
        }else{
            echo "error";
        }
    }
    
    public function search($product_search){
        $sql="SELECT * FROM  `data` WHERE product_name LIKE '%$product_search%'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "no data is found";
        }
    }
}
