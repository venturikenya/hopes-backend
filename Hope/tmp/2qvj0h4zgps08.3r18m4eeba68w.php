
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php foreach (($content?:[]) as $cont): ?>
    <p><?= $cont['content'] ?></p>
<?php endforeach; ?>
</body>
</html>


