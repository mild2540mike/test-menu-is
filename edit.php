<?php
    session_start();
    require 'connect.php';
    require 'functions.php';


    $text = null;
    if(isset($_POST["searchbox"]))
	{
		$text = $_POST["searchbox"];
    }

    if(isset($_POST['updatedata'])) {
        
        $id = $_POST["menu_ID"];
        $name = $_POST['menu_Name'];
        $type = $_POST['menu_Type'];
        $price = $_POST['menu_price'];
       
        if(!empty($_POST['menu_ID'])){
                $query = "UPDATE menu SET menu_Name='".$name."', menu_Type='".$type."', menu_price='".$price."' WHERE menu_ID = '".$id."'";

                
                $result = mysqli_query($con, $query);
                if($result) {
                    $_SESSION['prompt'] = "แก้ไขข้อมูลสำเร็จ";
                    header("location: index.php");
                    //echo $id;
                    exit;
                } else {
                    die("Error with the query");
                }
        } else {
            $_SESSION['errprompt'] = 'กรุณาค้นหาข้อมูลก่อน';
        }

           
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแก้ไขข้อมูล</title>

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
                    <h4><a href="index.php" style="color:black;">แก้ไขรายการอาหาร</a></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <a href="insert.php" class="btn btn-success">เพิ่มข้อมูล</a>
                        <a href="search.php" class="btn btn-primary">ค้นหาข้อมูล</a>
                        <a href="edit.php" class="btn btn-warning">แก้ไขข้อมูล</a>
                        <a href="delete.php" class="btn btn-danger">ลบข้อมุล</a>
                    </div>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
                        <div class="form-group">
                            รหัสเมนูอาหาร : <input type="text"  name="searchbox" id="searchbox" required autofocus>
                            <button type="submit" class="btn btn-primary btn-sm">ค้นหา</button>
                        </div>
                    </form>



                    <?php 
                        $query = "SELECT * FROM menu WHERE menu_ID LIKE '".$text."' ";
                        $result = mysqli_query($con,$query);
                        $row = mysqli_fetch_array($result)
                    ?>
                    

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >

                        <div class="form-group">
                            รหัสเมนู : <input type="text" id="menu_ID" name="menu_ID"value="<?php echo $row['menu_ID'];?>" readonly>
                        </div>

                        <div class="form-group">
                            ชื่อเมนูอาหาร : <input type="text" class="form-control"name="menu_Name" maxlength="50" value="<?php echo $row['menu_Name'] ?>" required>
                        </div>
                        
                        <div class="form-group ">
                            ประเภทอาหาร : 
                            <select name="menu_Type" class="form-control" required>
                                <option value="">--เลือกประเภท--</option>
                                <option value ="1" <?php if($row['menu_Type']=="1"){ echo "selected='selected'";} ?>>อาหารคาว</option>
                                <option value ="2" <?php if($row['menu_Type']=="2"){ echo "selected='selected'";} ?>>อาหารหวาน</option>
                                <option value ="3" <?php if($row['menu_Type']=="3"){ echo "selected='selected'";} ?>>อาหารว่าง</option>
                            </select>
                    </div>

                        <div class="form-group">
                            ราคา : <input type="text" class="form-control"  name="menu_price" pattern="[0-9]{1,4}" value="<?php echo $row['menu_price'] ?>">
                        </div>
                        <button type="submit" class="btn btn-warning" name="updatedata">แก้ไขข้อมูล</button>

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