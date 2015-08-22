<?php
$page_title = "Update Post";
include_once "header.php";

    echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Posts</a>";
    echo "</div>";
    
    // get ID of the product to be edited
    $id = isset($_GET['pID']) ? $_GET['pID'] : die('ERROR: missing ID.');
     
    // include database and object files
    include_once '../classes/database.php';
    include_once '../classes/post.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    // prepare post object
    $post = new Posts($db);
     
    // set ID property of product to be edited
    $post->pID = $id;
     
    // read the details of product to be edited
    $post->readOne();
    
    if($_POST){
 
        // set post property values
        $post->pTitle = $_POST['pTitle'];
        $post->pContent = $_POST['pContent'];
        $post->cID = $_POST['cID'];
     
        // update the product
        if($post->update()){
            echo "<div class=\"alert alert-success alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Post was updated.";
            echo "</div>";
        }
     
        // if unable to update the product, tell the user
        else{
            echo "<div class=\"alert alert-danger alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Unable to update Post.";
            echo "</div>";
        }
    }

?>

<form action='update_post.php?pID=<?php echo $id; ?>' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Title</td>
            <td><input type='text' name='pTitle' value='<?php echo $post->pTitle; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Content</td>
            
            <td><textarea rows="20" type='text' name='pContent' class='form-control'><?php echo $post->pContent; ?></textarea></td>
        </tr>
        <tr>
            <td>Category</td>
                <td>
                    <?php
                    // read the post categories from the database
                    include_once '../classes/chapter.php';
             
                    $chapter = new Chapters($db);
                    $stmt = $chapter->read();
             
                    // put them in a select drop-down
                    echo "<select class='form-control' name='cID'>";
             
                        echo "<option>Please select...</option>";
                        while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row_category);
             
                            // current chapter of the post must be selected
                            if($post->cID==$cID){
                                
                                echo "<option value='$cID' selected>";
                            }else{
                                echo "<option value='$cID'>";
                            }
             
                            echo "$cTitle</option>";
                        }
                    echo "</select>";
                    ?>
                </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>