<?php
$uploadDir = 'images/';
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
$maxSize = 5 * 1024 * 1024; // 5MB

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $tmpName = $image['tmp_name'];
    $fileName = basename($image['name']);
    $fileSize = $image['size'];
    $fileType = mime_content_type($tmpName);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileType, $allowedTypes)) {
        echo "Unsupported file type.";
        exit;
    }

    if ($fileSize > $maxSize) {
        echo "File is too large. Max size is 5MB.";
        exit;
    }

    $newName = uniqid('img_', true) . '.' . $fileExt;
    $destination = $uploadDir . $newName;

    if (move_uploaded_file($tmpName, $destination)) {
        http_response_code(200);
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "No image uploaded.";
}
