<?php
//creating connection
$connect = mysqli_query('localhost', 'root', '', 'feeder_page');

//checking connection
if($connect -> connect_error){
    die("Connection Failed". $connect ->connect_error);

    else if($connect -> connect_ok){
        echo "Connected successfully";
    }
}

//creating a post
function createPost($connect, $user_id, $content){

$user_id = $POST_['user_id'];
$content = $POST_['content'];


$sql = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')";

if($connect -> query($sql)=== TRUE){
    echo "post created successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//getting all posts

function getPosts($connect){
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $result = $connect -> query($sql);

    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo "<div class='post'>";
            echo "<h3>".$row['user_id']."</h3>";
            echo "<p>".$row['content']."</p>";
            echo "</div>";
        }
    }
}

//creating a comment

function createComment($connect, $post_id, $user_id, $content){

$post_id = $POST_['post_id'];
$user_id = $POST_['user_id'];
$content = $POST_['content'];

$sql = "INSERT INTO comments (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$content')";

if($connect -> query($sql)=== TRUE){
    echo "comment created successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//add comment

function addComment($connect, $post_id, $user_id, $content){

$post_id = $POST_['post_id'];
$user_id = $POST_['user_id'];
$content = $POST_['content'];

$sql = "INSERT INTO comments (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$content')";

if($connect -> query($sql)=== TRUE){
    echo "comment added successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//getting all comments for a post

function getComments($connect, $post_id){
    $sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY id DESC";
    $result = $connect -> query($sql);

    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo "<div class='comment'>";
            echo "<h4>".$row['user_id']."</h4>";
            echo "<p>".$row['content']."</p>";
            echo "</div>";
        }
    }
}


//deleting comments

function deleteComment($connect, $comment_id){

$sql = "DELETE FROM comments WHERE id = $comment_id";

if($connect -> query($sql)=== TRUE){
    echo "comment deleted successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//liking a post

function likePost($connect, $post_id, $user_id){

$post_id = $POST_['post_id'];
$user_id = $POST_['user_id'];

$sql = "INSERT INTO likes (post_id, user_id) VALUES ('$post_id', '$user_id')";

if($connect -> query($sql)=== TRUE){
    echo "post liked successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//disliking  a post

function dislikePost($connect, $post_id, $user_id){

$post_id = $POST_['post_id'];
$user_id = $POST_['user_id'];

$sql = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";

if($connect -> query($sql)=== TRUE){
    echo "post disliked successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//checking if a user has liked a post

function hasLikedPost($connect, $post_id, $user_id){
    $sql = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
    $result = $connect -> query($sql);

    if($result -> num_rows > 0){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

//checking if a user has commented on a post

function hasCommentedPost($connect, $post_id, $user_id){
    $sql = "SELECT * FROM comments WHERE post_id = $post_id AND user_id = $user_id";
    $result = $connect -> query($sql);

    if($result -> num_rows > 0){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

//getting number of dislikes for a post

function getDislikes($connect, $post_id){
    $sql = "SELECT COUNT(*) as dislikes FROM likes WHERE post_id = $post_id AND dislike = 1";
    $result = $connect -> query($sql);
    $row = $result -> fetch_assoc();
    return $row['dislikes'];
}

//getting number of likes for a post

function getLikes($connect, $post_id){
    $sql = "SELECT COUNT(*) as likes FROM likes WHERE post_id = $post_id AND dislike = 0";
    $result = $connect -> query($sql);
    $row = $result -> fetch_assoc();
    return $row['likes'];
}

//getting number of comments for a post

function getCommentsCount($connect, $post_id){
    $sql = "SELECT COUNT(*) as comments FROM comments WHERE post_id = $post_id";
    $result = $connect -> query($sql);
    $row = $result -> fetch_assoc();
    return $row['comments'];
}

//updating a post

function updatePost($connect, $post_id, $content){

$post_id = $POST_['post_id'];
$content = $POST_['content'];

$sql = "UPDATE posts SET content = '$content' WHERE id = $post_id";

if($connect -> query($sql)=== TRUE){
    echo "post updated successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

//displaying a post

function displayPost($connect, $post_id){
    $sql = "SELECT * FROM posts WHERE id = $post_id";
    $result = $connect -> query($sql);

    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        echo "<div class='post'>";
        echo "<h3>".$row['user_id']."</h3>";
        echo "<p>".$row['content']."</p>";
        echo "</div>";
    }
}

//deleting a post

function deletePost($connect, $post_id){

$post_id = $POST_['post_id'];

$sql = "DELETE FROM posts WHERE id = $post_id";

if($connect -> query($sql)=== TRUE){
    echo "post deleted successfully";
    return TRUE;
}
else{
    return FALSE;
}
}

if($row){
    header("Location:feed.php");
}

$connect -> close();
?>