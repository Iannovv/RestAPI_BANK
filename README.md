REST API 

This is the project of REST API with bank account functionality written in PHP. 
I am using XAMPP v3.3.0 with MySQL and Apache modules. My main web browser is Firefox.


List of features: 

1. Account creation
2. Funds deposit 
3. Funds withdrawal
4. Account balance
5. Account history 


Instruction: 

1. Check db.php file and put your host, username, password, database name in it. 
2. Open (import) restapi.sql file in MySQL.
3. Use query string key ?action with values from the list below to perform tasks:

A) balance -- We use it for checking balance of account.
    - id -- Account id. We generate it by creating new account. 
    
Example: Checking balance of account with id of "1": localhost/restapi/api.php?action=balance&id=1 

B) create -- We use it for creating account. After successfull creation we get id number of our account. 
    - owner -- Our nickname
    - password -- Our password 

Example: Creating new account with owner "John" and password "bunny": localhost/restapi/api.php?action=create&owner=John&password=bunny

C) add -- We use it to deposit money on account. 
    - id -- Account id.
    - amount -- Amount of money we want to deposit. 

Example: Making deposit of 5000$ to account with id of "2": localhost/restapi/api.php?action=add&id=2&amount=5000

D) withdraw -- We use it for withdrawal money from account.  
    - id -- Account id. 
    - amount -- Amount of money we want to withdraw.

Example: Withdrawal of $5000 from account with id of "3": localhost/restapi/api.php?action=withdraw&id=3&amount=5000

E) history -- We use it for checking history of account. 
    - owner_id -- Same as account id. 

Example: Displaying history account with owner_id of "2": localhost/restapi/api.php?action=history&owner_id=2  

4. Every task returns answer in JSON. 
5. In case of API ERROR it returns description in JSON. 


