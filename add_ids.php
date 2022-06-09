<?php

    // all sanitized post fields
    // $name = htmlspecialchars($_POST['name']);
    // $email = htmlspecialchars($_POST['email']);
    // ....
    
    
    $contactURL = "https://api.razorpay.com/v1/contacts";
    $fundURL = "https://api.razorpay.com/v1/fund_accounts";
    function curlReq ($data, $url) {
        $apiKEY = "rzp_test_kfinzduUHtfEu8";
        $apiSecret = "4Hmo4HjuS2LsKvmUKk57kzZO";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "$apiKEY:$apiSecret");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);    
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
        return json_decode(curl_exec($ch), true);
    }
    // data from frontend form
    $data = array(
        'name' => "Test Account",
        'email' => "test@gmail.com",
        'contact' => "+915252525252",
        'type' => "vendor",
    );
    $res = curlReq($data, $contactURL);
    $contactID = $res['id'];
    // bank details from html form
    $data = array(
        "contact_id" => "$contactID",
        "account_type" => "bank_account",
        "bank_account" => array(
            "name" => "Gaurav Kumar",
            "ifsc" => "HDFC0000053",
            "account_number" => "765432123456789"
        )
    );
    $res = curlReq($data, $fundURL);
    $fundID = $res['id'];
    
    // bankIDs = array(); 
    // sql query get auto_increment value of bank table
    // foreach(bank_entries) {
    //      push auto_increment table to array
    //      INSERT INTO Bank (id=auto_inc, bank name, ifsc code, account, contactID, fundID)
    //      auto_increment++;
    // }
    // INSERT INTO Employee (details.... `bank_id`=implode(',', bankIDs[]))

    // same for vendor
?>