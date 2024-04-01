<?php
// Check if the file is uploaded successfully
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Define the directory to save the uploaded images
    $uploadDirectory = 'uploads/';

    // Create the directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        // Create the directory with permissions 0755 (or any other desired permissions)
        mkdir($uploadDirectory, 0755, true);
    }

    // Get the temporary filename of the uploaded file
    $tmpName = $_FILES['image']['tmp_name'];
    
    $eventTitle = isset($_POST['eventTitle']) ? $_POST['eventTitle'] : ''; // Get from POST, provide a default if absent
    $eventTitle = preg_replace('/[^a-zA-Z0-9.-_]/', '', $eventTitle); // Allow only alphanumeric characters, periods, dashes, and underscores

    $filename = $eventTitle . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // Give the file a name

    // Check for GD library
    if (extension_loaded('gd')) {
        $image = imagecreatefromjpeg($_FILES['image']['tmp_name']); // Adjust for image type (PNG, GIF)
        $maxWidth = 672; // Adjust to your desired maximum width
        $maxHeight = 600; // Adjust to your desired maximum height

        // Get original dimensions
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);

        // Calculate scaling factor based on the larger dimension
        $scale = min($maxWidth / $origWidth, $maxHeight / $origHeight);

        // Calculate new dimensions
        $newWidth = round($origWidth * $scale);
        $newHeight = round($origHeight * $scale);

        // Create a new image resource for the scaled version
        $scaledImage = imagecreatetruecolor($newWidth, $newHeight);

        // Resample the image with desired quality
        imagecopyresampled($scaledImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        // Save the scaled image to the upload directory with the generated filename
        imagejpeg($scaledImage, $uploadDirectory . $filename, 80); // Adjust JPEG quality (0-100)

        imagedestroy($image); // Release resources
        imagedestroy($scaledImage);
    } else {
        // Handle GD library not available
        echo "Error: GD library is not installed.";
    }

    // Return only the filename as 'custom_image'
    echo json_encode(['custom_image' => $filename]);
} else {
    // Return an error message if the file upload failed
    echo json_encode(['error' => 'File upload failed.']);
}
?>