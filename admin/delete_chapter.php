<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once '../classes/database.php';
    include_once '../classes/chapter.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare chapter object
    $chapter = new Chapters($db);
     
    // set post id to be deleted
    $chapter->cID = $_POST['object_id'];
     
    // delete the product
    if($chapter->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
         
    }
}
?>