<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock mr-4" style="width:75vw">
    <div id="top-header" style="display:flex; justify-content:space-between">
        <h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
            User Management
        </h2>
        <button type="button" class="btn btn-x mr-5" data-toggle="modal" data-target="#EXPModal">
            Add New User
        </button>
    </div>

    <div class="container" id="modalContainer">
        <!-- Modal -->
        <div class="modal fade" id="EXPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form action="" onsubmit="return validation()" id="add_usr" class="bg-light" method="post">
                            <div class="form-group">
                                <label for="c_name" class="font-weight-regular"> Name </label>
                                <input type="text" name="c_name" class="form-control" id="c_name" autocomplete="off" required />
                                <span id="warn_c_name" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="c_email" class="font-weight-regular"> User Email </label>
                                <input type="text" name="c_email" class="form-control" id="c_email" autocomplete="off" required />
                                <span id="warn_c_email" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="c_password" class="font-weight-regular"> Password </label>
                                <input type="password" name="c_password" class="form-control" id="c_password" autocomplete="off" required />
                                <span id="warn_c_password" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="c_phoneno" class="font-weight-regular"> User Phone no. </label>
                                <input type="text" name="c_phoneno" class="form-control" id="c_phoneno" autocomplete="off" required />
                                <span id="warn_c_phoneno" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
                            <input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal end  -->
    </div>

    <!-- Another Modal -->
    <div class="container">
        <!-- edit modal starts -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form action="" onsubmit="return validation()" id="edit_usr" class="bg-light" method="post">
                            <div class="form-group">
                                <label for="edit_c_name" class="font-weight-regular"> Name </label>
                                <input type="text" name="c_name" class="form-control" id="edit_c_name" autocomplete="off" required />
                                <span id="warn_c_name" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="edit_c_email" class="font-weight-regular"> User Email </label>
                                <input type="text" name="c_email" class="form-control" id="edit_c_email" autocomplete="off" required />
                                <span id="warn_c_email" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="edit_c_password" class="font-weight-regular"> Password </label>
                                <input type="password" name="c_password" class="form-control" id="edit_c_password" autocomplete="off" required />
                                <span id="warn_c_password" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="edit_c_phoneno" class="font-weight-regular"> User Phone no. </label>
                                <input type="text" name="c_phoneno" class="form-control" id="edit_c_phoneno" autocomplete="off" required />
                                <span id="warn_c_phoneno" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
                            <input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- edit modal ends -->
    </div>
    <!-- Another modal ends -->

    <div class="card" style="width: 95%;">
        <div class="card-body">
            <div class="table-responsive-md mt-4" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Email</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tblBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function validation() {}

    $("#add_usr").submit(function(e) {
        e.preventDefault();
        const form = new FormData(document.getElementById('add_usr'));
        // console.log(...form);
        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            url: "<?php echo base_url() ?>UserManagement/addUser",
            data: form,
            success: function(response) {
                if (response == "SUCCESS") {
                    swal("New User Added Successfully.", "", "success").then(() => {
                        // some call back actions comes here...
                        location.reload();
                    });
                } else {
                    alert(response);
                    swal("New User Not Added!","Some unknown error occurred.","error").then(()=>{
                        // some call back actions comes here...
                    });
                }
            }
        });
    });

    function Reset() {

    }

    $("#edit_exp").submit(function(e) {
        // alert();
        e.preventDefault();
        const form = new FormData(document.getElementById('edit_exp'));
        // console.log(form.get("ExpID"));
        let id = form.get("ExpID");
        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            url: "<?php echo base_url() ?>ExpenseManagement/expUpdate/" + id,
            data: form,
            success: function() {
                swal("Expense Category Updated Successfully.", "Update Action Succeed.", "success").then(() => {
                    loadExp();
                    expEdit(id);
                });
            }
        });
    });

    function loadUser() {
        $.ajax({
            url: "<?php echo base_url() ?>UserManagement/getAllUsers",
            method: "POST",
            success: function(data) {
                $(".tblBody").html(data);
            }
        });
    }
    loadUser();

    function expEdit(id) {
        // alert(id);
        $.ajax({
            url: "<?php echo  base_url(); ?>ExpenseManagement/editExp/" + id,
            method: "POST",
            success: function(response) {
                // console.log(JSON.parse(response));
                let data = JSON.parse(response);
                $("#EditexpCode").val(data.c_expcode);
                $("#EditexpCat").val(data.c_category);
                $("#EditexpType").val(data.c_type).change();
                $("#expId").val(data.c_expid);
                $("#EditexpDesc").html(data.c_description);
            }
        });
    }

    function usrDelete(id) {
        // just to debug things...
        // alert(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `<?php echo base_url(); ?>/UserManagement/deleteUser/${id}`,
                        method: "POST",
                        success: function(response) {
                            if (response == "SUCCESS") {
                                swal("Poof! That user has been deleted!", {
                                    icon: "success",
                                }).then(()=>{
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    swal("This user is safe!", {
                        icon: "info",
                    });
                }
            });
    }
</script>
</body>

</html>