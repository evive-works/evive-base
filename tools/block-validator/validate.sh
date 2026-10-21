#!/bin/bash
# Validate block markup of theme templates/parts and PHP patterns (rendered through PHP with WP stubs).
OUT=$(mktemp -d); V="$(cd "$(dirname "$0")" && pwd)"
for f in "$@"; do
  case "$f" in
    *.php) ${PHP:-php} -d display_errors=stderr -r '
      define("ABSPATH","/");
      function __($s){return $s;} function _x($s){return $s;} function esc_html__($s){return $s;} function esc_attr__($s){return $s;}
      function esc_html_e($s){echo $s;} function esc_attr_e($s){echo $s;} function esc_html_x($s){return $s;} function esc_attr_x($s){return $s;}
      function esc_html($s){return htmlspecialchars($s,ENT_QUOTES);} function esc_attr($s){return htmlspecialchars($s,ENT_QUOTES);} function esc_url($s){return $s;}
      function home_url($p=""){return "https://example.test".$p;} function get_template_directory_uri(){return "https://example.test/wp-content/themes/evive-base";}
      function get_stylesheet_directory_uri(){return "https://example.test/wp-content/themes/child";}
      function get_option($o){return 0;} function get_the_title($i){return "T";} function wp_date($f){return "2026";} function get_bloginfo($k){return "Site";}
      class WP_Block_Type_Registry{static function get_instance(){return new self;} function is_registered($n){return true;}}
      include $argv[1];' "$f" > "$OUT/$(basename "$f").html" ;;
    *) cp "$f" "$OUT/$(basename "$f").html" ;;
  esac
done
(cd "$V" && node validate.cjs "$OUT"/*.html); rm -rf "$OUT"
