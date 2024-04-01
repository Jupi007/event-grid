<?php include 'billetsalg_create_json.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Editor</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/icon/editor/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/icon/editor/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/icon/editor/favicon-16x16.png">
  <link rel="manifest" href="/assets/icon/editor/site.webmanifest">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="preload" as="style" type="text/css" crossorigin="anonymous" onload="this.onload=null;this.rel='stylesheet'">
  <style>
  .fab { /* I know this could be split into admin.css */
      position: fixed;
      top: 20px;
      right: 20px;
      font-family: arial, verdana;
      line-height: 60px;
      background-color: #04AA6D;;
      color: #fff;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      text-align: center;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s;
    }
    .fab.clicked {
      background-color: gray; !important; /* Add !important to override other styles */
    }
    .label { margin-right: 8px; }
    .event-container {
  display: flex;
  align-items: center;
  margin: 0 auto 20px auto; /* Updated line */
  background: #fafafa;
  max-width: 720px;
  border: 1px solid lightgray;
}
    .event-image {
      width: 150px; /* Adjust as needed */
      height: auto;
      margin: 0px 30px 0px 20px;
    }
    h3 { color: black; }
  </style>
</head>

<header>
    <!-- LOGO --><img style="display: block" width="150px" src="assets/img/logo/logo.webp" alt="Jammerbugt Kultur- & ErhvervsCenter Logo">
</header>
<body>




<?php
// Read the JSON data from the file
$json_data = file_get_contents('events.json');

// Decode the JSON data
$events = json_decode($json_data, true);

// Check if JSON decoding was successful
if (null !== $events) {
    foreach ($events as $event) {
        echo '<div class="event-container">';

        // Display the image next to the event
        if (!empty($event['custom_image'])) {
            echo '<div class="avatar-preview" style="position: relative;">';
            echo '<img src="uploads/'.htmlspecialchars($event['custom_image'], \ENT_QUOTES, 'UTF-8').'" title="Custom image" class="event-image">';
            echo '<span title="Fjern" style="position: absolute; top: -10px; right: 20px; cursor: pointer; color: #b12720;" data-image-name="'.htmlspecialchars($event['custom_image'], \ENT_QUOTES, 'UTF-8').'" data-event-title="'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'" data-event-date="'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'" class="image-remove"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 20 20"><script>console.log("'.$event['custom_image'].'?>");</script>
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                </svg></span>';
            echo '</div>';
        } elseif (!empty($event['image_link'])) {
            echo '<img src="'.htmlspecialchars($event['image_link'], \ENT_QUOTES, 'UTF-8').'" title="fra Billetsalg" class="event-image" loading="lazy">';
        }

        echo '<div>';
        echo '<a target="_blank" title="Open eventpage" href="'.htmlspecialchars($event['link'], \ENT_QUOTES, 'UTF-8').'"><h3>'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'</h3></a>';
        echo '<p class="event-date">'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'</p>';

        // Add text fields for custom title, label, and icon
        echo '<p><input type="text" class="custom_title" placeholder="Custom title" value="'.htmlspecialchars($event['custom_title'] ?? '', \ENT_QUOTES, 'UTF-8').'"></p>';
        echo '<input type="text" class="label" placeholder="Label" value="'.htmlspecialchars($event['label'] ?? '', \ENT_QUOTES, 'UTF-8').'">';
        echo '<input type="text" class="icon" placeholder="Icon" value="'.htmlspecialchars($event['icon'] ?? '', \ENT_QUOTES, 'UTF-8').'">';
        echo '<a style="padding-left: 8px" target="_blank" href="https://icons.getbootstrap.com/"><i title="Browse icons" class="fa-solid fa-circle-question"></i></a>';

        // Add image upload button
        echo '<p>';
        echo '<label for="image-upload-'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'-'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'">Upload Image:</label>';
        echo '<input type="file" class="image-upload" id="image-upload-'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'-'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'" data-event-title="'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'" data-event-date="'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'" accept="image/*">';
        echo '</p>';

        // Add checkbox with label for sold-out status
        echo '<p>';
        echo '<label for="sold-out-'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'-'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'">Sold Out:</label>';
        echo '<input type="checkbox" class="sold-out-checkbox" id="sold-out-'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'-'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'" data-event-title="'.htmlspecialchars($event['title'], \ENT_QUOTES, 'UTF-8').'" data-event-date="'.htmlspecialchars($event['date'], \ENT_QUOTES, 'UTF-8').'"'.($event['sold_out'] ? ' checked' : '').'>';
        echo '</p>';

        echo '</div>'; // Close the inner div
        echo '</div>'; // Close the event-container div
    }
} else {
    // Display an error message if JSON decoding failed
    echo 'Error: Unable to decode JSON data.';
}
?>

