<?php
// establishing connection with server 

$conn = mysqli_connect('localhost','root',"",'emp');

extract($_POST);


if(isset($_POST['readrecord'])){

    $data = '<table class="table table-bordered table-striped">
                <tr>
                    <th>Sno.</th>
                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    
                    <th>Actions</th>
                </tr>';

    $displayquery = "SELECT * FROM `recordtable` ";
    $result = mysqli_query($conn,$displayquery);

    if(mysqli_num_rows($result)>0){

        $number = 1;

        while($row = mysqli_fetch_array($result)){
            $data .=    '<tr>
                        <td>'.$number.'</td>
                        <td>'.$row['firstname'].'</td>
                        <td>'.$row['lastname'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['mobile'].'</td>
                        <td>
                            <button onclick="GetUserDetails('.$row['id'].')" class = "btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        
                            <button onclick="DeleteUser('.$row['id'].')" class = "btn btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                        </tr>';
                        $number++;  
        }
    }

    $data.='</table>';
    echo $data;


}



if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']))
{
    $query = "INSERT INTO `recordtable`(`firstname`, `lastname`, `email`, `mobile`) VALUES ('$firstname','$lastname','$email','$mobile')";
    mysqli_query($conn,$query);
}




// delete button code

if(isset($_POST['deleteid'])){
    $userid = $_POST['deleteid'];

    $deletequery ="DELETE FROM `recordtable` WHERE id = '$userid'";
    mysqli_query($conn,$deletequery);
}


//edit button code

if(isset($_POST['id']) && isset($_POST['id'])!=""){

    $user_id = $_POST['id'];
    $query = "SELECT * FROM `recordtable` WHERE id = '$user_id'";

    if(!$result=mysqli_query($conn,$query)){
        exit(mysqli_error());
    }

    $response = array();

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $response = $row;
        }
    }
    else{
        $response['status']=200;
        $response['message']="DATA NOT FOUND!";
    }


    echo json_encode($response);
}

else{
    $response['status']=200;
    $response['message']="DATA NOT FOUND!";
}



// update button

if(isset($_POST['hidden_user_id_upd'])){

    $hidden_user_id_upd = $_POST['hidden_user_id_upd'];
    $firstname_upd = $_POST['firstname_upd'];
    $lastname_upd = $_POST['lastname_upd'];
    $email_upd = $_POST['email_upd'];
    $mobile_upd = $_POST['mobile_upd'];

    $query = "UPDATE `recordtable` SET `firstname`='$firstname_upd',`lastname`='$lastname_upd',`email`='$email_upd',`mobile`='$mobile_upd' WHERE id = '$hidden_user_id_upd'";

    mysqli_query($conn,$query);

}

?>