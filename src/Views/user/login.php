<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход в фотогалерею</title>
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
                                <h3>Вход в фотогалерею</h3>
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

                            <form class="mb-3 mt-md-4" action="/user/login_process" method="POST">
                                <!-- Email input -->
                                <div class="mb-3">
                                    <label class="form-label" for="form2Example1">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Введите Email" required value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>" />
                                </div>
                                <!-- Password input -->
                                <div class="mb-3">
                                    <label class="form-label" for="form2Example2">Пароль</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Введите пароль" required value="<?php if (!empty($_POST['password'])) echo $_POST['password']; ?>" />
                                </div>
                                <div class="mb-3">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Войти</button>
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