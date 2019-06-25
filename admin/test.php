<?php
include "../functions.php";
include "contact.php";
$contact = new contact ();
$message = $contact->get_message($_GET['id']);
print $message[0]['flag'];
?>
