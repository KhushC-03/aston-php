



<?php
    session_start(); 
    function info(){
        include('connection.php');
        
        if (!empty(trim($_POST['id']))){
            
        } else{
            echo '{"success":false,"message":"request id not provided"}'; exit;
        }
        if (isset($_POST['id'])){ 
            $id = $_POST['id'];
            
        } else {
            echo '{"success":false,"message":"request id not provided"}'; exit;
        }
        if (!empty(trim($_POST['id']))){
            $sth = $db->prepare("SELECT ALL name,email,keyprogramming,profile,education,URLlinks FROM cvs WHERE id = :id");    
            
            $sth->bindParam(':id', $id);  
                
            $sth->execute();
            $results = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                echo '{"success":true,"message":"request info found","name":"'.$result['name'].'","email":"'.$result['email'].'","languages":"'.$result['keyprogramming'].'","profile":"'.$result['profile'].'","education":"'.$result['education'].'","urls":"'.$result['URLlinks'].'"}'; exit;

            }

        }
        else{
            echo '{"success":false,"message":"request id not provided"}'; exit;
        }

    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        info();
    }
    else{
        echo '{"success":false,"message":"wrong request method"}'; exit;
    }
?>