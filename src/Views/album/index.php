<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Фотогалерея</title>
    <!-- Bootstrap CSS -->

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- fancyBox3 CSS -->
    <link href="путь_до/jquery.fancybox.min.css" rel="stylesheet">
    <style>
        .thumb img {
            -webkit-filter: grayscale(0);
            filter: none;
            border-radius: 5px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px;
        }

        .thumb img:hover {
            -webkit-filter: grayscale(1);
            filter: grayscale(1);
        }

        .thumb {
            padding: 5px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 1200px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 1200px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main>
        <section class="py-5 text-center container">

            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Альбом <?= $album['name'] ?></h1>
                </div>
                <?php
                if (isset($_SESSION['login']) and $_SESSION['login'] !== null) 
                {
                    echo '<div class="col-lg-6"><h4 class="text-right">Вы вошли как ' . $_SESSION['login'] . '</h4>';
                                        
                    if($album['user_id'] == $user_id)
                    echo '<a href="/image/create" class="btn btn-primary my-2">Добавить фото</a>';

                    echo '</div>';
                }
                ?>
            </div>
        </section>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                    <?php
                    if (count($images) > 0) {
                        foreach ($images as $item) {
                            echo '<div class="col">
                        <div class="card shadow-sm">                           
                           <img id="myImg" src="/upload/images/' . $item['file_name'] . '" alt="' . $item['name'] . '" onclick="showImage(this)" width=100%">

                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <span class="close">×</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                            <div class="card-body">
                                <p class="card-text"><small class="text-body-secondary">' . $item['name'] . '</small>
                               </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <a href="/comment/' . $item['id'] . '" class="btn btn-secondary btn-sm my-2">Комментарии</a>
                                    </div>
                                    <small class="text-body-secondary">' . $item['created_at'] . '</small>
                                </div>
                            </div>
                        </div>
                    </div>';
                        }
                    } else {
                    ?>
                        <section class="py-5 text-center container">
                            <div class="row py-lg-5">
                                <div class="col-lg-8 col-md-8 mx-auto">
                                    <h4 class="fw-light">Нет фотографий в альбоме</h4>
                                </div>
                            </div>
                        </section>

                    <?php    }
                    ?>

                </div>
            </div>
        </div>
    </main>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');
        var modalImg = document.getElementById('img01');

        function showImage(imgElement) {
            var src = imgElement.getAttribute("src");
            modal.style.display = "block";
            modalImg.src = src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>