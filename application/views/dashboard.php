<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock mr-4" style="width:80vw">



    <div id="top-header" style="display:flex; justify-content:space-between">
        <h2 class="text-blue text-left font-weight-bold " style="font-size: 20px">
            Dashboard
        </h2>
    </div>
    <div class="card ">
        <div class="card-body">
            <img style="object-fit:cover ; width:75vw; height:48vh" src="<?php echo base_url(); ?>assets/DASHBOARD2.png" alt="yfu">
        </div>
    </div>
    <div class="container">


        <div class="mt-5" style="display: flex">
            <div class="card" style="width: 95%;">
                <div class="card-body">
                    <div class="table-responsive mt-2" style="overflow-x:auto;">
                        <h3 style="font-weight:500"> Employee Payout</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment_Due_Date</th>

                                </tr>
                            </thead>
                            <tbody class="tblEmp">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 95%;">
                <div class="card-body">
                    <div class="table-responsive-md mt-2" style="overflow-x:auto;">
                        <h3 style="font-weight:500">Vendor Payout</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment_Due_Date</th>

                                </tr>
                            </thead>
                            <tbody class="tblVen">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function empPay() {
        $.ajax({
            url: "<?php echo base_url(); ?>EmployeesManagement/dashEmpPay",
            method: "POST",
            success: function(data) {
                $(".tblEmp").html(data);
            },
        });
    }

    function venPay() {
        $.ajax({
            url: "<?php echo base_url(); ?>VendorPayout/getAllPayoutsLatest",
            method: "POST",
            success: function(data) {
                $(".tblVen").html(data);
            },
        });
    }

    $(document).ready(function() {
        empPay();
        venPay();
    });
</script>