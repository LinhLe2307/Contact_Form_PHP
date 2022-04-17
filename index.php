<?php

$alertMessage = ''; // to display alert message
$displayInfo = ''; // to display output
$msgClass = ''; // to style the alertMessage class
$name = $email = $subject = $message = "";
//Validate inputs
function test_inputs($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = test_inputs($_POST['name']);
    $email = test_inputs($_POST["email"]);
    $subject = test_inputs($_POST["subject"]);
    $message = test_inputs($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {

        // This is to check whether or not this email is valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $alertMessage = 'Please fill in all fields!';
            $msgClass = 'alert';
        } else {
            $body = '<h4>Name:</h4> <p>'.$name.'</p>
                    <h4>Email:</h4> <p>'.$email.'</p>
                    <h4>Subject:</h4> <p>'.$subject.'</p>
                    <h4>Message:</h4> <p>'.$message.'</p>';
            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

            $displayInfo = $body; // All the information is in body

            if(mail($email, $subject, $body, $headers)) {
                $alertMessage = "Your email has been sent";
                $msgClass = "success";
            } else {
                $alertMessage = "Your email was not sent";
                $msgClass = 'alert';
            };
        }
    } else {
        $alertMessage = 'Please fill in all fields!';
        $msgClass = 'alert';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Contact us form</title>
</head>
<body>
    <h1>Contact us form</h1>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <?php if($alertMessage != '' ) { ?> 
            <div class= "msg <?= $msgClass?>"><?= $alertMessage; ?></div> 
        <?php }; ?>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value=<?=  isset($_POST['name']) ? $name : ''; ?>>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value=<?= isset($_POST["email"]) ? $email : ''; ?>>
        </div>
        <div>
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value=<?= isset($_POST["subject"]) ? $subject : ''; ?>>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message"><?= isset($_POST["message"]) ? $message : '';?></textarea>
        </div>
        <input type="submit" value="Submit"/>
    </form>
    <div class="output"><?= $displayInfo;?></div>
</body>
</html>