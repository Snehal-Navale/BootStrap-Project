<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form> -->
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1">Email address</label>
                        <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                    </div>
                    <div class="form-group">
                        <label for="inputPassword1">Password</label>
                        <input type="password" class="form-control" id="inputPassword1" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="cinputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="cinputPassword1" placeholder="Enter Confirm Password">
                    </div>
                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addUser()">Create</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form> -->
                    <div class="form-group">
                        <label for="updateName">Name</label>
                        <input type="text" class="form-control" id="updateName" aria-describedby="nameHelp">
                    </div>
                    <div class="form-group">
                        <label for="updateEmail1">Email address</label>
                        <input type="email" class="form-control" id="updateEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="form-group">
                        <label for="updatePassword">Password</label>
                        <input type="text" class="form-control" id="updatePassword" aria-describedby="passwordHelp">

                    </div>
                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" onclick="updateUser()">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" id="hidden-data">
                </div>
            </div>
        </div>
    </div>


    <div class="container my-4">
        <h1 class="text-center">PHP CRUD operations using Bootstrap Modal</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark my-3" data-toggle="modal" data-target="#createModal">
            Create User
        </button>
        <div id="userTable">

        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            display();
        })

        function display() {
            var displayData = 'true';
            $.ajax({
                url: 'display.php',
                type: 'post',
                data: {
                    displaySend: displayData
                },
                success: function(data, response) {
                    if ($.trim(response) == 'success') {
                        $('#userTable').html(data);
                    }
                }
            })
        }

        function addUser() {
            if ($('#inputPassword1').val() == $('#cinputPassword1').val()) {
                var nameAdd = $('#inputName').val();
                var emailAdd = $('#inputEmail1').val();
                var passwordAdd = $('#inputPassword1').val();
                if(nameAdd.trim() == "" || emailAdd.trim() == "" || passwordAdd.trim() == ""){
                    alert ("All fields are mandatory");
                    $('#createModal').modal("show");
                }else{
                $.ajax({
                    url: "insert.php",
                    method: 'post',
                    data: {
                        newName: nameAdd,
                        newEmail: emailAdd,
                        newPassword: passwordAdd
                    },
                    success: function(response) {
                        if ($.trim(response) == 'success') {
                            alert("User Added successfully");
                            display();
                        } else {
                            alert("Failed to create new user!");
                        }
                    }

                })
                $('#inputName').val('');
                $('#inputEmail1').val('');
                $('#inputPassword1').val('');
                $('#cinputPassword1').val('');

            } }else {
                alert("Password and Confirm password should be same!");
            }
        }

        function getDetails(userId) {
            $('#hidden-data').val(userId);
            $.post("update.php", {userId:userId}, function(data,status){
                var user =JSON.parse(data);
                $('#updateName').val(user.name);
                $('#updateEmail1').val(user.email);
                $('#updatePassword').val(user.password);
            })

            $('#updateModal').modal("show");
            
        }

        function updateUser(){
            var userId=$('#hidden-data').val();
            var nameIn=$('#updateName').val();
            var emailIn=$('#updateEmail1').val();
            var pass=$('#updatePassword').val();

            $.post(
                "update.php",               
                {
                    uid:userId,
                    nameIn:nameIn,
                    emailIn:emailIn,
                    pass:pass
                },
                function(data,status){
                    display();
                }

            )
        }

        function deleteUser(userId) {
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    deleteId: userId
                },
                success: function(response) {
                    display();
                }
            })
        }
    </script>
</body>

</html>