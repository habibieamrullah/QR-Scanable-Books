<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $booksitetitle ?></title>
        <meta charset="utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <script src="jquery-3.6.4.min.js"></script>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400&display=swap" rel="stylesheet">
        
        <style>
            body{
                background-color: black;
                font-family: 'Quicksand', sans-serif;
            }
            #container{
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                text-align: center;
            }
            .resize_fit_center {
                height: 100%;
                max-width:100%;
                max-height:100%;
                vertical-align: middle;
                
            }
            
            input{
                padding: 0.5em;
                display: block;
                margin: 0.2em;
            }
            
            button{
                margin: 0.2em;
            }
        </style>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    
    <body>
        
        <?php
        $locked = false; 
        $slug = "";
        $pin = "";
        if(isset($_GET["code"])){
            $code = mysqli_real_escape_string($connection, $_GET["code"]);
            $sql = "SELECT * FROM books WHERE uniqid = '$code'";
            $result = mysqli_query($connection, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    if($row["locked"] == 1){
                        $locked = true;
                    }
                    $slug = $row["slug"];
                    ?>
                    <div id='container'>
                        <img onclick="openbook('<?php echo $slug ?>')" class='resize_fit_center' src="upl/<?php echo $slug ?>.jpg" />
                    </div>
                    <?php
                }
            }
        }
        ?>
        
        <script>
            function openbook(slug){
                //alert(slug);
                <?php
                if($locked){
                    ?>
                    //alert("Buku ini dikunci...");
                    $("body").append("<div id='pininput' style='position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.75); display: table; width: 100%; height: 100%;'><div style='display: table-cell; vertical-align: middle; text-align: center;'><div style='background-color: white; padding: 1em; display: inline-block;'><label>Masukkan PIN</label><input id='pin' type='password' placeholder='PIN'><button onclick='unl()'>OK</button></div></div></div>");
                    <?php
                }else{
                    ?>
                    $("body").append('<div id="myweb" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"> <iframe src="pdfjs/web/viewer.html?file=<?php echo $baseurl ?>/upl/' +slug+ '.pdf#toolbar=0" width="100%" height="100%" title="Buku" style="border: none;"></iframe> </div>');
                    <?php
                }
                ?>
            }
            
            function unl(){
                var upn = $("#pin").val();
                <?php
                $cp = "";
                $result = mysqli_query($connection, "SELECT * FROM options WHERE opkey = 'currentpin'");
                if($result){
                    $cp = mysqli_fetch_assoc($result)["opvalue"];
                }
                ?>
                if(upn == "<?php echo $cp ?>"){
                    $("body").append('<div id="myweb" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"> <iframe src="pdfjs/web/viewer.html?file=<?php echo $baseurl ?>/upl/<?php echo $slug ?>.pdf#toolbar=0" width="100%" height="100%" title="Buku" style="border: none;"></iframe> </div>');
                }else{
                    location.reload();
                }
            }
        </script>
    </body>
    
</html>