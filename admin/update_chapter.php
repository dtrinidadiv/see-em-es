<?php
$page_title = "Update Chapter";
include_once "header.php";

    echo "<div class='right-button-margin'>";
    echo "<a href='read_chapter.php' class='btn btn-default pull-right'>Read Chapter</a>";
    echo "</div>";
    
    // get ID of the chapter to be edited
    $id = isset($_GET['cID']) ? $_GET['cID'] : die('ERROR: missing ID.');
     
    // include database and object files
    include_once '../classes/database.php';
    include_once '../classes/chapter.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    // prepare chapter object
    $chapter = new Chapters($db);
     
    // set ID property of chapter to be edited
    $chapter->cID = $id;
     
    // read the details of chapter to be edited
    $chapter->readOne();
    
    if($_POST){
 
        // set post property values
        $chapter->cTitle = $_POST['cTitle'];
        $chapter->cDesc = $_POST['cDesc'];

     
        // update the chapter
        if($chapter->update()){
            echo "<div class=\"alert alert-success alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Chapter was updated.";
            echo "</div>";
        }
     
        // if unable to update the chapter, tell the user
        else{
            echo "<div class=\"alert alert-danger alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Unable to update Chapter.";
            echo "</div>";
        }
    }

?>     

<form action='update_chapter.php?cID=<?php echo $id; ?>' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Title</td>
            <td><input type='text' name='cTitle' value='<?php echo $chapter->cTitle; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Description</td>
            
            <td><input type='text' name='cDesc' value='<?php echo $chapter->cDesc; ?>' class='form-control' /></td>
        </tr>
       
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>