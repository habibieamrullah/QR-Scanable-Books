<?php

session_start();

include("db.php");


$title = "Scan Buku - Perpus ICC Jakarta";
$content = "";
$footer = "<div style='text-align: center;'>
    <div class='footeritem'><a href='index.php'>Beranda</a></div>
    <div class='footeritem'>Blah</div>
    <div class='footeritem'>Blah</div>
    <div class='footeritem'>Blah</div>
</div>";
$footer = "<div align='center'>Shalawat</div>";

//Halaman Admin
if(isset($_GET["admin"])){
    
    $title = "Halaman Admin";
    $stitle = "<h1>Halaman Admin!</h1>";
    
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
                <form method="post">
                    <input type="text" placeholder="Username" name="username"><br>
                    <input type="password" placeholder="Password" name="password"><br>
                    <input type="submit" value="Login">
                </form>
            ';
        }
    }
    
    
    $content = $stitle . $scontent;
}