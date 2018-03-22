<?php
    session_start();
    $config = parse_ini_file('config.ini'); 
    $db_name = $config['DB_DATABASE'];    
    $contact = $config['DB_TABLE'];
    
    // ------------------------------------------------------------------------- database connection
    $connection = mysqli_connect($config['DB_HOST'], $config['DB_USERNAME'], "") or die(mysql_error());
    $db = @mysqli_select_db($connection, $db_name) or die(mysql_error());

    // prevents people from directly hitting the page
    if (($_SESSION['user'] == "")){
        header("Location: login.html");
        exit;
    }
    //check if form was submitted
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $postal = $_POST['postal'];
        $birthday = $_POST['birthday'];
        $username = $_SESSION['user'];

        $stmt = $connection->prepare("INSERT INTO $contact (firstName, lastName, phone, email, address, city, province, postal, birthday, user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss",$firstName,$lastName,$phone,$email,$address,$city,$province,$postal,$birthday,$username);
        $stmt->execute();
        $stmt->close();
        
    }    
    $connection->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Client Contact Editing</title>
	</head>
    <body>    
        <form action="" method="post">
            <label for='fName'>First Name
            </br>
            <input type='text' name='fName' value="">
            </label>
            </br>

            <label for='lName'>Last Name
            </br>
            <input type='text' name='lName' value="">
            </label>
            </br>

            <label for='phone'>Phone Number
            </br>
            <input type='text' name='phone' value="">
            </label>
            </br>

            <label for='email'>E-Mail
            </br>
            <input type='email' name='email' value="">
            </label>
            </br>

            <label for='address'>Address
            </br>
            <input type='text' name='address' value="">
            </label>
            </br>

            <label for='city'>City
            </br>
            <input type='text' name='city' value="">
            </label>
            </br>

            <label for='province'>Province
            </br>
            <input type='text' name='province' value="">
            </label>
            </br>

            <label for='postal'>Postal
            </br>
            <input type='text' name='postal' value="">
            </label>
            </br>

            <label for='birthday'>Birthday
            </br>
            <input type='date' name='birthday' value="">
            </label>
            </br>

            <input type='submit' value='Submit'>
        </form>  
    </body>
</html>