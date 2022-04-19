



<?php
    session_start(); 
    function updateinfo(){
        include('connection.php');
        
        if (!empty(trim($_POST['password']))){
            
        } else{
            echo '{"success":false,"message":"password not provided"}'; exit;
        }
        if (isset($_POST['email'])){
            
        } else{
            echo '{"success":false,"message":"email not provided"}'; exit;
        }
        $sth = $db->prepare("UPDATE cvs SET name = :name, keyprogramming =:keyprogramming, profile =:profile, education=:education, URLlinks =:URLlinks WHERE email = :email");
        if (!empty(trim($_POST['email']))){
            $sth->bindParam(':email', $_POST['email']); 

            $stgh = $db->prepare("SELECT password FROM cvs WHERE email = :email");    
            $stgh->bindParam(':email', $_POST['email']);        
            $stgh->execute();
            $password = password_verify($_POST['password'], $stgh->fetchColumn()); 
            if (! $password){echo '{"success":false,"message":"password is incorrect"}'; exit;} 
            else{
                $sthh = $db->prepare("SELECT ALL name,email,keyprogramming,profile,education,URLlinks FROM cvs WHERE email = :email");    
            
                $sthh->bindParam(':email', $_POST['email']);  
                    
                $sthh->execute();
                $results = $sthh->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $result) {
                    if ($result['name'] == ""){
                        $name = " ";
                    }else{
                        $name = $result['name'];
                    }
                    if ($result['email'] == ""){
                        $email = " ";
                    }else{
                        $email = $result['email'];
                    }
                    if ($result['keyprogramming'] == ""){
                        $language = " ";
                    }else{
                        $language = $result['keyprogramming'];
                    }
                    if ($result['profile'] == ""){
                        $profile = " ";
                    }else{
                        $profile = $result['profile'];
                    }
                    if ($result['education'] == ""){
                        $education = " ";
                    }else{
                        $education = $result['education'];
                    }
                    if ($result['URLlinks'] == ""){
                        $urls = " ";
                    }else{
                        $urls = $result['URLlinks'];
                    }

 
    
                }
            }
        } else{
            echo '{"success":false,"message":"email not provided"}'; exit;
        }   
        if (! isset($_POST['email'])){
            
        } else{
            $email = $_POST['email'];
        }  
        if (! isset($_POST['name'])){
            
        } else{
            $name = $_POST['name'];
        }
        if (! isset($_POST['language'])){
            
        } else{
            $language = $_POST['language'];
        }
        if (! isset($_POST['profile'])){
            
        } else{
            $profile = $_POST['profile'];
        }
        if (! isset($_POST['education'])){
            
        } else{
            $education = $_POST['education'];
        }
        if (! isset($_POST['urls'])){
            
        } else{
            $urls = $_POST['urls'];
        }
        $data = [
            'name' => $name,
            'keyprogramming' => $language,
            'profile' => $profile,
            'education' => $education,
            'URLlinks'=>$urls,
            'email' => $email
        ];
        $sth->execute($data);
        echo '{"success":true,"message":"request info updated"}'; exit;

    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        updateinfo();
    }
    else{
        echo '{"success":false,"message":"wrong request method"}'; exit;
    }
?>