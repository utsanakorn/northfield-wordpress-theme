# Northfield College WordPress Theme

A custom WordPress theme for a college marketing and student recruitment website. It shows how I build WordPress sites end to end: PHP templates, a custom post type with ACF fields, custom Gutenberg blocks written in React, and a responsive SCSS design system.

**Live demo:** [add link]
**Figma design:** [add link]

![Home page](docs/screenshot-home.png)

## Features

- **Custom theme from scratch.** Classic PHP templates (`header.php`, `footer.php`, `page.php`, `single-program.php`, `archive-program.php`, `404.php`) plus `theme.json` for editor colors, fonts and layout widths.
- **Custom post type and taxonomy.** `program` (Programs) and `school` (Schools), both exposed to the REST API.
- **ACF fields registered in code.** Credential, length, delivery mode, next start date and apply link are version-controlled in `inc/acf-fields.php` instead of living only in the database.
- **React Gutenberg blocks** built with `@wordpress/scripts`:
  - `northfield/hero` (Intake Hero): static block with RichText, MediaUpload and InspectorControls.
  - `northfield/program-grid` (Program List): dynamic block. The editor fetches live programs from the REST API with `useSelect` and `core-data`; the front end renders in PHP (`render.php`) so the list is always current.
- **ACF block** `acf/testimonial` (Graduate Story) with a PHP render template and a related Program field. Requires ACF Pro.
- **SCSS design system.** Tokens, base, layout and component partials, mobile-first breakpoints, Flexbox and CSS Grid, BEM class names.
- **Accessibility.** Skip link, visible focus styles, accessible mobile menu (`aria-expanded`, Escape to close), `prefers-reduced-motion` support, semantic `dl` for program facts.
- **Performance.** Font preconnect, deferred JS, `no_found_rows` on block queries, file-modified cache busting for CSS.
- **Code quality.** ESLint, Stylelint and Prettier through `@wordpress/scripts`; output is escaped with `esc_html`, `esc_url` and `esc_attr`.

## Tech stack

PHP 8, WordPress 6.4+, React (via `@wordpress/element`), JavaScript ES6+, SCSS, ACF, Gutenberg Block API v3, WordPress REST API, Git.

## Project structure

```
northfield-theme/
├── acf-blocks/testimonial/   ACF block (block.json + render.php)
├── assets/
│   ├── css/main.css          Compiled from src/scss
│   └── js/navigation.js      Mobile menu
├── build/blocks/             Compiled React blocks (committed so the theme works after cloning)
├── inc/
│   ├── setup.php             Theme supports, menus, image sizes
│   ├── enqueue.php           Styles, scripts, resource hints
│   ├── post-types.php        Program CPT + School taxonomy
│   ├── acf-fields.php        ACF field groups in code
│   ├── blocks.php            Block registration + inserter category
│   └── template-tags.php     Template helpers
├── src/
│   ├── blocks/hero/          React source for Intake Hero
│   ├── blocks/program-grid/  React source + render.php for Program List
│   └── scss/                 Design tokens and partials
├── template-parts/           Reusable template partials
├── theme.json
└── *.php                     Page templates
```

## Getting started

1. Create a local site with [LocalWP](https://localwp.com/) (or any WordPress 6.4+ install).
2. Clone this repo into `wp-content/themes/`:
   ```bash
   git clone https://github.com/utsanakorn/northfield-wordpress-theme.git
   ```
3. Activate **Northfield College** under Appearance > Themes.
4. Install and activate **Advanced Custom Fields** (ACF Pro is needed only for the Graduate Story block).
5. Go to Settings > Permalinks and click Save once.
6. Add a few Programs and Schools, then build the home page with the Intake Hero and Program List blocks.

## Development

```bash
npm install
npm run start:blocks   # watch React blocks
npm run watch:css      # watch SCSS
npm run build          # production build of blocks and CSS
npm run lint:js
npm run lint:css
```

## Screenshots

| Home | Program page | Mobile |
| --- | --- | --- |
| ![Home](docs/screenshot-home.png) | ![Program](docs/screenshot-program.png) | ![Mobile](docs/screenshot-mobile.png) |

## Author

Kate (Utsanakorn) Chinkanglor
Portfolio: https://kate-portfolio-theta.vercel.app
GitHub: https://github.com/utsanakorn
