<?php
$file = __DIR__.'/public/index.php';
$content = file_get_contents($file);
file_put_contents($file, mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content)));
echo "Кодировка исправлена на UTF-8";