<?php
    session_start();
    
    $text = null;
    if(isset($_POST["searchbox"]))
	{
		$text = $_POST["searchbox"];
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าหลัก</title>

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
                    <h4><a href="index.php" style="color:black;">ค้นหารายการอาหาร</a></h4>
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
                            รหัส/ชื่อเมนูอาหาร : <input type="text"  name="searchbox" id="searchbox" >
                            <button type="submit" class="btn btn-primary btn-sm">ค้นหา</button>
                        </div>
                    </form>
                    

                    <?php
                        require 'connect.php';
                        require 'functions.php';//WHERE menu_ID LIKE '%".$text."%' 
                        $query = "SELECT * FROM menu WHERE menu_ID LIKE '%".$text."%' OR menu_Name LIKE '%".$text."%' ";

                        $result = mysqli_query($con,$query);

                        echo "<table id='example' class='display table table-bordered table-hover' 
                            cellspaceing='0'> "; 

                        echo "
                        <thead>
                            <tr>
                                <th>รหัสเมนู</th>
                                <th>ชื่อเมนูอาหาร</th>
                                <th>ประเภทอาหาร</th>
                                <th>ราคา</th>
                            </tr>
                        </thead>";
                        if(mysqli_num_rows($result)) {  
                            while($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>".$row["menu_ID"]."</td>";
                                echo "<td>".$row["menu_Name"]."</td>";
                                echo "<td>".$row["menu_Type"]."</td>";
                                echo "<td>".$row["menu_price"]."</td>";
                            
                            }
                        } else {
                            echo "ไม่มีรายการให้แสดง!";
                        }
                        echo "</table>";
                    ?>

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