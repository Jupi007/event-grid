<?php $pageDescription = "Koncertoplevelser - helt tæt på!"; ?>
<?php $pageKeywords = "koncerter, jammerbugt, aabybro, arrangementer, musik, spillested, livemusik"; ?>
<?php $pageTitle = "Jammerbugt Kultur- & ErhvervsCenter"; ?>
<?php include 'header.php'; ?>

  <main id="main">

<!-- Blog Section -->
<section id="blog" class="blog">

  <div class="container">
    <div class="row gy-4 posts-list">
      

     <?php include 'display_events.php'; ?>


    </div><!-- End row -->
  </div><!-- End container -->
</section><!-- End Blog Section -->

  </main><!-- End #main -->

<?php include 'footer.php';?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>