const fs = require('fs');
const path = require('path');

const webPhpPath = path.join(__dirname, 'routes', 'web.php');
let webPhpContent = fs.readFileSync(webPhpPath, 'utf8');

// Replace all .html inside Route::get('/something.html')
// Matches Route::get('/xxx.html'
webPhpContent = webPhpContent.replace(/Route::get\('([^']+)\.html'/g, "Route::get('$1'");

// Add the 301 redirect route at the very end of the file.
// We should check if it exists first.
if (!webPhpContent.includes("Route::get('{any}.html'")) {
    webPhpContent += `

// SEO 301 Redirect for legacy .html URLs
Route::get('{any}.html', function ($any) {
    return redirect($any, 301);
})->where('any', '.*');
`;
}

fs.writeFileSync(webPhpPath, webPhpContent, 'utf8');
console.log('routes/web.php updated');

// Now process all blade files in resources/views
const viewsDir = path.join(__dirname, 'resources', 'views');

function processFile(filePath) {
    if (!filePath.endsWith('.blade.php')) return;

    let content = fs.readFileSync(filePath, 'utf8');
    let originalContent = content;
    
    // Replace href="/something.html" to href="/something"
    content = content.replace(/href="([^"]+)\.html"/g, 'href="$1"');
    
    // Replace url('/something.html') to url('/something')
    content = content.replace(/url\('([^']+)\.html'\)/g, "url('$1')");
    
    // Some links might be without leading slash like href="something.html"
    content = content.replace(/href='([^']+)\.html'/g, "href='$1'");
    
    // Let's do a more generic replacement but carefully:
    // we only want to replace .html inside href or url() or action=""
    content = content.replace(/action="([^"]+)\.html"/g, 'action="$1"');

    if (content !== originalContent) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log('Updated: ' + path.basename(filePath));
    }
}

function walkDir(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            walkDir(fullPath);
        } else {
            processFile(fullPath);
        }
    }
}

walkDir(viewsDir);
console.log('Views updated');
