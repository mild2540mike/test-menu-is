<?php

    function clean ($data) {
        $data = trim($data);
        $data = stripslashes($data);

        return $data;
    }

    function showPrompt() {
        echo "<div class='alert alert-success' >".$_SESSION['prompt']."</div>";
    }

    function showError() {
        echo "<div class='alert alert-danger'>".$_SESSION['errprompt']."</div>";
    }


    function DateThai($strDate) {
        $strYear = date("y",strtotime($strDate))+43;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
?>