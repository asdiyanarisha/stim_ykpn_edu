Add-Type -AssemblyName System.Drawing
$images = @(
    'images/dosen/pimpinan_anna_partina.JPG',
    'images/dosen/pimpinan_ralina.JPG',
    'images/dosen/pimpinan_siti_resmi.JPG',
    'images/banner_slide_1.jpeg'
)
$baseDir = 'C:\Users\arief\.gemini\antigravity\scratch\stim_ykpn_edu-master\public'

foreach ($img in $images) {
    $path = Join-Path $baseDir $img
    if (Test-Path $path) {
        $bmp = [System.Drawing.Image]::FromFile($path)
        
        # Determine new width (800 for dosen, 1920 for banner)
        if ($img -match "banner") {
            $newWidth = 1920
        } else {
            $newWidth = 800
        }
        
        # Only resize if it's larger than the target width
        if ($bmp.Width -gt $newWidth) {
            $newHeight = [int]($bmp.Height * ($newWidth / $bmp.Width))
            $newBmp = New-Object System.Drawing.Bitmap($newWidth, $newHeight)
            $g = [System.Drawing.Graphics]::FromImage($newBmp)
            $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
            $g.DrawImage($bmp, 0, 0, $newWidth, $newHeight)
            
            # Dispose original so we can overwrite
            $bmp.Dispose()
            
            # Save over original
            $newBmp.Save($path, [System.Drawing.Imaging.ImageFormat]::Jpeg)
            
            $g.Dispose()
            $newBmp.Dispose()
            Write-Host "Optimized $img"
        } else {
            $bmp.Dispose()
            Write-Host "Skipped $img (already small enough)"
        }
    } else {
        Write-Host "Not found: $img"
    }
}
