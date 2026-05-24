$viewsPath = 'C:\Users\arief\.gemini\antigravity\scratch\stim_ykpn_edu-master\resources\views'
$publicPath = 'C:\Users\arief\.gemini\antigravity\scratch\stim_ykpn_edu-master\public'

Write-Host "=== 1. CHECKING LINKS (href) IN ALL BLADE FILES ==="
$linkPattern = 'href=["''](.*?)["'']'
$allLinks = @{}
Get-ChildItem -Path $viewsPath -Recurse -Filter *.blade.php | ForEach-Object {
    $file = $_.FullName
    $content = Get-Content $file -Raw
    $matches = [regex]::Matches($content, $linkPattern)
    foreach ($match in $matches) {
        $link = $match.Groups[1].Value
        if (-not $allLinks.ContainsKey($link)) {
            $allLinks[$link] = @()
        }
        $allLinks[$link] += $file.Replace($viewsPath, "")
    }
}

foreach ($link in $allLinks.Keys | Sort-Object) {
    if ($link -eq "#" -or $link -eq "" -or $link.Contains(".html")) {
        Write-Host "Suspicious Link: $link (Found in: $($allLinks[$link] -join ', '))"
    } else {
        # Optional: verify internal links that don't start with http or {{
        if ($link -match "^/" -and -not $link.StartsWith("//") -and -not $link.Contains("{{")) {
            $filePath = Join-Path $publicPath $link
            if (-not (Test-Path $filePath) -and $link -match "\.(css|js|png|jpg|jpeg|svg|webp|pdf)$") {
                Write-Host "MISSING ASSET: $link (Found in: $($allLinks[$link] -join ', '))"
            }
        }
    }
}

Write-Host "`n=== 2. CHECKING USED IMAGES FOR HEAVY SIZES ==="
$imgPattern = 'src=["''](.*?)["'']'
$usedImages = @{}
Get-ChildItem -Path $viewsPath -Recurse -Filter *.blade.php | ForEach-Object {
    $file = $_.FullName
    $content = Get-Content $file -Raw
    $matches = [regex]::Matches($content, $imgPattern)
    foreach ($match in $matches) {
        $src = $match.Groups[1].Value
        # clean blade syntax if any
        if ($src -match "asset\(['""](.*?)['""]\)") {
            $src = "/" + $Matches[1]
        }
        $usedImages[$src] = $true
    }
}

foreach ($src in $usedImages.Keys) {
    if ($src -match "^/" -and -not $src.StartsWith("//")) {
        # fix path
        $cleanSrc = $src.TrimStart("/")
        $filePath = Join-Path $publicPath $cleanSrc
        if (Test-Path $filePath) {
            $size = (Get-Item $filePath).Length
            if ($size -gt 1MB) {
                $mbSize = [math]::Round($size / 1MB, 2)
                Write-Host "HEAVY IMAGE: $src ($mbSize MB)"
            }
        } else {
             # Write-Host "Image not found locally: $src"
        }
    }
}
Write-Host "Done."
