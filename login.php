<?php
    session_start(); 
    function returnError($message){
        $register = "'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/register.php'";
        echo '
                <style type="text/css">
                    div{
                        text-align: center;
                    }
                    input{
                        display: inline-block;
                        width:300px;
                        height:30px;
                        margin-top:20px;
                    }
                </style>
                
                
                <div>
                <h1>'.$message.'</h1>
                <form method = "post" action="https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/login.php">
                    <br>
                    <input type="text" placeholder="Email" name="email" value="">
                    <br>
                    <input type="password" placeholder="Password" name="password" value="">
                    <br>
                    <input type="submit" placeholder="Login!" name="submit" value="Login!">
                    <br>
                    <input type="button" placeholder="Register!" name="submit" value="Register!" onclick="window.location = '.$register.'">
                </form>
            
            </div>'; exit;
    }
    function login(){
        include('connection.php');
        if (!empty(trim($_POST['email']))){
        } else{
            returnError("Please input your email"); exit;
        }
        if (isset($_POST['email'])){ 
            $email = $_POST['email'];
        } else {
            returnError("Please input your email"); exit;
        }
        if (!empty(trim($_POST['password']))){

            $sth = $db->prepare("SELECT password FROM cvs WHERE email = :email");    
            $sth->bindParam(':email', $email);        
            $sth->execute();
            $password = password_verify($_POST['password'], $sth->fetchColumn());
            if ($password){
                $_SESSION["user"] = $email;
                header("Location:https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/mycv.php",302);
            } else {
                returnError("Wrong password"); exit;
            }
            abc@gmail.com
            abc123
            
        }else {
            returnError("You forgot to enter your password!"); exit;
        }
            
    }
    if (isset($_SESSION['user'])) {
        header("Location:https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/mycv.php",302);
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            login();
        }
        else{
            returnError("Login"); exit;
        }
    }
?>