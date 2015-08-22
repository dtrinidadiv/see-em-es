<?php
// set page headers
    $page_title = "Create Chapter";
    include_once 'header.php';
      
    
    // get database connection
    include_once '../classes/database.php';
 
    $database = new Database();
    $db = $database->getConnection();
    
    // if the form was submitted
    if($_POST){
     
        // instantiate product object
        include_once '../classes/chapter.php';
        $chapter = new Chapters($db);
     
        // set chapter property values
        $chapter->cTitle = $_POST['cTitle'];
        $chapter->cDesc = $_POST['cDesc'];
     
        // create the Chapter
        if($chapter->create()){
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
<form action='create_chapter.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Title</td>
            <td><input type='text' name='cTitle' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Desription</td>
             <td><input type='text' name='cDesc' class='form-control' /></td>
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