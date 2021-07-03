<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Регистрация пользователя</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <img src="/images/logo.svg" class="rounded mx-auto d-block w-100 my-5">
                <form>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Введите свой Email" require>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Введите имя" require>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password1" id="password1" class="form-control" placeholder="Введите пароль" require>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Повторите пароль" require>
                    </div>
                    <div class="form-group">
                        <input type="button" id="submit" class="btn btn-primary" class="form-control" value="Зарегистрироваться">
                        <a href="/" class=" btn btn-dark float-right">Назад</a>
                    </div>

                </form>
                <p id="result" class="alert alert-info mb-5"></p>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
</body>

<script src="../js/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#result").hide();
        $("#submit").click(function() {
            $.ajax({
                type: "POST",
                url: "registration.php",
                data: {
                    email: $("#email").val(),
                    name: $("#name").val(),
                    password1: $("#password1").val(),
                    password2: $("#password2").val()
                },
                dataType: "HTML",
                success: function(result) {
                    $("#result").html(result);
                    $(document).scrollTop($(document).height());
                    $("#result").show();
                }
            });
        })
    })
</script>

</html>