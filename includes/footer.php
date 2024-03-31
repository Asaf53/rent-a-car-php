<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="index.php" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="assets/img/logo/logo.png" alt="logo">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; <?php echo date("Y"); ?> GoCar, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="h3"><a href="https://www.github.com/asaf53" target="_blank" class="nav-link px-2 text-body-secondary"><i class="bx bxl-github"></i></a></li>
            <li class="h3"><a href="https://www.instagram.com/asaf_rushiti" target="_blank" class="nav-link px-2 text-body-secondary"><i class="bx bxl-instagram"></i></a></li>
            <li class="h3"><a href="https://www.twitter.com/asaf_rushiti" target="_blank" class="nav-link px-2 text-body-secondary"><i class="bx bxl-twitter"></i></a></li>
        </ul>
    </footer>
</div>
<!-- Link Swiper's JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".rental-swiper", {
        spaceBetween: 30,
        navigation: {
            nextEl: ".rental-swiper-next",
            prevEl: ".rental-swiper-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1400: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        }
    });
</script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>