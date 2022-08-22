<?php
header("Content-Type:application/json"); //Header file json
 
// Code below is responsible for checking what action program should perform:

if (isset($_GET['action']) && $_GET['action']!="") {

    include('db.php'); // Import data from our database with function included in db.php file.
 
    // Code below is responsible for displaying account balance:
    if ($_GET['action'] == "balance" && isset($_GET['id']) && $_GET['id']!="") { // balance
        $id = clean($_GET['id']);
        $result = mysqli_query($connection, "SELECT * FROM `accounts` WHERE id=$id");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $balance = $row['balance'];
            $owner = $row['owner'];
            json_balance($id, $balance, $owner); // Returns JSON with balance of account. 
        } else {
            json_error("balance", "MySQL connection error."); // Returns JSON with balance ERROR.
        }
    // Code below is responsible for creating new account with owner name and password:
    } elseif ($_GET['action'] == "create" && isset($_GET['owner']) && $_GET['owner']!="" && isset($_GET['password']) && $_GET['password']!="") { //create
 
        $owner = clean($_GET['owner']);
        $password = md5($_GET['password']); // Using md5 for password encryption. 
        $result = mysqli_query($connection, "INSERT INTO accounts (balance, owner, password) VALUES (0, '$owner', '$password')");
        if ($result) {
            json_create($connection->insert_id); // Returns JSON with created id of account.
        } else {
            json_error("create", "Account creation failed."); // Returns JSON with create ERROR.
        }
    // Code below is responsible for adding funds to account:
    } elseif ($_GET['action'] == "add" && isset($_GET['id']) && $_GET['id']!="" && isset($_GET['amount']) && $_GET['amount']!="") { //add
        $amount = clean($_GET['amount']);
        $id = clean($_GET['id']);

        // Updating account with added funds:
        if (($amount > 0) and (is_numeric($amount)==true)) {
            $result = mysqli_query($connection, "UPDATE accounts SET balance = balance + $amount WHERE id=$id");
         // Tracking history:           
            $result = mysqli_query($connection, "INSERT INTO transactions (date, value, owner_id) VALUES (CURRENT_TIMESTAMP, $amount, $id)");
            json_add($amount); // Returns JSON with amount of added funds.
        } else {
            json_error("add", "Adding funds to account failed; input is not numeric."); // Returns JSON with add ERROR.
        }

    // Code below is responsible for creating withdrawal from the account:
    } elseif ($_GET['action'] == "withdraw" && isset($_GET['id']) && $_GET['id']!="" && isset($_GET['amount']) && $_GET['amount']!="") { //withdraw
 
        $amount = clean($_GET['amount']);
        $id = clean($_GET['id']);
        $result = mysqli_query($connection, "SELECT * FROM `accounts` WHERE id=$id");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $balance = $row['balance'];
        }
        if (($balance >= $amount) and ($amount > 0) and (is_numeric($amount)==true)) {
            // Updating account with withdrawal amount:
            $result = mysqli_query($connection, "UPDATE accounts SET balance = balance - $amount WHERE id=$id"); 
            // Tracking history:
            $result = mysqli_query($connection, "INSERT INTO transactions (date, value, owner_id) VALUES (CURRENT_TIMESTAMP,(-1*$amount), $id)");
            json_withdraw($amount); // Returns JSON with amount of withdraw. 
        } else {
            json_error("withdraw", "Withdrawal funds from account failed; there is not enough funds to withdraw or input is not numeric."); // Returns JSON with withdraw ERROR.
        } 
    // Code below is responsible for displaying history of account:
    } elseif ($_GET['action'] == "history" && isset($_GET['owner_id']) && $_GET['owner_id']!="") { //history
        $owner_id = clean($_GET['owner_id']);
        $result = mysqli_query($connection, "SELECT * FROM transactions WHERE owner_id=$owner_id");
        if (mysqli_num_rows($result) > 0) {
            $first = true; // Creating array for proper JSON format
            echo "[";
            while ($row = mysqli_fetch_array($result)) {
                if ($first) {
                    $first = false; 
                } else {
                    echo ",";
                }
                $id = $row['id'];
                $date = $row['date'];
                $value = $row['value'];
                $owner_id = $row['owner_id'];
                json_history($id, $date, $value, $owner_id); // Returns JSON with history of account. 
                echo chr(0x0D);
            }
            echo "]";
             } else {
                json_error("history", "There is not any history of account for specific owner_id"); // Returns JSON with history ERROR.
        }
        
    }
 
}
 
// Function below generates JSON with account balance data:
function json_balance($id, $balance, $owner) {
    $response['id'] = $id;
    $response['balance'] = $balance;
    $response['owner'] = $owner;
 
    $json = json_encode($response);
    echo $json;
}

// Function below generates JSON with user ID for created account:
function json_create($id) {
    $response['id'] = $id;
 
    $json = json_encode($response);
    echo $json;
}

// Function below generates JSON with amount of added funds to account:
function json_add($amount) {
    $response['state'] = "Success";
    $response['amount'] = "+" . $amount;
 
    $json = json_encode($response);
    echo $json;
}

// Function below generates JSON with the amount of withdrawal from account:
function json_withdraw($amount) {
    $response['state'] = "Success";
    $response['amount'] = "-" . $amount;
 
    $json = json_encode($response);
    echo $json;
}

// Function below generates JSON with bank statement of user account (owner_id):
function json_history($id, $date, $value, $owner_id) {
    $response['id'] = $id;
    $response['date'] = $date;
    $response['value'] = $value;
    $response['owner_id'] = $owner_id;
 
    $json = json_encode($response);
    echo $json;
}

// Function below generates JSON with proper ERROR with description based on $action used:
function json_error($action, $desc) {
    $response['state'] = "Error";
    $response['action'] = $action; 
    $response['desc'] = $desc;

    $json = json_encode($response);
    echo $json;
}
 
// Function below is a secury feature (against attacks like SQL injection) that deletes every character in $value other than allowed ones:
function clean($value) {
    return preg_replace('/[^A-Za-z0-9\-\.\s]/', '', $value);
}

?>