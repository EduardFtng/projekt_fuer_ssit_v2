<?php include "templates/include/header.php" ?>

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name']; // Name-Wert aus der HTML-Form in Variable gespeichert
        $email_id = $_POST['email']; // Email-Wert aus der HTML-Form in Variable gespeichert
        $mobile_no = $_POST['mobile']; // Telefon-Wert aus der HTML-Form in Variable gespeichert
        $msg = $_POST['message']; // Nachrichten-"Wert" aus der HTML-Form in Variable gespeichert
         
        $to = ""; // Email-Adresse wo die Mails von der Webseite hingeschickt werden
        $subject = "'$name' hat eine Nachricht geschickt."; // Das steht in der Email als Titel
         
        // HTML-Formatierung für die Mail
        $message ="
        <html>
            <body>
                <table style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Name: </strong></td>
                            <td style='width:400px'>$name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email ID: </strong></td>
                            <td style='width:400px'>$email_id</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Mobile No: </strong></td>
                            <td style='width:400px'>$mobile_no</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Message: </strong></td>
                            <td style='width:400px'>$msg</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        ";
    
         
        // Muss man laut der Doku immer angeben, was der Inhalt-Typ der Nachricht ist, etc
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <msgbox@ape-blog.com>' . "\r\n";
         
        if(mail($to,$subject,$message,$headers)){
            echo '<div class="alert alert-success mt-5" >Deine Nachricht wurde verschickt!</div>';
        }
 
        else{ 
            echo '<div class="alert alert-danger mt-5" >Da ist etwas schiefgelaufen!</div>';
        } 
    }
?>

<!-- Die HTML-Form auf der Seite zusehen -->
<form class="m-5" role="form" action="index.php?action=contact" method="post">
    <div class="form-group">
        <input class="form-control" name="name" required="required" type="text" placeholder="Dein Name" />
    </div>

    <div class="form-group">
        <input class="form-control" name="email" required="required" type="email" placeholder="Deine Email"/>
    </div>

    <div class="form-group">
        <input class="form-control" name="mobile" required="required" type="text" placeholder="Deine Telefonnummer"/>
    </div>

    <div class="form-group">
        <textarea class="form-control" name="message" placeholder="Deine Nachricht"></textarea>
    </div>

    <input class="btn btn-info" name="submit" type="submit" value="Senden" />
</form>

<?php include "templates/include/footer.php" ?>
