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
    </style>
</head>

<body>
    <?php

    if (!isset($_SESSION['login']))
        dd('Вы не авторизованы');

    ?>

    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Комментарии</h1>
                </div>
                <?php
                if (isset($_SESSION['login']) and $_SESSION['login'] !== null) {
                    echo '<div class="col-lg-6"><h5 class="text-right">Вы вошли как ' . $_SESSION['login'] . '</h5>
                          </div>';
                }
                ?>
            </div>
        </section>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">

                <?php

                echo '<div class="col-lg-6">
                        <div class="card shadow-sm">
                            <img id="myImg" src="/upload/images/' . $image['file_name'] . '" alt="' . $image['name'] . '" width=100%">
                            <div class="card-body">
                              <p class="card-text"><small class="text-body-secondary">' . $image['name'] . '<br>' . $image['description'] . '</small>
                               </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-body-secondary">Автор: ' . $image['autor'] . '  [' . $image['created_at'] . ']</small>
                                </div>
                            </div>
                        </div>
                    </div>';

                if(isset($comments))
                {
                    foreach($comments as $item)
                    {
                        echo '<div class="col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-body-secondary">[' . $item['created_at'] . '] Автор: ' . $item['autor'] . ' > ' . $item['text'] . '</small>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                }
                
                ?>

                <form class="mb-3 mt-md-4" action="/comment/save" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Комментарий</label>
                        <input type="text" name="text" id="text" class="form-control" placeholder="Введите комментарий" required value="<?php if (!empty($_POST['text'])) echo $_POST['text']; ?>" />
                        <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>" />
                        <input type="hidden" name="image_id" value="<?= $image['id'] ?>" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-block mb-4">Добавить</button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>