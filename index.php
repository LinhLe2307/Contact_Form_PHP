<?php
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $subject = isset($_POST["subject"]) ?$_POST['subject'] : '';
        $message = isset($_POST['message']) ?$_POST['message'] : '';

        // echo $name . ' ' . $email . ' ' . $subject . ' ' . $message;

        mail($email, $subject, $message);
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
    <form action="index.php" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="subject">Subject</label>
            <input type="text" name="subject">
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message"></textarea>
        </div>
        <input type="submit" value="Submit"/>
    </form>
    <div class="output"><?= $name . ' ' . $email . ' ' . $subject . ' ' . $message;?></div>
</body>
</html>