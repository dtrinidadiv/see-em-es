<?php
// set page headers
    $page_title = "Post";
    include_once 'header.php';

    
    // get database connection
    include_once '../classes/database.php';
 
    $database = new Database();
    $db = $database->getConnection();
    
    // if the form was submitted
    if($_POST){
     
        // instantiate product object
        include_once '../classes/post.php';
        $post = new Posts($db);
     
        // set product property values
        $post->pTitle = $_POST['pTitle'];
        $post->pContent = $_POST['pContent'];
        $post->cID = $_POST['cID'];
     
        // create the product
        if($post->create()){
            echo "<div class=\"alert alert-success alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "post was created.";
            echo "</div>";
        }
     
        // if unable to create the product, tell the user
        else{
            echo "<div class=\"alert alert-danger alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Unable to create post.";
            echo "</div>";
        }
    }

?>
<!-- HTML form for creating a product -->
<form action='create_post.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Title</td>
            <td><input type='text' name='pTitle' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Content</td>
            <td><textarea rows="20"  type='text' name='pContent' class='form-control' /></textarea></td>
        </tr>
 
 
        <tr>
            <td>Chapter</td>
            <td>
                    <?php
                    // read the product categories from the database
                    include_once '../classes/chapter.php';
                 
                    $chapter = new Chapters($db);
                    $stmt = $chapter->read();
                 
                    // put them in a select drop-down
                    echo "<select class='form-control' name='cID'>";
                        echo "<option>Select category...</option>";
                 
                        while ($row_chapter = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row_chapter);
                            echo "<option value='{$cID}'>{$cTitle}</option>";
                        }
                 
                    echo "</select>";
                    ?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>

</form>
<div class="form-group pull-right">
<a type="button" class="btn btn-sm btn-warning" href="create_chapter.php" >
    <span class="glyphicon glyphicon-plus-sign"></span> Create Chapter
  </a>
  <a type="button" class="btn btn-sm btn-warning"  href="create_post.php" >
    <span class="glyphicon glyphicon-pencil"></span> Create Post
  </a>
  <a type="button" class="btn btn-sm btn-warning"  href="read_chapter.php">
    <span class="glyphicon glyphicon-search"></span> View Chapter
  </a>
  <a href="index.php" type="button" class="btn btn-sm btn-warning">
  <span class="glyphicon glyphicon-list-alt"></span> View Post</a>
 
 </div> 
<?php
// paging buttons here

include_once 'footer.php';
?>