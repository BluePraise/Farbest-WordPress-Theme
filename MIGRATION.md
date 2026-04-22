# Farbest Migration Tracker
## Classic Theme → Gutenberg Block Theme (`farbest-blocks`)

**Started:** 2026-04-22  
**Branch:** `feat/block-theme`  
**Repos:** `theme/farbest` + `plugins/farbest-product-catalog`

---

## Progress Overview

| Phase | Description | Status |
|---|---|---|
| 1 | Color System Consolidation | ✅ Done |
| 2 | CSS Cleanup & BEM Refactor | ✅ Done |
| 3 | Block Theme Foundation (`farbest-blocks`) | ✅ Done |
| 4 | Plugin Integration with Block Theme | ✅ Done |
| 5 | jQuery Elimination | ✅ Done |
| 6 | Legacy Cleanup | ✅ Done |

---

## Phase 1 — Color System Consolidation ✅

**Goal:** Single source of truth for all brand colors across theme and plugin.

### Completed tasks

- [x] Created `css/tokens.css` — all brand colors as CSS custom properties (`--farbest-*` + semantic `--color-*` aliases)
- [x] Updated `css/farbest.css` — all hardcoded hex values replaced with token references
- [x] Fixed `--fb-color-primary` — was Bootstrap blue `#0d6efd`, now `var(--color-primary)` (`#648c1c`)
- [x] Fixed `p.fbd-hero-subtitle` font-size — `24px` → `1.5rem` (resolved TODO)
- [x] Removed duplicate `color` declaration on `.btn`
- [x] Updated `css/ingredient-single.css` — all hardcoded hex values replaced with tokens
- [x] Fixed warm grey typo — `#383836` and `#383838` both now `var(--farbest-warm-grey)`
- [x] Updated `functions.php` — `tokens.css` enqueued first as a dependency of both stylesheets
- [x] Updated plugin `assets/src/styles/main.scss` — SCSS variables aligned exactly with `tokens.css` values
- [x] Fixed plugin `$border-color` — was `#383836`, now `#383838`
- [x] Fixed plugin `$bg-light` — was `#F5F3EF`, now `#f2efe9`
- [x] Added `$cta-color-dark`, `$cta-text`, `$bg-dark` to cover previously hardcoded plugin values
- [x] Replaced all remaining hardcoded hex values in `main.scss` with variables
- [x] Built plugin — `npm run build` clean ✅

### Files changed
- `css/tokens.css` ← **new file**
- `css/farbest.css`
- `css/ingredient-single.css`
- `functions.php`
- `../plugins/farbest-product-catalog/assets/src/styles/main.scss`
- `../plugins/farbest-product-catalog/assets/build/index.css` ← compiled

---

## Phase 2 — CSS Cleanup & BEM Refactor ✅

**Goal:** Remove dead CSS files, fix BEM classnames, reduce file count.

### Completed tasks

- [x] Deleted `css/jquery-ui.css`
- [x] Deleted `css/jquery-ui.structure.css`
- [x] Deleted `layouts/content-sidebar.css`
- [x] Deleted `layouts/sidebar-content.css`
- [x] Deleted `css/animate.css`
- [x] Removed hardcoded `<link>` and `<script>` tags for deleted files from `header.php`
- [x] Removed `#demo-ribbon` / `.demo-ribbon-*` styles from `farbest.css` (deprecated `page-filter-demo.php` only)
- [x] BEM rename: `ingredient-cert-logos` → `ingredient-certifications__list`
- [x] BEM rename: `ingredient-cert-logo` → `ingredient-certifications__logo`
- [x] Updated `farbest-catalog/single-ingredient.php` (theme override) with new BEM classes
- [x] Updated `plugin/templates/single-ingredient.php` with new BEM classes
- [x] Updated `main.scss` with new BEM class names + fixed stale combined selector
- [x] Built plugin — `npm run build` clean ✅

