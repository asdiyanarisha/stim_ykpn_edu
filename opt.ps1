$files = @("STIMYK-100.jpg","STIMYK-102.jpg","STIMYK-104.jpg","STIMYK-106.jpg","STIMYK-108.jpg","STIMYK-110.jpg")
Add-Type -AssemblyName System.Drawing
foreach ($f in $files) {
    $path = "public\images\STIMYK\$f"
    $outPath = "public\images\STIMYK\optimized_$f"
    $img = [System.Drawing.Image]::FromFile((Get-Item $path).FullName)
    $ratio = $img.Width / $img.Height
    $newWidth = 800
    $newHeight = [int]($newWidth / $ratio)
    $bmp = New-Object System.Drawing.Bitmap($newWidth, $newHeight)
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $g.DrawImage($img, 0, 0, $newWidth, $newHeight)
    $bmp.Save((New-Item -Force $outPath).FullName, [System.Drawing.Imaging.ImageFormat]::Jpeg)
    $g.Dispose()
    $bmp.Dispose()
    $img.Dispose()
    Write-Host "Optimized $f"
}
