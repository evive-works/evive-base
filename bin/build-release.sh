#!/usr/bin/env bash
# Build the GitHub release asset for a tag: dist/evive-base.zip with top folder evive-base/.
#   bin/build-release.sh v0.1.1
# Checks that the tag, style.css Version, EVIVE_BASE_VERSION and CHANGELOG.md agree. Files marked
# export-ignore in .gitattributes (tools/, docs/, bin/, CLAUDE.md) stay out of the zip.
set -euo pipefail
TAG=${1:?usage: bin/build-release.sh vX.Y.Z}
VER=${TAG#v}
cd "$(dirname "$0")/.."
git rev-parse -q --verify "refs/tags/$TAG" >/dev/null || { echo "Tag $TAG not found." >&2; exit 1; }
git show "$TAG:style.css" | grep -q "^Version: $VER\$" || { echo "style.css Version is not $VER." >&2; exit 1; }
git show "$TAG:functions.php" | grep -q "'EVIVE_BASE_VERSION', '$VER'" || { echo "EVIVE_BASE_VERSION is not $VER." >&2; exit 1; }
git show "$TAG:CHANGELOG.md" | grep -q "^## $VER " || { echo "CHANGELOG.md has no entry for $VER." >&2; exit 1; }
mkdir -p dist && rm -f dist/evive-base.zip
git archive --format=zip --prefix=evive-base/ -o dist/evive-base.zip "$TAG"
echo "Built dist/evive-base.zip ($TAG, $(unzip -Z1 dist/evive-base.zip | grep -vc '/$') files)"