### Files changed
- `header.php`
- `css/farbest.css`
- `farbest-catalog/single-ingredient.php`
- `../plugins/farbest-product-catalog/templates/single-ingredient.php`
- `../plugins/farbest-product-catalog/assets/src/styles/main.scss`
- `../plugins/farbest-product-catalog/assets/build/index.css` ← compiled
- **Deleted:** `css/jquery-ui.css`, `css/jquery-ui.structure.css`, `css/animate.css`, `layouts/content-sidebar.css`, `layouts/sidebar-content.css`

---

## Phase 3 — Block Theme Foundation 🔲

**Goal:** Scaffold and build `farbest-blocks/` — a new FSE block theme using `create-block-theme` plugin.

### Setup tasks
- [x] Scaffold blank block theme (`farbest-block-theme` folder created via Create Block Theme plugin)
- [x] Copied `templates/`, `parts/`, `theme.json` into main `farbest` repo (tracked in git)
- [x] Symlinked to Local by Flywheel (`farbest-01` site)
- [x] `css/tokens.css` already present and enqueued in `functions.php`
- [x] Init `package.json` with `@wordpress/scripts` (mirror plugin build pipeline)

### `theme.json` tasks
- [x] Define full color palette (11 brand colors — mirrors `tokens.css`)
- [x] Define typography scale (fluid, 6 steps)
- [x] Define spacing scale (fluid, 7 steps)
- [x] Define button styles (lime bg, navy text, hover state)
- [x] Disable default WordPress color palette

### Templates
- [x] `templates/index.html` — scaffolded (query loop + pagination)
- [x] `templates/page.html` — post title + post content, constrained layout
- [x] `templates/home.html` — hero cover + ingredients intro + partners sections
- [x] `templates/404.html` — OOPS heading + back to home CTA
- [x] `templates/single-fpc_ingredient.html` — teal hero band + content/sidebar layout (certifications, claims, applications)
- [x] `templates/archive-fpc_ingredient.html` — teal header + placeholder for farbest/ingredient-catalog block

### Template parts
- [x] `parts/header.html` — logo + primary nav, white bg, mobile overlay menu
- [x] `parts/footer.html` — navy bg, 3-column (logo/tagline, nav, contact), copyright bar

### Block patterns
- [x] `patterns/hero.php` — teal Cover + heading + subtitle + lime CTA button
- [x] `patterns/cta-section.php` — beige Group + centered heading + lime button
- [x] `patterns/product-grid.php` — Query Loop, fpc_ingredient, 3-col card grid
- [x] `patterns/locations-grid.php` — Query Loop, warehousing posts, 3-col grid
- [x] `patterns/partners-grid.php` — Query Loop, partners CPT, 4-col logo grid

### Custom block — `farbest/ingredient-catalog` (only custom block)
- [x] `src/blocks/ingredient-catalog/block.json`
- [x] `src/blocks/ingredient-catalog/index.js` — registers block type
- [x] `src/blocks/ingredient-catalog/edit.js` — placeholder in editor
- [x] `src/blocks/ingredient-catalog/view.js` — ensures #farbest-ingredient-grid mount point exists
- [x] Build block with `npm run build` — compiled successfully to `build/ingredient-catalog/`
- [x] Registered via `farbest_register_blocks()` in `functions.php`
- [ ] Verify React app mounts correctly on `/ingredients/`

---

## Phase 4 — Plugin Integration with Block Theme 🔲

**Goal:** Plugin works cleanly with `farbest-blocks`; REST API, templates, and block all wired up.

### Tasks
- [x] Update `FPC_Template_Loader` — checks block theme `.html` template first, falls back to PHP classic/plugin templates
- [x] Update asset enqueue — loads plugin assets when `farbest/ingredient-catalog` block is present (`has_block()`)
- [x] Remove `.fbd-hero` block from `main.scss` — theme owns hero skin; plugin rebuilt clean ✅
- [x] Security: nonce validation on `POST /submit-contact` via `X-WP-Nonce` header in `permission_callback`
- [x] Security: `rep_code_primary` and `rep_code_secondary` stripped from public `get_ingredient` REST response
- [ ] Register `farbest/ingredient-catalog` block in plugin (`register_block_type`) — handled by theme; skip
- [ ] Run `product_applications` data migration if any pre-taxonomy content exists (`wp farbest migrate`)
- [ ] Update plugin `CLAUDE.md` to reflect block theme integration

