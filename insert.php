<?php
$name= $POST['name'];
$email= $POST['email'];
$jobtype= $POST['jobtype'];
$specifyjob= $POST['specifyjob'];
$quantity= $POST['quantity'];

if (!empty($name) ||  !empty($email) ||   !empty($jobtype) ||   !empty($specifyjob) ||   !empty($quantity)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname ="chrispress form";

}
    //create connection
    $conn = new mysqli($host, $dbusername,$dbpassword, $dbname);
    if (mysqli-_connect_error()){
        die('connect Error('. mysqli-_connect_error().')'. mysqli-_connect_error());
    }
    else{
        $SELECT = "SELECT email from register where email = ? Limit 1";
        $INSERT = "INSERT Into register ( name, email, jobtype, specifyjob, quantity) values(? ? ? ? ?";
    }
        // PREPARE STATEMENT
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssi", $name, $email, $jobtype, $specifyjob, $quantity);
            $stmt->execute();
            echo "New record inserted sucessfully";
        }
        else {
            echo "Someone already registered using this email";

            }
            $stmt->close();
            $conn->close();
    }
}
        else {
              echo "All fileds are required";
         die(); 
 }
?>