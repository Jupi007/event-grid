<?php
// Include the Simple HTML DOM Parser library
include('simple_html_dom.php');
header('Content-Type: text/html; charset=utf-8');

// URL to scrape
$url = 'https://kec-jammerbugt.billetsalg.dk/Kultur.aspx';

// Create an empty array to store event details
$events = [];

// Check if events data file exists
if (file_exists('events.json')) {
    // Read existing events data from the file
    $json_data = file_get_contents('events.json');
    // Decode the JSON data
    $existing_events = json_decode($json_data, true);
} else {
    $existing_events = [];
}

// Create DOM from URL
$html = file_get_html($url);

// Check if DOM is created successfully
if ($html) {
    // Find all event elements
    foreach ($html->find('section.card.coll.coll__1') as $eventElement) {
        // Initialize event details (including sold_out)
        $event = [
            'title' => '',
            'link' => '',
            'date' => '',
            'image_link' => '',
            'custom_image' => '',
            'sold_out' => false,
            'label' => '',
            'custom_title' => '',
            'icon' => ''
        ];

        // Find event title
        $titleElement = $eventElement->find('.card__header span', 0);
        if ($titleElement) {
            $event['title'] = trim($titleElement->plaintext);
        }

        // Find event link
        $linkElement = $eventElement->find('a', 0);
        if ($linkElement) {
            $event['link'] = $linkElement->href;
        }

        // Find event date
        $dateElement = $eventElement->find('[itemprop=startDate]', 0);
        if ($dateElement) {
            $event['date'] = trim($dateElement->plaintext);
        }

        // Find event image link
        $imageElement = $eventElement->find('.card__image img', 0);
        if ($imageElement) {
            $event['image_link'] = $imageElement->src;
        }

        // Check if event exists in existing data
        foreach ($existing_events as $existing_event) {
            if ($existing_event['title'] == $event['title'] && $existing_event['date'] == $event['date']) {
                // Preserve existing values for 'custom_image', 'sold_out', 'label', 'custom_title', and 'icon'
                $event['custom_image'] = $existing_event['custom_image'] ?? '';
                $event['sold_out'] = $existing_event['sold_out'] ?? false;
                $event['label'] = $existing_event['label'] ?? '';
                $event['custom_title'] = $existing_event['custom_title'] ?? '';
                $event['icon'] = $existing_event['icon'] ?? '';
                break;
            }
        }

        // Add event details to the events array
        $events[] = $event;
    }

    // Close the DOM object to free up memory
    $html->clear();

    if (!empty($events)) {
        // Encode events array to JSON
        $json = json_encode($events, JSON_PRETTY_PRINT);

        // Save JSON to a file
        file_put_contents('events.json', $json);

        // echo 'Events data saved to events.json';
    } else {
        echo 'No events found on the page.';
    }
} else {
    echo 'Failed to load the HTML from the URL.';
}
?>
