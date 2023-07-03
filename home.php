<h1 align="center" onclick="location.href='index.php'" style="cursor: pointer;"><?php echo $booksitetitle ?></h1>
<div style="text-align: center; padding: 1em;">
    <div style="cursor: pointer; font-weight: bold; margin: 0.5em;" onclick="toggleCatList();"><i class="fa fa-bars"></i> Kategori Buku</div>
    <div id="catlist" style="display: none; background-color: #00caed; color: white; font-weight: bold;">
        <a href="index.php" style="text-decoration: none;"><div class="categoryitem">Semua Buku</div></a>
        <?php
        $result = mysqli_query($connection, "SELECT * FROM categories ORDER BY title ASC");
        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $catid = $row['id'];
                    ?>
                    <a href="index.php?catid=<?php echo $catid ?>" style="text-decoration: none;"><div class="categoryitem"><?php echo $row["title"] ?> (<?php echo mysqli_num_rows(mysqli_query($connection, "SELECT * FROM books WHERE category = $catid")) ?>)</div></a>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>

<div style="display: table; width: 100%; background-color: white; border-radius: 1em; padding: 0.2em; margin-bottom: 1em;">
    <div style="display: table-cell; width: 100%; box-sizing: border-box;"><input id="qs" placeholder="Cari Cepat" style="border: none; outline: none;" onkeyup="quickSearch()"></div>
    <div style="display: table-cell; width: 10%; padding-right: 1em; box-sizing: border-box; text-align: center; color: gray;"><i class="fa fa-search"></i></div>
</div>

<div style="text-align: center; display: grid; grid-template-columns: auto auto auto;">
    <?php
    $where = "";
    
    if(isset($_GET["catid"])){
        $catid = mysqli_real_escape_string($connection, $_GET["catid"]);
        $where = "WHERE category = $catid";
    }
    
    $sql = "SELECT * FROM books $where ORDER BY id DESC";
    $result = mysqli_query($connection, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="thumbnailblock" style="width: 100%; height: 100%;">
                    <a href="books.php?code=<?php echo $row["uniqid"] ?>"><img src="upl/<?php echo $row["slug"] ?>.jpg" style="box-sizing: border-box; padding: 0.5em; display: inline-block; vertical-align: middle; width: 100%; height: 100%;"></a>
                    <p style="display: none;"><?php echo $row["title"] ?></p>
                </div>
                <?php
            }
        }
    }
    ?>
</div>

<script>
    function toggleCatList(){
        $("#catlist").slideToggle();
    }
    
    function quickSearch(){
        var keyword = $("#qs").val();
        if(keyword != ""){
            for(var i = 0; i < $(".thumbnailblock").length; i++){
                if($(".thumbnailblock").eq(i).text().toUpperCase().indexOf(keyword.toUpperCase()) > -1){
                    $(".thumbnailblock").eq(i).show();
                }else{
                    $(".thumbnailblock").eq(i).hide();
                }
            }
        }else{
            $(".thumbnailblock").show();
        }
    }
</script>
