<?php 

include("signup.php");


if(isset($_POST['submit'])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $user_type = $_POST["user_type"];


    if ($password !== $cpassword) {
        echo "Password does not match confirm password";
        exit();
    }else{
        $sql = "INSERT INTO users (firstname, lastname, email, password, user_type) VALUES ('$firstname', '$lastname', '$email', '$password', '$user_type')";
        
        if ($conn->query($sql) === TRUE){
            echo "Sign up successfull";
        }else{
            echo "Error" . $sql . '<br>' . $conn->error;
        }
}
}


?>