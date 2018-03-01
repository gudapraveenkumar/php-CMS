<div class="col-md-4">

<!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="searchVal" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="searchsubmit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
    <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    
    <div class="well">
        <h4>Blog Categories</h4>
        
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
<!--                    // ------------------------- Getting the list of categories -------------->
                     <?php
                        $query = "select * from categories";
                        $results = mysqli_query($connection, $query);
                        if(mysqli_num_rows($results) > 0){
                            while($row = mysqli_fetch_assoc($results)){
                                echo "<li><a href='#'>{$row['cat_title']}</a></li>";
                            }
                        }
                    ?>  
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
    <!-- /.row -->
    </div>
<!-- Side Widget Well -->
        <?php include "widget.php"; ?>

    </div>