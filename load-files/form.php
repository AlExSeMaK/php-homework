<!doctype html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Загрузка файлов</title>
    <style>
        form div {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<form method="post" action="formHandler.php" enctype="multipart/form-data">
    <div>
        <input name="title" type="text" placeholder="Название">
    </div>
    <div>
        <input type="file" accept="image/*" multiple name="picture[]">
    </div>
    <div>
        <input type="submit" value="Загрузить">
    </div>
</form>
</body>
</html>