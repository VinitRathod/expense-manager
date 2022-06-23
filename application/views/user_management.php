<?php
defined('BASEPATH') or exit('No direct script access allowed');
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'value' => $this->security->get_csrf_hash(),
);
?>
<div id="maincontent" class="contentblock mr-4" style="width:80vw">
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
                                <input type="text" name="c_name" class="form-control" id="c_name" autocomplete="off" required placeholder="ex. John Doe" />
                                <span id="warn_c_name" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="c_email" class="font-weight-regular"> User Email </label>
                                <input type="text" name="c_email" class="form-control" id="c_email" autocomplete="off" required placeholder="ex. john@gmail.com" />
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
                            <input type="text" value="" name="usrID" id="usrID" hidden>
                            <div class="form-group">
                                <label for="edit_c_name" class="font-weight-regular"> Username </label>
                                <input type="text" name="c_name" class="form-control" id="edit_c_name" autocomplete="off" required />
                                <span id="warn_edit_c_name" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="edit_c_email" class="font-weight-regular"> User Email </label>
                                <input type="text" name="c_email" class="form-control" id="edit_c_email" autocomplete="off" required />
                                <span id="warn_edit_c_email" class="text-danger font-weight-regular">

                                </span>
                            </div>

                            <!-- <div class="form-group">
                                <label for="edit_c_password" class="font-weight-regular"> Password </label>
                                <input type="password" name="c_password" class="form-control" id="edit_c_password" autocomplete="off" required />
                                <span id="warn_c_password" class="text-danger font-weight-regular">

                                </span>
                            </div> -->

                            <div class="form-group">
                                <label for="edit_c_phoneno" class="font-weight-regular"> User Phone no. </label>
                                <input type="text" name="c_phoneno" class="form-control" id="edit_c_phoneno" autocomplete="off" required />
                                <span id="warn_edit_c_phoneno" class="text-danger font-weight-regular">

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
                <table class="table" id="user">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
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
    let csrf_token = "";

    function validation() {}

    $("#add_usr").submit(function(e) {
        if (csrf_token == "") {
            csrf_token = '<?= $csrf['value'] ?>';
        }
        e.preventDefault();
        const form = new FormData(document.getElementById('add_usr'));
        form.append('<?= $csrf['name'] ?>', csrf_token);
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
                let res = JSON.parse(response);
                if (res.csrf) {
                    csrf_token = res.csrf;
                }
                if (res.error) {
                    // console.log(res.error);
                    for (let key in res.error) {
                        $("#" + key).text(res.error[key]);
                    }
                } else {
                    if (res.response == "SUCCESS") {
                        swal("New User Added Successfully.", "", "success").then(() => {
                            // some call back actions comes here...
                            location.reload();
                        });
                    } else {
                        // alert(response);
                        swal("New User Not Added!", "Some unknown error occurred.", "error").then(() => {
                            // some call back actions comes here...
                        });
                    }
                }
            }
        });
    });

    function Reset() {

    }

    $("#edit_usr").submit(function(e) {
        if (csrf_token == "") {
            csrf_token = '<?= $csrf['value'] ?>';
        }
        e.preventDefault();
        const form = new FormData(document.getElementById('edit_usr'));
        form.append('<?= $csrf['name'] ?>', csrf_token);
        // just for initial debugging...
        // console.log(form.get("usrID"));
        let id = form.get("usrID");
        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            url: "<?php echo base_url() ?>UserManagement/updateUsr/" + id,
            data: form,
            success: function(response) {
                let res = JSON.parse(response);
                if (res.csrf) {
                    csrf_token = res.csrf;
                }
                if (res.error) {
                    for(let key in res.error){
                        $("#"+key).text(res.error[key]);
                    }
                } else {
                    if (res.response == "SUCCESS") {
                        swal("This User Updated Successfully.", "", "success").then(() => {
                            location.reload();
                        });
                    } else {
                        swal("User Not Updated!", "Operation failed, Please try again.", "error").then(() => {
                            // location.reload();
                        });
                    }
                }
            }
        });
    });

    function loadUser() {
        if (csrf_token == "") {
            csrf_token = '<?= $csrf['value'] ?>';
        }
        $.ajax({
            url: "<?php echo base_url() ?>UserManagement/getAllUsers",
            method: "POST",
            data: {
                '<?= $csrf['name'] ?>': csrf_token,
            },
            success: function(data) {
                let res = JSON.parse(data);
                if (res.csrf) {
                    csrf_token = res.csrf;
                }
                $(".tblBody").html(res.response);
                $(document).ready(function() {
                    $('#user').DataTable({
                        "order": [
                            [0, 'asc'],
                            [1, 'desc']
                        ],
                        "lengthChange": false,
                        "paging": true,
                        "iDisplayLength": 10,
                        retrieve: true,
                    });
                });
            }
        });
    }
    loadUser();

    function usrEdit(id) {
        // just for initial debugging...
        // alert(id);
        if (csrf_token == "") {
            csrf_token = '<?= $csrf['value'] ?>';
        }
        $.ajax({
            url: "<?php echo  base_url(); ?>UserManagement/editUsr/",
            method: "POST",
            data: {
                'id': id,
                '<?= $csrf['name'] ?>': csrf_token,
            },
            success: function(response) {
                // just for debigging...
                // console.log(JSON.parse(response));
                let data = JSON.parse(response);
                if (data.csrf) {
                    csrf_token = data.csrf;
                }
                $("#edit_c_name").val(data.c_fname + " " + data.c_lname);
                $("#edit_c_email").val(data.c_email);
                $("#edit_c_phoneno").val(data.c_phoneno);
                $("#usrID").val(data.c_id);
            }
        });
    }

    function usrDelete(id) {
        // just to debug things...
        // alert(id);
        if (csrf_token == "") {
            csrf_token = '<?= $csrf['value'] ?>';
        }
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
                        data: {
                            '<?= $csrf['name'] ?>': csrf_token,
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.csrf) {
                                csrf_token = res.csrf;
                            }
                            if (res.response == "SUCCESS") {
                                swal("Poof! That user has been deleted!", {
                                    icon: "success",
                                }).then(() => {
                                    // location.reload();
                                    loadUser();
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
<!-- script table Data  -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>

</html>