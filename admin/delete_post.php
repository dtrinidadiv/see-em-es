<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once '../classes/database.php';
    include_once '../classes/post.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare post object
    $post = new Posts($db);
     
    // set post id to be deleted
    $post->pID = $_POST['object_id'];
     
    // delete the product
    if($post->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
         
    }
}
?>