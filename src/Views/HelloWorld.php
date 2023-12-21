<?php
use MvcLite\Engine\InternalResources\Storage;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello, World! :)</title>

    <?php
    //Storage::include("Css/Example/index.css");
    ?>
</head>
<body>

<h1>
    Your age?
</h1>

<form action="<?= route('post.age') ?>" method="post">
    <input type="number" name="age" id="age" placeholder="Your age here..." />
</form>

</body>
</html>