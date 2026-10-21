# Block validator

Hand-written block markup must match what each block's `save()` produces, or the editor shows "This block contains unexpected or invalid content". This tool runs WordPress's own block library (from npm) under jsdom and validates every block, the same way the editor does. You don't need a WordPress install or a login.

```sh
cd tools/block-validator && npm install          # once
./validate.sh "$PWD"/../../patterns/*.php "$PWD"/../../templates/*.html "$PWD"/../../parts/*.html
```
PHP patterns are rendered through PHP first (with tiny stubs for the WordPress functions they use). Set `PHP=/path/to/php` if `php` isn't on your PATH. For every invalid block it prints the expected and the actual markup around the first difference.

Caveat: npm's block library can be slightly newer than the WordPress version on a site. If the editor and this tool disagree, the editor wins.
