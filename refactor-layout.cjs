const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

function processFile(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    if (filePath.includes('components') || filePath.includes('layouts') || filePath.includes('vendor') || filePath.includes('profile')) return;

    let content = fs.readFileSync(filePath, 'utf-8');
    
    // Check if it already has @extends
    if (content.includes("@extends('layouts.public')")) return;
    
    // Check if it's a full HTML page
    if (!content.includes('<!DOCTYPE html>') && !content.includes('@include(\'components.footer\')')) return;

    console.log(`Processing: ${path.basename(filePath)}`);

    let phpBlock = '';
    const phpMatch = content.match(/^(<\?php[\s\S]*?\?>)/);
    if (phpMatch) {
        phpBlock = phpMatch[1] + '\n';
        content = content.replace(phpMatch[1], '');
    }

    let seoBlock = '';
    const seoMatch = content.match(/(<x-seo-head[\s\S]*?\/>)/);
    if (seoMatch) {
        seoBlock = `\n@section('seo')\n  ${seoMatch[1]}\n@endsection\n`;
    }

    let stylesBlock = '';
    const stylesMatch = content.match(/(<style>[\s\S]*?<\/style>)/);
    if (stylesMatch) {
        stylesBlock = `\n@push('styles')\n  ${stylesMatch[1]}\n@endpush\n`;
    }

    let scriptsBlock = '';
    // We only want scripts that are NOT script.js
    const scriptRegex = /<script[\s\S]*?<\/script>/g;
    let match;
    while ((match = scriptRegex.exec(content)) !== null) {
        if (!match[0].includes('script.js')) {
            scriptsBlock += `  ${match[0]}\n`;
        }
    }
    if (scriptsBlock) {
        scriptsBlock = `\n@push('scripts')\n${scriptsBlock}@endpush\n`;
    }

    // Extract content between navbar and footer
    let bodyContent = '';
    const startMarker1 = "@include('components.navbar')";
    const startMarker2 = '<body>';
    const endMarker = "@include('components.footer')";
    
    let startIndex = content.indexOf(startMarker1);
    if (startIndex !== -1) {
        startIndex += startMarker1.length;
    } else {
        startIndex = content.indexOf(startMarker2);
        if (startIndex !== -1) {
            startIndex += startMarker2.length;
        }
    }

    let endIndex = content.indexOf(endMarker);
    if (startIndex !== -1 && endIndex !== -1 && startIndex < endIndex) {
        bodyContent = content.substring(startIndex, endIndex).trim();
    } else {
        // If no markers, maybe we just wrap what's inside body?
        const bodyMatch = content.match(/<body[^>]*>([\s\S]*?)<\/body>/);
        if (bodyMatch) {
            bodyContent = bodyMatch[1].trim();
            // remove navbar and footer if present in this matched body
            bodyContent = bodyContent.replace("@include('components.navbar')", '');
            bodyContent = bodyContent.replace("@include('components.footer')", '');
            bodyContent = bodyContent.replace(/<script src="\/js\/script\.js.*"><\/script>/, '');
            bodyContent = bodyContent.trim();
        } else {
            console.log(`Skipping ${path.basename(filePath)}: Could not parse body.`);
            return;
        }
    }

    // Sometimes they use @include('components.navbar') multiple times or have wrappers, let's be safe.
    bodyContent = bodyContent.replace(/@include\('components\.navbar'\)/g, '');
    bodyContent = bodyContent.replace(/<script src="\/js\/script\.js.*"><\/script>/g, '');
    bodyContent = bodyContent.trim();

    const newContent = `${phpBlock}@extends('layouts.public')
${seoBlock}${stylesBlock}
@section('content')
${bodyContent}
@endsection
${scriptsBlock}`;

    fs.writeFileSync(filePath, newContent, 'utf-8');
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
console.log('Done!');
