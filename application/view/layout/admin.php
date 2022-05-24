<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="/application/public/styles.css" />
    <script src="/application/public/admin.js"></script>
</head>

<body>
    <header>
        <nav><a href="/admin/logout">Logout</a> <a href="/">Статьи</a></nav>
    </header>
    <?php echo $content ?>
    <footer></footer>
</body>

</html>