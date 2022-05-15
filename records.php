<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>All Records</title>

    <!-- bootstrap 4 -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    

</head>
<body>

    <div class="container">
        <h1 class="text-primary text-uppercase text-center">Records</h1>
    

        
        <!-- 🔘Modal button to add records -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
            <i class="bi bi-person-plus"></i> Add Profile
            </button>
        </div>
        <br>


        <!-- this is for creating the table -->

        <div id="records_contant">
        </div>


        
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Records</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class = "form-group">
                    <label>First Name </label>
                    <input type="text" name="" id="firstname" class="form-control" placeholder="First Name ">
                </div>

                <div class = "form-group">
                    <label>Last Name </label>
                    <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name ">
                </div>

                <div class = "form-group">
                    <label>Email </label>
                    <input type="email" name="" id="email" class="form-control" placeholder="Email ">
                </div>

                <div class = "form-group">
                    <label>Mobile </label>
                    <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile Number ">
                </div>

                <!--  image submission -->
                <div class = "form-group">
                    <label>Profile Image</label><br>
                    <input type="file" id="image_real" hidden="hidden" onchange="showpath()">
                    <button button id="image" class="btn btn-info" onclick="openfile()">Choose File</button>
                    <span id="image_txt">No File Chosen</span><br>
                    <span class="help-block" id = "file_types">Allowed file types - jpg, jpeg, png, gif</span>
                    
                    <!-- image preview -->


                    

                </div>
                
                
                
                

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick ="addRecord()">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>





        <!-- edit model/updatemodel -->
        


        <!-- edit Modal -->
        <div class="modal fade" id="update_user_Modal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class = "form-group">
                    <label>First Name </label>
                    <input type="text" name="" id="upd_firstname" class="form-control" placeholder="First Name ">
                </div>

                <div class = "form-group">
                    <label>Last Name </label>
                    <input type="text" name="" id="upd_lastname" class="form-control" placeholder="Last Name ">
                </div>

                <div class = "form-group">
                    <label>Email </label>
                    <input type="email" name="" id="upd_email" class="form-control" placeholder="Email ">
                </div>

                <div class = "form-group">
                    <label>Mobile </label>
                    <input type="text" name="" id="upd_mobile" class="form-control" placeholder="Mobile Number ">
                </div>

                <div class = "form-group">
                    <label>Profile Image</label><br>
                    <input type="file" id="image_real" hidden="hidden" onchange="showpath()">
                    <button button id="image" class="btn btn-info" onclick="openfile()">Choose File</button>
                    <span id="image_txt">No File Chosen</span><br>
                    <span class="help-block" id = "file_types">Allowed files - jpg, jpeg, png, gif</span>

                    <!-- image preview -->
                    

                </div>

            </div>
            

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick ="updateuserdetail()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <input type="hidden" name="" id="hidden_user_id">
            </div>

            </div>
        </div>
        </div>



    </div>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    


    <!-- using ajax for calling function -->

    <script>
    
    // 👵for keeping the table of employees always open
    
    $(document).ready(function(){
        readRecords();
    });


        function readRecords(){
            var readrecord = "readrecord";
            $.ajax({
                url:"backend.php",
                type:"POST",
                data:{readrecord:readrecord},

                success: function(data,status){
                    $('#records_contant').html(data);
                }
            });
        }




        function addRecord(){

            // taking values from fields using jquery

            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();

            // ajax request to server
            $.ajax({
                url:"backend.php",
                type:'POST',
                data: { firstname:firstname,
                        lastname:lastname,
                        email:email,
                        mobile:mobile},

                success: function(data,status){
                    readRecords();
                }
            });

        }


        // deleting records

        function DeleteUser(deleteid){
            var conf = confirm("Do you want to delete the row?");

            if(conf == true){
                $.ajax({

                    url:"backend.php",
                    type:"post",
                    data:{deleteid:deleteid},

                    success : function(data,status){
                        readRecords();
                    }
                });
            }
        }


        // editing existing records

        function GetUserDetails(id){

            $('#hidden_user_id').val(id);

            $.post("backend.php",
                    {id:id},
                    function(data,status){

                        // 👴converting json to javascript object

                        var user = JSON.parse(data);

                        $('#upd_firstname').val(user.firstname);
                        $('#upd_lastname').val(user.lastname);
                        $('#upd_email').val(user.email);
                        $('#upd_mobile').val(user.mobile);
                    }
            );

            $('#update_user_Modal').modal("show");

        }


        function updateuserdetail(){

            var firstname_upd = $('#upd_firstname').val();
            var lastname_upd = $('#upd_lastname').val();
            var email_upd = $('#upd_email').val();
            var mobile_upd = $('#upd_mobile').val();

            var hidden_user_id_upd = $('#hidden_user_id').val();

            $.post("backend.php",
                    {
                    hidden_user_id_upd:hidden_user_id_upd,
                    firstname_upd:firstname_upd,
                    lastname_upd:lastname_upd,
                    email_upd:email_upd,
                    mobile_upd:mobile_upd                    
                    },
                    function(data,status){
                        $('#update_user_Modal').modal("hide");
                        readRecords();
                    }
            );

        }



        
        
        //for image upload button

                    const file_btn = document.getElementById("image_real");
                    const image_btn = document.getElementById("image");
                    const image_txt_btn = document.getElementById("image_txt");

        function openfile(){
            file_btn.click();
        }
        function showpath(){
            if(file_btn.value){
                image_txt_btn.innerHTML =   file_btn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];   
            }
            else{
                image_txt_btn.innerHTML =   "No File Chosen";
            }
        }



        

    </script>

</body>
</html>