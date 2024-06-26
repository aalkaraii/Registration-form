
<?php

    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "web";

    // Create connection to database
    $connect = new mysqli($server,$username,$password,$db);
    
    // Check connection
    if($connect->connect_error){
        echo "connection error !!";
    }
    
    // Collecting data from Form
    $name = $_POST['firstField'];
    $phone = $_POST['secondField'];
    $email = $_POST['thirdField'];
    $gender = $_POST['Gender'];
    $address = $_POST['fifthField'];
       // for multiple inputs
    $skills = $_POST['skll'];
    $skillss = implode(',',$skills);    // for multiple inputs
    $country = $_POST['contree'];

    // SQL Query to insert into table kecforms
    $sql="INSERT INTO form (name, phoneNumber, Email, gender, address, skills, country) VALUES ('$name','$phone','$email','$gender','$address','$skillss','$country')";

    // If the connection is successful run the query
    if($connect->query($sql)){
        echo "The Data has been inserted";
    }
    
?>