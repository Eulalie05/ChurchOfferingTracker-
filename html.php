<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css
    ">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>


    <header>

        <div class="container-fluid">

            <div class="navb-logo">
                <img src="image/sary.png" alt="Logo">
            </div>

            <div class="navb-items d-none d-xl-flex">

                <div class="item">
                <i class="bi bi-house-fill"></i><a href="index.php">Home</a>
                </div>

                <div class="item">
                <i class="bi bi-tools"></i><a href="service.php">Services</a>
                </div>

                <div class="item">
                <i class="bi bi-window-desktop"></i> <a href="case.php">Cases</a>
                </div>

                <div class="item">
                <i class="bi bi-twitch"></i><a href="about.php">About</a>
                </div>

                <div class="item-button">
                    <a href="#" type="button">Let's talk</a>
                </div>
            </div>

            <!-- Button trigger modal -->
            <div class="mobile-toggler d-lg-none">
                <a href="#" data-bs-toggle="modal" data-bs-target="#navbModal">
                    <i class="bi bi-justify"></i>
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="navbModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <img src="image/sary.png" alt="Logo">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                        </div>

                        <div class="modal-body">
                            
                            <div class="modal-line">
                                <i class="bi bi-house-fill"></i><a href="index.php">Home</a>
                            </div>

                            <div class="modal-line">
                                <i class="bi bi-tools"></i><a href="service.php">Services</a>
                            </div>

                            <div class="modal-line">
                                <i class="bi bi-window-desktop"></i> <a href="case.php">Cases</a>
                            </div>

                            <div class="modal-line">
                                <i class="bi bi-twitch"></i><a href="about.php">About</a>
                            </div>

                            <a href="#" class="navb-button" type="button">Let's talk</a>
                        </div>

                        <div class="mobile-modal-footer">
                            
                            <a target="_blank" href="#"><i class="bi bi-instagram"></i></a>
                            <a target="_blank" href="#"><i class="bi bi-twitter"></i></a>
                            <a target="_blank" href="#"><i class="bi bi-youtube"></i></a>
                            <a target="_blank" href="#"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- <section class="section-1">

        <p>time, diamonds and others relics</p>
    </section> -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js
    "></script>
</body>

</html>