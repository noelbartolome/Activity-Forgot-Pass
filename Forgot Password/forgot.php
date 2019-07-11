<?php include 'PHPMailer/functions.php'; ?>
<?php email_send() ?>

<html>
    <body>
        <form method="POST">
            Enter your email address: <input type="text" name="email"><br/>
            <input type="submit" name="send" value="Generate new password">
        </form>
    </body>
</html>