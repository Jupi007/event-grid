<?php

// Define the directory to save the uploaded images
$uploadDirectory = 'uploads/';

unlink($uploadDirectory.$_POST['imageName']);
