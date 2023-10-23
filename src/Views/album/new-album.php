<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Создание нового альбома</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card bg-white">
                        <div class="card-body p-5">
                            <div class="mb-3">
                                <h3>Создание нового альбома</h3>
                            </div>
                            <?php
                            if ($vars) {
                                echo '<div class="row justify-content-center">
                                    <div class="col-md-11">
                                    <div class="alert alert-danger" role="alert">' .
                                    $vars .
                                    '</div>
                                </div>
                            </div>';
                            }
                            ?>

                            <form class="mb-3 mt-md-4" action="/album/save" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Название альбома</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Введите название" required value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Описание альбома</label>
                                    <input type="text" name="description" id="description" class="form-control" placeholder="Введите описание" required value="<?php if (!empty($_POST['description'])) echo $_POST['description']; ?>" />
                                </div>

                                <div class="mb-3">

                                    <button type="submit" class="btn btn-primary btn-block mb-4">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>