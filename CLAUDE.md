# Farbest Classic Theme

Active WordPress **classic** theme for Farbest Brands. Built fresh in July 2026 to replace both
the FSE `farbest-block-theme` (archived at tag `archive/fse-final`) and the 2013-era underscores
`farbest` theme.

## Hard rule

**Never add `templates/index.html` or `theme.json` to this theme.** Either one flips
`wp_is_block_theme()` to `true`, which changes how WordPress resolves templates and previously
caused the catalog plugin to skip `get_header()`/`get_footer()` entirely — headerless pages.
Everything `theme.json` would have provided lives in `css/tokens.css` and `css/base.css`.

## Structure

```
style.css              theme header only — no styles
functions.php          setup, asset enqueue, includes
header.php             sticky header, hamburger, mobile drawer; opens #page and #content
footer.php             closes #content, wave divider, 3-column footer; closes #page
index.php              fallback loop — archive.php and search.php delegate here
page.php single.php    thin wrappers around template-parts/
404.php comments.php searchform.php
page-card-grid.php     "Card Grid" template
page-hills.php         "Hills & Valley" template
template-parts/        content.php, content-page.php, content-single.php, content-none.php
inc/                   widgets.php, acf.php, card-grid.php
css/ js/ images/ acf-json/
```

## CSS load order

`tokens.css` → `base.css` → `global.css` → `header.css` → `footer.css`, then conditionally
`card-grid.css` (Card Grid template) and `ingredient-single.css` (single `fpc_ingredient`).
Everything depends on `tokens.css`; enqueued in `farbest_scripts()` with `farbest_asset_version()`
(filemtime) for cache busting.

- `tokens.css` — brand palette, layout widths, fluid type scale. Single source of truth.
- `base.css` — hand-written stand-in for what `theme.json` used to generate: element styles,
  typography, buttons, `.site-constrained` / `.alignwide` / `.alignfull`.

## Layout contract

`header.php` opens `#page.site.site-wrap` then `#content.site-content`; `footer.php` closes both.
The sticky footer and the hills artwork in `global.css` key off `.site-wrap > .site-content` and
`footer.site-footer` — **not** `<main>`, because the plugin's `single-ingredient.php` emits no
`<main>` of its own. Page templates put their own `<main id="main">` inside `#content`.

`js/header.js` clones `.farbest-header__nav`'s innerHTML into `.farbest-mobile-menu__nav`, so the
mobile drawer mirrors whatever menu is assigned to the `primary` location.

## Plugin integration

Works alongside `plugins/farbest-product-catalog` (1.6.0+). The plugin owns **all** ingredient
templates and intercepts `template_include` for `is_singular('fpc_ingredient')`,
`is_post_type_archive('fpc_ingredient')` and `is_tax('fpc_category')`. Do not add
`single-fpc_ingredient.php` or `archive-fpc_ingredient.php` here. The theme's only contribution is
`css/ingredient-single.css`.

The plugin also owns the `benefits_columns` ACF repeater and its markup.

## Card Grid

`inc/card-grid.php` exposes `farbest_render_card_grid( $post_id )`. The `group_card_grid`
repeater it used to register in PHP now lives in `acf-json/group_card_grid.json` (scoped to
`page_template == page-card-grid.php`), because ACF hides PHP-registered groups from the
Custom Fields → Field Groups screen. The flip interaction is pure CSS — no JavaScript.
Client workflow: assign the "Card Grid" template to a page, then fill in the "Cards" meta box
below the editor.

## ACF field groups

`inc/acf.php` registers `acf-json/` as ACF's Local JSON load **and** save point. The theme owns
only `group_card_grid`; the ingredient/category groups are Local JSON inside the catalog plugin,
which appends its own load point and routes its own saves back to itself. On a fresh environment
the groups show up under Custom Fields → Field Groups → **Sync available** — they already work
before syncing; syncing just makes them editable in the admin.

## Widget areas

Only `footer_left`, `footer_center`, `footer_right`. IDs deliberately match the old theme so the
widgets already assigned on staging carry over. Each column falls back to static markup when
empty.

## Deliberately absent

No `products` / `staff` / `homepage` / `partners` CPTs, no legacy landing-page or colors
templates, no jQuery, no ShiftNav, no build step. Content still in the database for those CPTs is
untouched but has no template here — see the migration notes before go-live.

## Deploy

Branch `staging` → `.github/workflows/deploy-staging.yml` → rsync to
`farbest.navesinkwebsolutions.com/.../themes/farbest-classic/`.
The theme must be **activated** on staging before the first deploy is visible.
