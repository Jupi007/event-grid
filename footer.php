<?php
    function generateEmail($user, $domain)
    { $email = "$user@$domain";
      return $email;
    } // Scramble email address

    $email = generateEmail("kontakt", "kec-jammerbugt.dk");
?>

<footer id="footer" class="footer">

    <div class="footer-content position-relative">
        <div class="container">
         <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Adresse</h4>
            <p>
              Søparken 2 <br>
                            9440 Aabybro<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Kundeservice</h4>
            <p>
              <strong>Telefon:</strong> 42 72 65 24<br>
              <strong>Email:</strong> <a href='mailto:<?php echo $email; ?>'><?php echo $email; ?></a>
                        <br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Kontorets åbningstid</h4>
            <p>
              Mandag - Tordag: 10.00 – 13.00<br>
              Fredag: Kun efter aftale
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href='mailto:<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>'
                                class="d-flex align-items-center justify-content-center"><i
                                    class="bi bi-envelope"></i></a>
                            <a href="https://www.facebook.com/Jammerbugt.kulturcenter"
                                class="d-flex align-items-center justify-content-center"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/kec.jammerbugt/"
                                class="d-flex align-items-center justify-content-center"><i
                                    class="bi bi-instagram"></i></a>
          </div>
        </div>

      </div>
    </div>

       <div class="footer-legal text-center position-relative">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>UpConstruction</span></strong>. All Rights Reserved
            </div>
          
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>

  </footer>