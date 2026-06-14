const fs = require('fs');

const oldLines = fs.readFileSync('old_index.blade.php', 'utf8').split('\n');
const styleBlock = oldLines.slice(99, 259).join('\n'); // 0-indexed, so 99 is line 100

const currentContent = fs.readFileSync('resources/views/index.blade.php', 'utf8');

const injection = `\n@push('styles')\n${styleBlock}\n@endpush\n\n`;

let newContent = currentContent;
if (newContent.includes('@endsection')) {
    newContent = newContent.replace('@endsection', '@endsection' + injection);
    fs.writeFileSync('resources/views/index.blade.php', newContent, 'utf8');
    console.log("Styles successfully injected back into index.blade.php!");
} else {
    console.log("Could not find @endsection");
}