---

## Phase 5 — jQuery Elimination 🔲

**Goal:** Remove jQuery UI and animation library dependencies; replace with modern CSS/JS.

### Tasks
- [x] Remove `js/navigation.js` enqueue from `functions.php` — block theme native nav handles this
- [x] Remove `js/skip-link-focus-fix.js` enqueue from `functions.php` — not needed in block theme
- [x] Rename `jquery_accordion_widgets_init` → `farbest_ingredient_sidebar_init` in `functions.php`
- [x] ShiftNav toggle only in `header.php` (classic) — block theme header uses native nav overlay; no action needed
- [x] Viewport checker + animate inline JS only in `footer.php` (classic) — tied to old home page sections deleted in Phase 6
- [x] `doubletaptogo.min.js` — only referenced inline in `footer.php`; file deleted in Phase 6
- [ ] Delete retired JS files (`navigation.js`, `skip-link-focus-fix.js`, `doubletaptogo.min.js`, `jquery-ui.js`, `jquery.viewportchecker.min.js`, `viewportchecker.js`) — Phase 6

---

## Phase 6 — Legacy Cleanup 🔲

**Goal:** Remove dead templates, split `functions.php`, resolve hardcoded page IDs.

### Template cleanup
- [x] Deleted `page-filter-demo.php`
- [x] Deleted `page-ingredients.php`
- [x] Deleted `content-ingredients.php`
- [x] Deleted `headerBASE.php`
- [x] Audited `page-whouse.php` vs `page-warehousing.php` — deleted `page-whouse.php` (older hardcoded version)
- [x] Deleted retired JS: `navigation.js`, `skip-link-focus-fix.js`, `doubletaptogo.min.js`, `jquery-ui.js`, `jquery.viewportchecker.min.js`, `viewportchecker.js`

### `functions.php` split
- [x] Created `inc/cpt-legacy.php` — legacy `products`, `homepage`, `staff`, `partners` CPTs + meta boxes
- [x] Created `inc/widgets.php` — all widget area registrations
- [x] Created `inc/acf.php` — ACF JSON save point
- [x] `functions.php` reduced from 1509 → 109 lines ✅
- Note: enqueue stayed in `functions.php` (only 20 lines, no need for separate file)

### Hardcoded page IDs (in `footer.php`)
- [ ] Inline jQuery scripts gated by `is_page()` IDs — deferred; `footer.php` is a classic template and will be superseded by the block theme footer part

---

## Open Questions (BG Agency)

- [ ] Timeline for SVG category icons? (Needed for `fpc_category` term display)
- [ ] Will the new block theme introduce any new brand colors, or is the current palette final?
- [ ] Is ShiftNav being replaced by block navigation, or carried forward?
- [ ] Does the new theme use `theme.json` for all typography, or will there be a custom type scale?
- [ ] Should the contact form become a Gutenberg block, or stay as a shortcode?
- [ ] Is the sales rep routing system staying as-is, or needs UI overhaul alongside the block theme?
- [ ] Confirm: taxonomy filters are OR within each dimension, AND across — is this the intended UX?

---

## Verification Checklist (run after each phase)

- [ ] `/ingredients/` archive loads React filter app
- [ ] Single ingredient page renders (tabs, certifications, benefits columns)
- [ ] Contact form submits and routes correctly
- [ ] Mobile navigation works
- [ ] Brand colors display correctly (no Bootstrap blue)
- [ ] No 404s on CSS/JS assets
- [ ] Admin ingredient editor still functional
