<?php
    session_start();
    function returnError($message,$name=false,$email=false){
        $login = "'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/login.php'";
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
                    <form method = "post" action="https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/register.php">
                        <input type="text" placeholder="Name" name="name" value="'.$name.'">
                        <br>
                        <input type="text" placeholder="Email" name="email" value="'.$email.'">
                        <br>
                        <input type="password" placeholder="Password" name="password" value="">
                        <br>
                        <input type="password" placeholder="Confirm Password" name="passwordconfirm" value="">
                        <br>
                        <input type="submit" placeholder="Register!" name="submit" value="Register!">
                        <br>
                        <input type="button" placeholder="Login!" name="submit" value="Login!" onclick="window.location = '.$login.'">
                    </form>
                
                </div>'; exit;
    }

    
    function register(){
        include('connection.php');
        if (!empty(trim($_POST['name']))){
        } else{
            returnError("Please input your name"); exit;
        }
        if (!empty(trim($_POST['email']))){
        } else{
            returnError("Please input your email",$_POST['name']); exit;
        }
        if (!empty(trim($_POST['password'])) && !empty(trim($_POST['passwordconfirm']))){
        } else{
            returnError("You forgot to enter your password!",$_POST['name'],$_POST['email']); exit;
        }
        if (isset($_POST['name'])){ 
            $name = $_POST['name'];
        } else {
            returnError("Please input your name"); exit;
        }
        if (isset($_POST['email'])){ 
            $email = $_POST['email'];
            $sth = $db->prepare("SELECT email FROM cvs WHERE email = :email");    
            $sth->bindParam(':email', $email);        
            $sth->execute();
            if ($sth->rowCount()> 0){
                returnError("Your email is already in our database, please login"); exit;
            }else{
            }
        } else {
            returnError("Please input your email",$name); exit;
        }
        if (!empty(trim($_POST['password']))){
            if ($_POST['password'] == $_POST['passwordconfirm']){
                
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, [ "cost" => 15 ]);
                $sth= $db->prepare("INSERT INTO cvs(name,password,email) VALUES(:name,:password,:email) ");
                $sth->bindParam(':name', $name, PDO::PARAM_STR, 20);
                $sth->bindParam(':password', $password, PDO::PARAM_STR, 200);
                $sth->bindParam(':email', $email, PDO::PARAM_STR, 20);
                $sth->execute();
                $_SESSION['user'] = $email;
                header("Location:https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/home.php",302);
            }
            else{
                returnError("Your passwords do not match",$name,$email); exit;
            }
        }else {
            returnError("You forgot to enter your password!",$name,$email); exit;
        }      
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        register();
    } else {
        returnError("Registration"); exit;
        }
        
