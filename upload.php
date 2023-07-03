<?php
include("db.php");
include("functions.php");

if(isset($_POST["username"]) && isset($_POST["password"])){
    if($_POST["username"] == $unm && $_POST["password"] == $pwd){
        $target_dir = "upl/";
        $target_file = $target_dir . basename($_FILES["pdf"]["name"]);
        $uniqid = uniqid();
        $title = mysqli_real_escape_string($connection, $_POST["title"]);
        if($title != ""){
            $slug = slugify($title);
            $category = mysqli_real_escape_string($connection, $_POST["category"]);
            
            if (isset( $_FILES['pdf'] ) ) {
            	if ($_FILES['pdf']['type'] == "application/pdf") {
            	    
            	    $pdfname = $_FILES["pdf"]["name"];
            	    $tmp = explode(".", $pdfname);
                    $pdfext = end($tmp);
            
            		$source_file = $_FILES['pdf']['tmp_name'];
            		//$dest_file = "upl/".$_FILES['pdf']['name'];
            		$dest_file = "upl/".$slug.".".$pdfext;
                       
                    
            		if (file_exists($dest_file)) {
            			print "The file name already exists!!";
            		}
            		else {
            			move_uploaded_file( $source_file, $dest_file )
            			or die ("Error!!");
            			if($_FILES['pdf']['error'] == 0) {
            				echo "PDF Upload OKE!";
            			}
            		}
            	}
            }
            
            if (isset( $_FILES['cover'] ) ) {
                //echo "Cover type: " . $_FILES['cover']['type'];
                
                
                
            	if ($_FILES['cover']['type'] == "image/jpeg" || $_FILES['cover']['type'] == "image/jpg" || $_FILES['cover']['type'] == "image/png") {
            	    
            	    $covername = $_FILES["cover"]["name"];
            	    $tmp = explode(".", $covername);
                    $coverext = end($tmp);
            
            		$source_file = $_FILES['cover']['tmp_name'];
            		//$dest_file = "upl/".$_FILES['pdf']['name'];
            		$dest_file = "upl/".$slug.".jpg";
                       
                    
            		if (file_exists($dest_file)) {
            			print "The file name already exists!!";
            		}
            		else {
            			move_uploaded_file( $source_file, $dest_file )
            			or die ("Error!!");
            			if($_FILES['cover']['error'] == 0) {
            				echo "Cover Upload OKE!";
            			}
            		}
            		
            	}
            	
            }
            
            mysqli_query($connection, "INSERT INTO books (title, slug, category, uniqid) VALUES ('$title', '$slug', $category, '$uniqid')");
            
            require_once('phpqrcode/qrlib.php'); 
            $qrvalue = $slug . "-qr";
    		$tempDir = "upl/"; 
    		$codeContents = $baseurl . "/books.php?code=" . $uniqid; 
    		$fileName = $qrvalue . '.png'; 
    		$pngAbsoluteFilePath = $tempDir.$fileName; 
    		$urlRelativeFilePath = $tempDir.$fileName; 
    		if (!file_exists($pngAbsoluteFilePath)) { 
    			QRcode::png($codeContents, $pngAbsoluteFilePath); 
    		}
        }
        
    }else{
        echo "Upload Error!";
    }
}

