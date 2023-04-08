<?php

session_start();

include("db.php");


$title = $booksitetitle;
$content = "";
$footer = "<div align='center' style='padding: 3em;'>© " . date("Y") . " Kanz Digital Library. All rights reserved.</div>";

//Halaman Admin
if(isset($_GET["admin"])){
    
    $title = "Halaman Admin";
    $stitle = "<h1 style='margin-bottom: 1em;'>Halaman Admin</h1>";
    
    if(isset($_SESSION["username"])){
        ob_start();                      
        include('admin.php');   
        $scontent = ob_get_contents();    
        ob_end_clean();
    }else{
        if(isset($_POST["username"])){
            if($_POST["username"] == $unm && $_POST["password"] == $pwd){
                $scontent = "Login Berhasil!
                    <script>
                        setTimeout(function(){
                            location.href = '?admin';
                        }, 1000);
                    </script>
                ";
                $_SESSION["username"] = $unm;
                $_SESSION["password"] = $pwd;
            }else{
                $scontent = "Login Gagal!";
            }
        }else{
            $scontent = '
                <div class="loginblock">
                    <h2>Silahkan login terlebih dahulu</h2>
                    <form method="post">
                        <input type="text" placeholder="Username" name="username"><br>
                        <input type="password" placeholder="Password" name="password"><br>
                        <input type="submit" value="Login" class="submitbutton">
                    </form>
                </div>
            ';
        }
    }
    
    
    $content = $stitle . $scontent;
}else{
    ob_start();                      
    include('home.php');   
    $content = ob_get_contents();    
    ob_end_clean();
}