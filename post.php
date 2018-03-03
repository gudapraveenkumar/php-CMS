<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                
                if(isset($_GET['p_id'])){
                    
                    $post_id = $_GET['p_id'];
                    
                }
                
                    $post_query = "select * from posts where id = {$post_id}";
                  
                    $post_results = mysqli_query($connection, $post_query);
                    if(mysqli_num_rows($post_results) > 0){
                        
                   
                        while($row = mysqli_fetch_assoc($post_results)){
                            
                            $post_title = $row['title'];
                            $post_author = $row['author'];
                            $post_date = $row['date'];
                            $post_content = $row['content'];
                            $post_image = $row['image'];
                ?>
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>
                <?php
                     }
                }
                
                ?>
                
                 <!-- Blog Comments -->
                
                <?php
                
                    if(isset($_POST['create_comment'])){
                        
                        $post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $comment_status = 'unapproved';
                        
                        $post_comment_query = "insert into comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) values({$post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now())";
                        
                        $post_comment_result = mysqli_query($connection, $post_comment_query);
                        if(!$post_comment_result){
                            die("Query Failed". mysqli_error($connection));
                        }
                        
                        $update_comment_count_query = "UPDATE posts SET comment_count=comment_count+1 WHERE id = {$post_id}";
                        $update_comment_result = mysqli_query($connection, $update_comment_count_query);
                        if(!$update_comment_result){
                            die("Query Failed". mysqli_error($connection));
                        }
                        
                    }
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="author">Your Name</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="author">Email</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                
                <?php
                    $post_id = $_GET['p_id'];
                    
                    $get_all_comments_query = "select * from comments where comment_post_id = {$post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
                    
                    $get_all_comments_result = mysqli_query($connection, $get_all_comments_query);
                    
                    if(!$get_all_comments_result){
                        die("Query Failed". mysqli_error($connection));
                    }else{
                        while($row = mysqli_fetch_assoc($get_all_comments_result)){
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_date = $row['comment_date'];;
                ?>
                
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo "{$comment_author}"; ?>
                            <small><?php echo "{$comment_date}"; ?></small>
                        </h4>
                        <?php echo "{$comment_content}"; ?>
                        
                        
                        
                        <!-- Nested Comment -->
<!--
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
-->
                        <!-- End Nested Comment -->
                    </div>
                </div>
                 <?php
                        }
                    }
                
                ?>

            </div>

                
                
               
                
                
                
                
            <!-- Blog Sidebar Widgets Column -->
            
             <?php  include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
<?php 
include "includes/footer.php";        
?>