<?php
add_action("wp_ajax_ajax_submit", "ajax_submit");
add_action("wp_ajax_nopriv_ajax_submit", "ajax_submit");

function ajax_submit()
{
    $name = $_POST['name'];    
    $email = $_POST['email'];    
    $contact_num = $_POST['contact_num'];
    $whatsapp_num = $_POST['whatsapp_num'];
    $number_of_adults = $_POST['number_of_adults'];
    $number_of_childrens = $_POST['number_of_childrens'];
    $package_name = $_POST['package_name'];
    $package_type = $_POST['package_type'];
    $meal_plans = $_POST['meal_plans'];
    $number_of_rooms = $_POST['number_of_rooms'];
    $other_info = $_POST['other_info'];
    $other_details = $_POST['other_details'];
    $grandTotal = $_POST['grandTotal'];


    $to = "visionsforweb1@gmail.com, ". $email;
    $subject = "Package email";

    $message = "<html>
                <body>
                    <p>Name: " . $name . "</p> 
                    <p>Email: " . $email . "</p>  
                    <p>Contact number: " . $contact_num . "</p>
                    <p>Whatsapp number: " . $whatsapp_num . "</p>
                    <p>Number of adults: " . $number_of_adults . "</p>
                    <p>Number of childrens: " . $number_of_childrens . "</p>
                    <p>Package Name: " . $package_name . "</p>
                    <p>Package Type: " . $package_type . "</p>
                    <p>Meal Plans: " . $meal_plans . "</p>
                    <p>Number of rooms: " . $number_of_rooms . "</p>
                    <p>Other Information: " . $other_info . "</p>
                    <p>Other Details: " . $other_details . "</p>
                    <p>Grand Total: " . $grandTotal . "</p>
                </body>
                </html>
            ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <packages@assam.com>' . "\r\n";
    $headers .= 'Cc: newentry@assam.com' . "\r\n";

    mail($to, $subject, $message, $headers);
    die();
}