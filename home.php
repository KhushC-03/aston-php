<?php
    session_start(); 
    $logout = "'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/logout.php'";
    $login = "'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/login.php'";  
    $mycv = "'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/mycv.php'";
    $error = 'Please enter a search parameter';
    include('connection.php');

        $sth = $db->prepare("SELECT ALL id,name,email,keyprogramming FROM cvs");                
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    ?>     
    <style type="text/css">
    @font-face {
        font-family: Harabara; src: url('https://raw.githubusercontent.com/KhushC-03/khushbot-assets/main/madani-medium.ttf');
    }
    html{
        font-family: Harabara;
        scroll-behavior: smooth;
        letter-spacing:0.07em;
        width: auto!important; 
        overflow-x: hidden scroll !important;
        -ms-overflow-style: none;
        scrollbar-width: none;     
        -webkit-overflow-scrolling: touch;       
    }

    input{
        display: inline-block;
        
    }
    .nav{
        background-color:#cdcdcd;
        width: 100%;
        height: 80px;
    }
    .info{
        top: 53%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        position: fixed;
        text-align: center;
        display:none;
        background-color:#cdcdcd;
        width: 90vw;
        height: 400px;
    }
    .searchbox{
        height: 40px;
        width: 60vw;
        margin-bottom: 15px;
    }
    .searchbutton{
        height: 40px;
        width: 5em;
    }
    .container{
        position: relative;
    }
    .search{
        margin-top: 70px;
        text-align: center;
    }
    table{
        width: 60vw;
        background-color:#cdcdcd;
        border-radius:5px;
        margin-left:auto;
        margin-right:auto;
        text-align: center; 
        border-spacing: 10px;
        display:relative;
    }

    .exit{
        font-size:1.4em;
        text-align: center;
        margin-top:10px;
        margin-left:10px;
    }
    .exitButton{
        text-align: left;
    }
    .infoContent{
        margin-top:10px;
        margin-left:30px;
        text-align: left;
    }
    .logout{
        margin-left:15px;
        margin-top:20px;
        font-size:2em;
        border:none !important;
        border-radius:5px;
    }
</style>




<html>
    <div class="nav">
    <input type="button" value="Register" class="logout" onclick="window.location = 'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/register.php'">
    <?php
        if (isset($_SESSION['user'])) {
            echo '<input type="button" value="Logout" class="logout" onclick="window.location = '.$logout.'">';
        }else{
            echo '<input type="button" value="Login" class="logout" onclick="window.location = '.$login.'">';

        }
    ?>    
        
        <input type="button" value="All CVS" class="logout" onclick="window.location = 'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/home.php'">
        <?php
            if (isset($_SESSION['user'])) {
                echo '<input type="button" value="My CV" class="logout" onclick="window.location = '.$mycv.'">';
            }
        ?>    
    </div>
    <div class="search">
    
        <form method = "post" action="https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/home.php">
            <input type="button" value="See All" name='search' class="searchbutton" onclick="window.location = 'https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/home.php'">
            <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                if (!empty(trim($_POST['searchkey'])) || $_POST['searchkey'] == ""){
                    echo '<input type="text" placeholder="'.$error.'" name="searchkey" class="searchbox" value="">';
                } 
                else{
                    echo '<input type="text" placeholder="Search CSV" name="searchkey" class="searchbox" value="">';
            }}else{
                echo '<input type="text" placeholder="Search CSV" name="searchkey" class="searchbox" value="">';
            }  
        ?> 
            
            <input type="submit" value="Search!" name='search' class="searchbutton">
        </form>
    </div>
    <div class="info">
        <div class="exitButton"><input value="exit" class="exit" type="button" onclick="getInfo()"/></div>
        <div class="infoContent">
            <div class="name">
                Name:
            </div>
            <div class="email">
                Email:
            </div>
            <div class="languages">
                Programming Languages:
            </div>
            <div class="profile">
                Profile Info:
            </div>
            <div class="education">
                Education:
            </div>
            <div class="links">
                Urls:
            </div>
        </div>
        
    </div>
    <div class="container">
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th> 
                <th>Programming Languages</th>
                <th>Extra</th>
            </tr>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                    if (!empty(trim($_POST['searchkey']))){
                        $searchkey = $_POST['searchkey'];
                        $sth = $db->prepare("SELECT ALL name,email,keyprogramming,profile,education,URLlinks,id FROM cvs WHERE 1");                                
                        $sth->execute();
                        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($results as $result) {
                            if (strpos(strtolower($result["name"]), strtolower($searchkey)) !== false || strpos(strtolower($result["keyprogramming"]), strtolower($searchkey)) !== false || strpos(strtolower($result["email"]), strtolower($searchkey)) !== false){
                                echo' <tr>
                                <td>'.$result["name"].'</td>
                                <td>'.$result["email"].'</td> 
                                <td>'.$result["keyprogramming"].'</td>
                                <td  onclick=getInfo("'.$result["id"].'") style="cursor: pointer">More Info</td>
                            </tr>'; 
                            }
            
                        }
                    } 
                    else{
                        $error = 'Please enter a search parameter';
                }
                }else{
                    foreach ($results as $result) {
                        echo' <tr>
                            <td>'.$result["name"].'</td>
                            <td>'.$result["email"].'</td> 
                            <td>'.$result["keyprogramming"].'</td>
                            <td  onclick=getInfo("'.$result["id"].'") style="cursor: pointer">More Info</td>
                        </tr>';
                    }
                }


            ?>  
        </table>
    </div>
</html>


<script>
    function getInfo(id=false){
        if (document.querySelector('.info').style.display == 'block'){
            document.querySelector('.info').style.display = 'none';
            document.querySelector('.container').style.display = 'block';
        }
        else{
            document.querySelector('.info').style.display = 'block';
            document.querySelector('.container').style.display = 'none';
            document.querySelector('.links').innerHTML = '';
        }

        var formdata = new FormData();
        formdata.append("id", id);

        var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
        };

        fetch("https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/info.php", requestOptions)
        .then(response => response.json())
        .then(res => {
            document.querySelector('.name').innerHTML = "Name: "+res.name
            document.querySelector('.email').innerHTML = "Email: "+res.email
            document.querySelector('.languages').innerHTML = "Programming Languages: "+res.languages
            document.querySelector('.profile').innerHTML = "Profile Info: "+res.profile
            document.querySelector('.education').innerHTML = "Education: "+res.education
            if (res.urls.includes('http')){
                if (res.urls.includes(',')){
                    urls = res.urls.split(",");
                    console.log(urls)
                    for (var i = 0; i < urls.length; i++) {
                        document.querySelector('.links').innerHTML +=  `<a href="${urls[i]}">${urls[i]}</a><br>`
                    }
                }
                else{
                    document.querySelector('.links').innerHTML = `<a href="${res.urls}">${res.urls}</a>`
                }
                
            }
        })



    }

</script>      