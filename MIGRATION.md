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
| 3 | Block Theme Foundation (`farbest-blocks`) | 🔄 In progress |
| 4 | Plugin Integration with Block Theme | 🔲 Not started |
| 5 | jQuery Elimination | 🔲 Not started |
| 6 | Legacy Cleanup | 🔲 Not started |

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
- [ ] `src/blocks/ingredient-catalog/block.json`
- [ ] `src/blocks/ingredient-catalog/edit.js` — placeholder in editor
- [ ] `src/blocks/ingredient-catalog/view.js` — mounts React app on frontend
- [ ] Build block with `npm run build`
- [ ] Verify React app mounts correctly on `/ingredients/`

---

## Phase 4 — Plugin Integration with Block Theme 🔲

**Goal:** Plugin works cleanly with `farbest-blocks`; REST API, templates, and block all wired up.

### Tasks
- [ ] Update `FPC_Template_Loader` — check for block templates (`.html`) before falling back to PHP templates
- [ ] Register `farbest/ingredient-catalog` block in plugin (`register_block_type`)
- [ ] Update asset enqueue — load plugin assets when the block is present on any page (not just archive/single/taxonomy)
- [ ] Remove `.fbd-hero` definition from `main.scss` — theme owns hero skin
- [ ] Security: add server-side nonce validation to `POST /submit-contact` REST handler
- [ ] Security: filter `get_ingredient` REST response — remove `rep_code_primary`, `rep_code_secondary` from public output
- [ ] Run `product_applications` data migration if any pre-taxonomy content exists (`wp farbest migrate`)
- [ ] Update plugin `CLAUDE.md` to reflect block theme integration

---

## Phase 5 — jQuery Elimination 🔲

**Goal:** Remove jQuery UI and animation library dependencies; replace with modern CSS/JS.

### Tasks
- [ ] Replace jQuery UI Accordion (team page, ingredient sidebar) → WordPress native Details block
- [ ] Replace viewport checker scroll animations → CSS `@keyframes` + Intersection Observer API
- [ ] Remove `js/doubletaptogo.min.js` — replace with CSS `:hover`/`:focus-within`
- [ ] Remove ShiftNav mobile menu → block theme native navigation
- [ ] Remove `js/navigation.js` — handled by block theme
- [ ] Delete retired JS files from repo
- [ ] Remove jQuery UI enqueue calls from `functions.php`
- [ ] Remove viewport checker enqueue calls from `functions.php`

---

## Phase 6 — Legacy Cleanup 🔲

**Goal:** Remove dead templates, split `functions.php`, resolve hardcoded page IDs.

### Template cleanup
- [ ] Delete `page-filter-demo.php`
- [ ] Delete `page-ingredients.php`
- [ ] Delete `content-ingredients.php`
- [ ] Delete `headerBASE.php`, `headerFBEST.php`, `headerOLD.php`, `headerOLD2.php`
- [ ] Audit `page-whouse.php` vs `page-warehousing.php` — delete duplicate

### `functions.php` split
- [ ] Create `inc/cpt-legacy.php` — legacy `products`, `staff`, `partners` CPTs
- [ ] Create `inc/enqueue.php` — script/style enqueue logic
- [ ] Create `inc/widgets.php` — widget area registration
- [ ] Create `inc/acf.php` — ACF-dependent hooks
- [ ] Verify `functions.php` drops below 400 lines after split

### Hardcoded page IDs (in `footer.php`)
- [ ] Page 1453 (jscolor) — replace with body class or ACF options check
- [ ] Pages 1459, 1461, 18, 77, 79, 1054 — audit each, replace with dynamic checks

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
