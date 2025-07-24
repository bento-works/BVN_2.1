<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize and validate email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $filename = 'private directory/subscribers.txt';
        
        // Create file if it doesn't exist
        if (!file_exists($filename)) {
            $header = ['Email', 'Subscribe Date'];
            $file = fopen($filename, 'w');
            fputcsv($file, $header);
            fclose($file);
        }
        
        // Append new subscriber
        $file = fopen($filename, 'a');
        $data = [
            $email,
            date('Y-m-d H:i:s')
        ];
        fputcsv($file, $data);
        fclose($file);
        
        // Success message
        echo "Thank you for subscribing!";
    } else {
        // Invalid email
        echo "Please enter a valid email address";
    }
}
?>