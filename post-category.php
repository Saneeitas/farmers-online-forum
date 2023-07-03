<?php
session_start();
 require "inc/process.php";
 require "inc/header.php";

 if(isset($_GET["post_category_id"]) && !empty($_GET["post_category_id"])){
   $id = $_GET["post_category_id"];
 }else{
   header("location: index.php");   
 }
 
 ?>

<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="border p-3">
                    <ul style="display:flex; list-style-type:none;">
                        <?php
        $sql_c ="SELECT * FROM category ORDER BY id DESC";
        $query_c = mysqli_query($connection,$sql_c);
        $count = 0;
        while ($result_c = mysqli_fetch_assoc($query_c)) { 
            ?>
                        <li style="<?php echo $count >0 ? 'margin-left:10px;' : '' ?>">
                            <a href="post-category.php?post_category_id=<?php echo $result_c["id"]; ?>"
                                class="<?php echo $result_c["id"] == $id? 'text-danger' : '' ?>">
                                <?php echo $result_c["name"]; ?></a>
                        </li>
                        <?php
             $count++;
        }
     ?>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <?php
              $sql = "SELECT * FROM posts WHERE category_id ='$id' ORDER BY id DESC";
              $query = mysqli_query($connection,$sql);
               while($result = mysqli_fetch_assoc($query)) { 
                //Looping through the col for multiples post
                ?>
                    <div class="col-4 mt-2">
                        <div class="card">
                            <div class="card-body">
                            <?php
                            $id = $result["category_id"];
                            $sql = "SELECT * FROM category WHERE id=$id";
                            $query2 = mysqli_query($connection, $sql);
                            $result2 = mysqli_fetch_assoc($query2);
                            ?>
                                <h5 class="card-title"><?php echo $result2["name"]; ?></h5>
                                <p class="card-title">
                                    <?php 
                                        $content = $result["content"];
                                        $shortContent = substr($content, 0, 70); // Shorten the content to the desired length (e.g., 100 characters)
                                        echo $shortContent;
                                    ?>...
                                </p>
                                <a href="read-post.php?post_id=<?php echo $result["id"]; ?>">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
            }
          ?>
                </div>
            </div>

        </div>
    </div>
    <?php require './pages/footer-home.php'; ?>
</div>

<?php
 require "inc/footer.php"; 
 ?>