Add-Type -AssemblyName System.Drawing
$images = @('STIMYK-324.jpg')
$dir = 'C:\Users\arief\.gemini\antigravity\scratch\stim_ykpn_edu-master\public\images\STIMYK'
foreach ($img in $images) {
    $path = Join-Path $dir $img
    $bmp = [System.Drawing.Image]::FromFile($path)
    $newWidth = 1920
    $newHeight = [int]($bmp.Height * ($newWidth / $bmp.Width))
    $newBmp = New-Object System.Drawing.Bitmap($newWidth, $newHeight)
    $g = [System.Drawing.Graphics]::FromImage($newBmp)
    $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $g.DrawImage($bmp, 0, 0, $newWidth, $newHeight)
    $bmp.Dispose()
    $newPath = Join-Path $dir ("optimized_" + $img)
    $newBmp.Save($newPath, [System.Drawing.Imaging.ImageFormat]::Jpeg)
    $g.Dispose()
    $newBmp.Dispose()
    Write-Host "Optimized $img"
}
