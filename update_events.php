<?php
// Access form data (assuming data is sent via POST)
$requestData = json_decode(file_get_contents('php://input'), true); // Decode JSON data sent from client

// Read the JSON data from the file
$json_data = file_get_contents('events.json');

// Decode the JSON data
$events = json_decode($json_data, true);

// Check if decoding was successful
if ($events !== null) {
  foreach ($requestData as $updatedEvent) {
    $found = false;
    foreach ($events as &$event) {
      if ($event['title'] == $updatedEvent['title'] && $event['date'] == $updatedEvent['date']) {
        $event['sold_out'] = $updatedEvent['sold_out'] ?? $event['sold_out']; // Use existing value if key not present
        $event['label'] = $updatedEvent['label'] ?? $event['label']; // Use existing value if key not present
        $event['icon'] = $updatedEvent['icon'] ?? $event['icon']; // Use existing value if key not present
        $event['custom_title'] = $updatedEvent['custom_title'] ?? $event['custom_title']; // Use existing value if key not present

        // Handle `custom_image` update (reset or uploaded image)
        if (isset($updatedEvent['custom_image'])) {
          // If `custom_image` is empty, set it to null (indicates reset)
          if (empty($updatedEvent['custom_image'])) {
            $event['custom_image'] = null;
          } else {
            // Update with uploaded image URL (assuming logic exists)
            $event['custom_image'] = $updatedEvent['custom_image']; // Implement your image upload handling here
          }
        } else {
          // Keep existing `custom_image` if no update is provided
          // (avoids accidentally resetting the image)
        }

        $found = true;
        break;
      }
    }

    // Inform about missing event if not found
    if (!$found) {
      echo 'Event not found.';
      exit; // Stop further processing
    }
  }

  // Update JSON file with all modified events
  $json = json_encode($events, JSON_PRETTY_PRINT);
  if (file_put_contents('events.json', $json) !== false) {
    echo 'success'; // Send success message back to AJAX request
  } else {
    echo 'Error: Failed to update JSON file.';
  }
} else {
  echo 'Error: Unable to decode JSON data.';
}
