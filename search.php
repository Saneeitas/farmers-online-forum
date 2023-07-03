<?php
session_start();
 require "inc/process.php";
 require "inc/header.php";
 
 if(isset($_POST["search"])){
     $search = $_POST["search"];
 }else{
     $search = '';
 }
 ?>

<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="border p-3">
                    <form action="search.php" method="post">
                        <div class="form-group">
                            <h4>Search result for: <?php echo $search; ?></h4>
                            <input type="text" class="form-control" name="search" placeholder="Enter Search Keyword" id=""
                                required>
                        </div>
                        <button type="submit" class="btn text-white mt-2"
                            style="background-color:#d16943;">Search</button>
                    </form>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <?php
              //displaying the search posts from database
              $searchterm = $_POST["search"];
              $sql = "SELECT * FROM posts WHERE content LIKE '%$searchterm%' ORDER BY id DESC";
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