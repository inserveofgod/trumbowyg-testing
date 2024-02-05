<?php declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* upload_max_filesize: 4M */

// Check if files were uploaded
if(isset($_FILES['image_files']) && !empty($_FILES['image_files']['name'][0])) {
    // Directory where uploaded files will be saved
    $uploadDirectory = 'uploads/';

    // Loop through each uploaded file
    $fileUrls = [];
    foreach($_FILES['image_files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['image_files']['name'][$key];
        $file_tmp = $_FILES['image_files']['tmp_name'][$key];
        $file_type = $_FILES['image_files']['type'][$key];
        
        // Generate a unique filename
        $filename = uniqid() . '_' . $file_name;

        // Move the uploaded file to the destination directory
        if(move_uploaded_file($file_tmp, $uploadDirectory . $filename)) {
            // File uploaded successfully
            $uploadedFileUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $uploadDirectory . $filename;
            $fileUrls[] = $uploadedFileUrl;
        } else {
            $fileUrls[] = "Failed to upload file: " . $filename;
        }
    }

    // Output file URLs as JSON
    echo json_encode(['urls' => $fileUrls, 'code' => 200]);
} else {
    // No files were uploaded
    http_response_code(400);
}

