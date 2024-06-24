<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once('nav.php'); ?>
    <div class="container">
        <h4 class="mb-3">Регистрация</h4>

        <form action="/db/reg_db.php" method="post">
            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="Электронная почта">
                <label for="floatingInput">Электронная почта</label>
            </div>

            <div class="form-floating mb-3">
                <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Пароль">
                <label for="floatingPassword">Пароль</label>
            </div>

            <button type="submit" class="btn btn-dark mb-3">Зарегистрироваться</button>
            <div class="form-text">Есть аккаунт?
                <a href="/signin.php" class="btn btn-dark">Войдите!</a>
            </div>
        </form>
    </div>
</body>

</html>

<style>
    .form-text {
        font-size: xx-large;
        color: black;

    }

    .form-floating {
        color: gray;
    }

    body {
        background: linear-gradient(360deg, rgba(2, 0, 36, 1) 0%, rgba(24, 83, 93, 1) 17%, rgba(47, 170, 153, 1) 100%);
        background-repeat: no-repeat;
        color: white;
        height: 100vh;
    }
</style>