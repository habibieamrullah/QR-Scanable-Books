<?php

$sqlBooks = "CREATE TABLE IF NOT EXISTS books (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NOT NULL,
slug VARCHAR(30) NOT NULL,
uniqid VARCHAR(30) NOT NULL,
category INT(6) NOT NULL
)";

$sqlCategories = "CREATE TABLE IF NOT EXISTS categories (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NOT NULL
)";

mysqli_query($connection, $sqlBooks);
mysqli_query($connection, $sqlCategories);

?>
<a href="?admin">Semua Buku</a> | 
<a href="?admin&tambahbuku">Tambah Buku</a> | 
<a href="?admin&kategoribuku">Pengaturan Kategori</a> | 
<?php

if(isset($_GET["tambahbuku"])){
    ?>
    
    <h2>Tambah Buku</h2>
    <div id="formblock">
        <form id="uploadform" method="post">
            <label>Judul</label>
            <input id="ftitle" name="title" placeholder="Judul"><br>
            <label>Sampul</label>
            <input type="file" name="cover" id="fcover" accept="image/png, image/jpeg"><br>
            <label>File PDF</label>
            <input type="file" name="pdf" id="fpdf" accept="application/pdf"><br>
            <label>Kategori</label>
            <select name="category">
                <option value=0>Pilih Kategori</option>
                <?php
                $sql = "SELECT * FROM categories ORDER BY id DESC";
                $result = mysqli_query($connection, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value=" .$row["id"]. ">" . $row["title"] . "</option>";
                        }
                    }
                }
                ?>
            </select><br>
            <input name="username" value="<?php echo $unm ?>" style="display: none;"><input name="password" value="<?php echo $pwd ?>" style="display: none;">
        </form>
        <button onclick="uploadContent()">Upload</button>
    </div>
    <div id="progressblock" style="display: none; background-color: #f5f5f5;">
        <h3 align="center">Tunggu sejenak, sedang proses upload... <span id="upperc">0</span>%</h3>
        <div id="uploadprogress" style="display: block; width: 0%; background-color: green; height: 1em;"></div>
    </div>
    <script>
        function uploadContent(){
            $("#formblock").hide();
            $("#progressblock").show();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            console.log("Percentage: " + percentComplete);
                            // Place upload progress bar visibility code here
                            $("#uploadprogress").css({
                                "width" : percentComplete + "%",
                            });
                            $("#upperc").html(Math.round(percentComplete));
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: "upload.php",
                data: new FormData($('#uploadform')[0]),
                success: function(data){
                    // Do something on success
                    location.href="?admin";
                },
                cache: false,
                contentType: false,
                processData: false,
            });
            
        }
    </script>
    <?php
}else if(isset($_GET["kategoribuku"])){
    
    ?>
    <h2>Kategori Buku</h2>
    
    <?php
    
    if(isset($_POST["categorytitle"])){
        $categorytitle = mysqli_real_escape_string($connection, $_POST["categorytitle"]);
        mysqli_query($connection, "INSERT INTO categories (title) VALUES ('$categorytitle')");
        echo "Kategori baru telah ditambahkan.";
    }else{
        
        if(isset($_GET["edit"])){
            $id = mysqli_real_escape_string($connection, $_GET["edit"]);
            
            
            $result = mysqli_query($connection, "SELECT * FROM categories WHERE id = $id");
            if($result){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    
                    if(isset($_POST["newcategorytitle"])){
                        $newcategorytitle = mysqli_real_escape_string($connection, $_POST["newcategorytitle"]);
                        mysqli_query($connection, "UPDATE categories SET title = '$newcategorytitle' WHERE id = $id");
                        echo "Kategori berhasil diperbarui."  . $newcategorytitle;
                    }else{
                        ?>
            
                        <h3>Edit Kategori</h3>
                        <form method="post">
                            <input name="newcategorytitle" value="<?php echo $row["title"] ?>"><br>
                            <input type="submit" value="Perbarui">
                        </form>
                    
                        <?php
                    }
                    
                }else{
                    echo "Error!";
                }
            }else{
                echo "Error!";
            }
            
        }else{
            if(isset($_GET["hapus"])){
                $id = mysqli_real_escape_string($connection, $_GET["hapus"]);
                mysqli_query($connection, "DELETE FROM categories WHERE id = $id");
            }
            
            $sql = "SELECT * FROM categories ORDER BY id DESC";
            $result = mysqli_query($connection, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "- " . $row["title"] . " | <a href='?admin&kategoribuku&edit=" . $row["id"] . "'>Edit</a> | <a href='?admin&kategoribuku&hapus=" . $row["id"] . "'>Hapus</a><br>";
                    }
                }else{
                    echo "Belum ada kategori yang ditambahkan.";
                }
            }
            
            ?>
        
            <h2>Tambah Kategori</h2>
            <form method="post">
                <input name="categorytitle"><br>
                <input type="submit" value="Tambahkan">
            </form>
        
            <?php
        }
        
        
    }
    
   
}else{
    
    if(isset($_GET["hapusbuku"])){
        $id = mysqli_real_escape_string($connection, $_GET["hapusbuku"]);
        $sql = "SELECT * FROM books WHERE id = $id";
        $result = mysqli_query($connection, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                
                if(file_exists("upl/" . $row["slug"] . ".pdf"))
			        unlink("upl/" . $row["slug"] . ".pdf");
			    if(file_exists("upl/" . $row["slug"] . ".jpeg"))
			        unlink("upl/" . $row["slug"] . ".jpeg");
			    if(file_exists("upl/" . $row["slug"] . "-qr.png"))
			        unlink("upl/" . $row["slug"] . "-qr.png");
                
                mysqli_query($connection, "DELETE FROM books WHERE id = $id");
                
                ?>
                <h2>Hapus Buku</h2>
                <p>Buku <b><?php echo $row["title"] ?></b> berhasil dihapus.</p>
                <?php
            }else{
                echo "Terjadi kesalahan!";
            }
        }
    }else{
        ?>
        <h2>Daftar Buku</h2>
        <?php
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $result = mysqli_query($connection, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                echo "<table><tr><th>Judul</th><th>QR Code</th><th>Hapus Buku</th></tr>";
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row["title"] ?></td>
                        <td><a href="upl/<?php echo $row["slug"] ?>-qr.png" target="_blank">Tampilkan QRCode</a></td>
                        <td><a href="?admin&hapusbuku=<?php echo $row["id"] ?>">Hapus</a></td>
                    </tr>
                    <?php
                }
                echo "</table>";
            }else{
                echo "Belum ada buku.";
            }
        }
    }
    
}

?>
