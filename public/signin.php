<?php
require_once "nav.php"; ?>

<main>
    <div class="container">
        <h4 class="mb-3">Авторизация</h4>

        <form action="/db/signin_db.php" method="post">
            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Электронная почта</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
            </div>
            <button type="submit" class="btn btn-dark mb-3">Войти</button>
            <div class="form-text">Нет аккаунта?
                <a href="/reg.php" class="btn btn-dark">Зарегистрируйтесь!</a>
            </div>
        </form>
    </div>

</main>

</body>

</html>

<style>
    .form-text{
        font-size: xx-large;
        color: black;
        
    }

    .form-floating{
        color: gray;
    }

    body {
        background: linear-gradient(360deg, rgba(2, 0, 36, 1) 0%, rgba(24, 83, 93, 1) 17%, rgba(47, 170, 153, 1) 100%);
        background-repeat: no-repeat;
        color: white;
        height: 100vh;
    }
</style>