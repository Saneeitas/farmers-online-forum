<?php

session_start();

 require "inc/process.php";
 require "inc/header.php";   
 // require "body.php"; 

 ?>
<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
    <img class="d-block mx-auto my-4 mb-4" src="./images/farm.PNG" style="border-radius: 15px" alt="" width="750" height="350">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <?php
              //displ+aying the posts from database
              $sql = "SELECT * FROM posts ORDER BY id DESC";
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
                                <h5 class="card-title"><?php echo $result["title"]; ?></h5>
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
            <div class="col-4">
                <!--Side bar--->
                <div class="border p-3">
                    <form action="search.php" method="post">
                        <div class="form-group">
                            <h4>Search</h4>
                            <input type="text" class="form-control" name="search" placeholder="Enter Search Keyword" id=""
                                required>
                        </div>
                        <button type="submit" class="btn text-light mt-2"
                            style="background-color:#d16943;">Search</button>

                    </form>
                </div>

                <div class="border p-3">
                    <h4>Categories</h4>
                    <ul>
                        <?php
							$sql_c = "SELECT * FROM category ORDER BY id DESC";
							$query_c = mysqli_query($connection,$sql_c);
							while ($result_c = mysqli_fetch_assoc($query_c)) { 
								   ?>
                        <li>
                            <a href="post-category.php?post_category_id=<?php echo $result_c["id"];?>">
                                <?php echo $result_c["name"] ?></a>
                        </li>
                        <?php
						   }
						?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require './pages/footer-home.php'; ?>
</div>

 <?php 
 require "inc/footer.php"; 
 ?>
