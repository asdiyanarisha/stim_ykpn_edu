<?php

$images = [
    'public/images/hero-bg.png'
];

foreach ($images as $imgPath) {
    if (!file_exists($imgPath)) {
        echo "File not found: $imgPath\n";
        continue;
    }

    $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $imgPath);

    // It's actually a JPEG
    $image = @imagecreatefromjpeg($imgPath);

    if ($image) {
        imagewebp($image, $webpPath, 80); // 80 quality
        imagedestroy($image);
        echo "Converted: $imgPath -> $webpPath\n";
    } else {
        echo "Failed to process: $imgPath\n";
    }
}
