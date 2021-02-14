<?php
    session_start();
    require 'connect.php';
    require 'functions.php';


    if(isset($_POST['add'])) {

        $id = $_POST['menu_ID'];
        $name = $_POST['menu_Name'];
        $type = $_POST['menu_Type'];
        $price = $_POST['menu_price'];
        
        $query = "SELECT * FROM menu WHERE menu_ID = '$id' LIMIT 1";
        $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO menu (menu_ID, menu_Name, menu_Type, menu_price)
                VALUE ('$id', '$name', '$type', '$price')";

                if(mysqli_query($con, $query)) {
                    $_SESSION['prompt'] = "เพิ่มข้อมูลสำเร็จ";
                    header("location: index.php");
                    exit;
                } else {
                    die("พบข้อผิดพลาดการคิวรี่ข้อมูล");
                }


            } else {
                $_SESSION['errprompt'] = "รหัสเมนูอาหารซ้ำ! กรุณาเปลี่ยน";
            }
        

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าเพิ่มข้อมูล</title>

    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <script src="assets/css/bootstrap.min.css"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container" style="padding:40px 0;">
        <div class="jumbotron">
        <?php
            

                if(isset($_SESSION['errprompt'])){
                    showError();
                }
            
            ?>

            <div class="card">
                <div class="card-header">
                    <h4><a href="index.php" style="color:black;">เพิ่มรายการอาหาร</a></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <a href="insert.php" class="btn btn-success">เพิ่มข้อมูล</a>
                        <a href="search.php" class="btn btn-primary">ค้นหาข้อมูล</a>
                        <a href="edit.php" class="btn btn-warning">แก้ไขข้อมูล</a>
                        <a href="delete.php" class="btn btn-danger">ลบข้อมุล</a>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >

                        <div class="form-group">
                            รหัสเมนู : <input type="text" class="form-control" name="menu_ID" pattern="[m][0-9]{4}" required autofocus>
                        </div>

                        <div class="form-group">
                            ชื่อเมนูอาหาร : <input type="text" class="form-control"name="menu_Name" maxlength="50" required>
                        </div>
                        
                        <div class="form-group ">
                            ประเภทอาหาร : 
                            <select name="menu_Type" class="form-control" required>
                                <option value="">--เลือกประเภท--</option>
                                <option value="1">อาหารคาว</option>
                                <option value="2">อาหารหวาน</option>
                                <option value="3">อาหารว่าง</option>
                            </select>
                    </div>

                        <div class="form-group">
                            ราคา : <input type="text" class="form-control"  name="menu_price" pattern="[0-9]{1,4}">
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">เพิ่มข้อมูล</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php

        unset($_SESSION['errprompt']);
        mysqli_close($con);  

?>