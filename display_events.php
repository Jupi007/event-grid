<?php

// Read the JSON data from the file
$json_data = file_get_contents('events.json');

// Decode the JSON data
$events = json_decode($json_data, true);

// Check if JSON decoding was successful
if ($events !== null) {
  foreach ($events as $event) {
      
      if (!empty($event['custom_image'])) {
          $eventImage = 'uploads/' . htmlspecialchars($event['custom_image'], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($event['image_link'])) {
          $eventImage = htmlspecialchars($event['image_link'], ENT_QUOTES, 'UTF-8');
        } else {
          $eventImage = ''; 
        }
      
         if (!empty(htmlspecialchars($event['custom_title']))) {
          $eventTitle = htmlspecialchars($event['custom_title'], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($event['image_link'])) {
          $eventTitle = htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8');
        } else {
          $eventTitle = ''; 
        }
      
      
?>

<style>
    .post-img {
        width: 100%; /* Adjust this width as needed */
        height: 300px; /* Set a fixed height for the div */
        background-size: cover; /* Ensures the background image covers the entire div */
        background-position: center; /* Centers the background image */
    }
</style>
 
 
 <div class="col-xl-4 col-md-6">
    <div class="post-item position-relative h-100" onclick="window.location.href='<?php echo htmlspecialchars($event['link'], ENT_QUOTES, 'UTF-8'); ?>';" style="cursor: pointer;">
        <div class="post-img position-relative overflow-hidden dark-overlay" style="background-image: url('<?php echo $eventImage; ?>');">
       
           <!--  <div class="overlay-text post-title">LÆS MERE</div> -->

            <?php 
            if (!empty(htmlspecialchars($event['label']))) {
                $cssTypeClass = ''; // Default CSS class

                    echo '<span class="post-date">';
                    echo '<i class="fa-solid fa-' . htmlspecialchars($event['icon']) . '"></i><span class="ps-2">' . htmlspecialchars($event['label']);
                    echo '</span></span>';
                }
      
            ?>

             <span class="title-overlay">
                <h3 class="post-title"><?php echo $eventTitle ?></h3>
                <span class="date-time"><?php echo htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8'); ?></span>
            </span>

  <?php 
  
 $event['faa_billetter'] = "";
        if ($event['sold_out']) { ?>  <span class="post-it red">UDSOLGT</span> <?php }
        if ($event['faa_billetter']) { ?>  <span class="post-it yellow">FÅ BILLETTER</span> <?php }
            
            
            
            
               
             
 ?>           

        </div>
    </div>
</div><!-- End post list item -->


    
  
   
  
  <?php        
  }
} else {
  // Display an error message if JSON decoding failed
  echo 'Error: Unable to decode JSON data.';
}
?>