<!-- Save button animation -->
<div class="fab" id="saveChangesButton">Save</div>
<!-- End of Save button animation -->
</body>


 <script>
$(document).ready(function() {
    $('#saveChangesButton').click(function() {
        $(this).toggleClass('clicked'); // Toggle the clicked class

        // Add a timeout to remove the class after 300 milliseconds
        setTimeout(function() {
            $('#saveChangesButton').removeClass('clicked');
        }, 700);

        // Create an array to store the updated event data
        var updatedEventData = [];

        // Iterate over each checkbox
        $('.sold-out-checkbox').each(function() {
            var eventTitle = $(this).data('eventTitle');
            var eventDate = $(this).data('eventDate');
            var isChecked = $(this).is(':checked');

            // Traverse the DOM to find related input fields
            var container = $(this).closest('.event-container');
            var label = container.find('.label').val();
            var icon = container.find('.icon').val();
            var customTitle = container.find('.custom_title').val();

            // Create an object representing the updated event
            var updatedEvent = {
                title: eventTitle,
                date: eventDate,
                sold_out: isChecked,
                label: label,
                icon: icon,
                custom_title: customTitle
            };

            // Add the updated event object to the array
            updatedEventData.push(updatedEvent);
        });

        // Send the updated event data to the server (first AJAX request)
        $.ajax({
            url: 'update_events.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(updatedEventData),
            success: function(response) {
                if (response === 'success') {
                    console.log('Changes saved successfully.');
                } else {
                    console.error('Error saving changes: ' + response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    // Handle file upload (second AJAX request)
    $('.image-upload').change(function(event) {
        // Prevent the click event from bubbling up to the save button
        event.stopPropagation();

        var fileData = new FormData();
        var eventTitle = $(this).data('eventTitle');
        var eventDate = $(this).data('eventDate');
        var file = $(this)[0].files[0];
        fileData.append('eventTitle', eventTitle);
        fileData.append('image', file);

        $.ajax({
            url: 'upload-image.php',
            method: 'POST',
            data: fileData,
            contentType: false,
            processData: false,
            success: function(response) {
                var imageUrl = JSON.parse(response).custom_image;

                // Extract filename from the URL
                var filename = imageUrl.split(/[/\\]/).pop(); // Get the last part after the last slash

                // Set the image preview source
                $('.image-preview').attr('src', 'uploads/' + filename);

                var updatedEvent = {
                    title: eventTitle,
                    date: eventDate,
                    custom_image: filename // Use only the filename
                };

                // Send the updated event data with image URL (third AJAX request)
                $.ajax({
                    url: 'update_events.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify([updatedEvent]),
                    success: function(response) {
                        if (response === 'success') {
                            console.log('Image uploaded and JSON updated successfully.');
                            window.location.reload();
                        } else {
                            console.error('Error updating JSON: ' + response);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error: ' + textStatus + ' - ' + errorThrown);
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('File upload error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    // Handle file removing (second AJAX request)
    $('.image-remove').click(function(event) {
        // Prevent the click event from bubbling up to the save button
        event.stopPropagation();

        var fileData = new FormData();
        var imageName = $(this).data('imageName');
        var eventTitle = $(this).data('eventTitle');
        var eventDate = $(this).data('eventDate');
        fileData.append('imageName', imageName);

        $.ajax({
            url: 'remove-image.php',
            method: 'POST',
            data: fileData,
            contentType: false,
            processData: false,
            success: function(response) {
                var updatedEvent = {
                    title: eventTitle,
                    date: eventDate,
                    custom_image: '',
                };

                // Send the updated event data  (third AJAX request)
                $.ajax({
                    url: 'update_events.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify([updatedEvent]),
                    success: function(response) {
                        if (response === 'success') {
                            console.log('Image removed and JSON updated successfully.');
                            window.location.reload();
                        } else {
                            console.error('Error updating JSON: ' + response);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error: ' + textStatus + ' - ' + errorThrown);
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('File remove error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});
</script>
</body>
</html>
