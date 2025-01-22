<?php
$connect = mysqli_query('localhost', 'root', '', 'profile_update');

if(isset($_POST["user_id"])){
    $query = "SELECT * FROM user_profile WHERE user_id = '".$_POST["user_id"]."'";
    $result = mysqli_query($connect, $query);
    
    $row = mysqli_fetch_array($result);
    
    echo json_encode($row);
}

//updating the profile
if(isset($_POST["update"])){
    $user_id = $_POST["user_id"];
    $username_name = $_POST["username"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];
    $address = $_POST["address"];
    $relationship = $POST_['relationship'];
    
    $query = "UPDATE user_profile SET username = '$username', gender = '$gender', email = '$email', bio = '$bio', address = '$address', relationship = '$relationship' WHERE user_id = '$user_id'";
    mysqli_query($connect, $query);
}

//deleting profile
if(isset($_POST["delete"])){
    $user_id = $_POST["user_id"];
    
    $query = "DELETE FROM user_profile WHERE user_id = '$user_id'";
    mysqli_query($connect, $query);
}

//adding new profile
if(isset($_POST["add"])){
    $username_name = $_POST["username"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];
    $address = $_POST["address"];
    $relationship = $POST_['relationship'];
    
    $query = "INSERT INTO user_profile (username, gender, email, bio, address, relationship) VALUES ('$username', '$gender', '$email', '$bio', '$address', '$relationship')";
    mysqli_query($connect, $query);
}

//fetching data for table
if(isset($_POST["fetch_data"])){
    $query = "SELECT * FROM user_profile";
    $result = mysqli_query($connect, $query);
    
    $output = '<table class="table table-bordered">
                <tr>
                    <th>user_id</th>
                    <th>username</th>
                    <th>gender</th>
                    <th>Email</th>
                    <th>bio</th>
                    <th>Address</th>
                    <th>relationship</th>
                    <th>Action</th>
                </tr>';
                
    while($row = mysqli_fetch_array($result)){
        $output.= '
            <tr>
                <td>'.$row["user_id"].'</td>
                <td>'.$row["username"].'</td>
                <td>'.$row["gender"].'</td>
                <td>'.$row["email"].'</td>
                <td>'.$row["bio"].'</td>
                <td>'.$row["address"].'</td>
                <td>'.$row["relationship"].'</td>
                <td>
                    <button type="button" class="btn btn-warning btn-xs edit" data-id="'.$row["user_id"].'">Edit</button>
                    <button type="button" class="btn btn-danger btn-xs delete" data-id="'.$row["user_id"].'">Delete</button>
                </td>
            </tr>
        ';
    }
}


?> 
