# CLAUDE.md - Cocoora WordPress Project

This file provides guidance to Claude Code when working with the Cocoora WordPress project.

## Project Overview

| Attribute | Value |
|-----------|-------|
| **Site** | cocoora.it |
| **Type** | Corporate/Agency Website |
| **Business** | Cocoora di Primecare srl |
| **Features** | Services/Offerings + Contact Forms + CRM |
| **Language** | Italian (primary) |

## Design Reference

**Figma**: https://www.figma.com/design/Pct8765tf4EgdRjfl9IVu0/Cocoora?node-id=0-1&t=k1XGiLFlZVBcyS21-1

## Brand Identity

### Colors
```
Primary Blue:  #008ECF  (CTAs, links, accents)
Navy:          #102D69  (headings, footer, dark elements)
White:         #FFFFFF  (backgrounds)
Light Gray:    #F5F7FA  (section backgrounds)
Dark Gray:     #1F2937  (body text)
```

### Typography
- **Headings**: Arial, system-ui, sans-serif
- **Body**: System font stack for performance

### Brand Assets
Location: `/Users/aldosantoro/Desktop/Cocoora/`
- `logo.svg` - Primary logo
- `firma_html.txt` - Email signature template

## Technical Stack

### Frontend Build
- **Build Tool**: Vite 5.x
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Vanilla JS / Alpine.js
- **Output**: `/theme/cocoora-theme/dist/`

### WordPress
- **Version**: 6.x (latest stable)
- **PHP**: 8.2+
- **Theme**: `cocoora-theme`
- **Custom Fields**: Advanced Custom Fields Pro (ACF)
- **Forms**: Contact Form 7 + Flamingo
- **SEO**: Yoast SEO

### Local Development
- **Environment**: Docker Compose
- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **Vite Dev**: http://localhost:5173

## Project Structure

```
cocoora-wp/
├── CLAUDE.md                    # This file
├── docker-compose.yml           # Local dev environment
├── .env.example                 # Environment template
├── package.json                 # Node dependencies
├── vite.config.js               # Vite configuration
├── tailwind.config.js           # Tailwind configuration
├── postcss.config.js            # PostCSS configuration
│
├── .claude/
│   ├── settings.local.json      # Claude permissions
│   ├── prompts/agents/          # Agent definitions
│   │   ├── orchestrator-agent.md
│   │   ├── wordpress-theme-agent.md
│   │   ├── frontend-build-agent.md
│   │   ├── ux-ui-review-agent.md
│   │   ├── devops-agent.md
│   │   └── database-acf-agent.md
│   └── knowledge/               # Shared context
│       ├── project-context.json
│       ├── design-tokens.json
│       └── component-library.md
│
├── src/                         # Frontend source
│   ├── css/
│   │   ├── main.css             # Tailwind entry
│   │   └── components/          # Component styles
│   ├── js/
│   │   ├── main.js              # JS entry
│   │   └── components/          # JS modules
│   └── assets/                  # Static assets
│
├── theme/cocoora-theme/         # WordPress theme
│   ├── style.css
│   ├── functions.php
│   ├── index.php
│   ├── front-page.php
│   ├── header.php
│   ├── footer.php
│   ├── inc/                     # PHP includes
│   ├── template-parts/          # Partials
│   ├── acf-json/                # ACF field groups
│   └── dist/                    # Compiled assets
│
├── figma-exports/               # Figma design exports
│   ├── desktop/
│   ├── mobile/
│   └── components/
│
├── screenshots/                 # Playwright captures
│   ├── current/
│   └── baseline/
│
└── scripts/                     # Automation
    ├── deploy.sh
    └── backup.sh
```

## Docker Commands

```bash
# Start environment
docker compose up -d

# Stop environment
docker compose down

# View logs
docker compose logs -f wordpress

# WordPress shell
docker compose exec wordpress bash

# WP-CLI
docker compose exec wordpress wp --allow-root plugin list

# MySQL CLI
docker compose exec db mysql -u wordpress -p wordpress

# Reset database (destructive)
docker compose down -v
```

## Development Commands

```bash
# Install dependencies
npm install

# Development with HMR
npm run dev

# Production build
npm run build

# Watch mode (no HMR)
npm run watch
```

## MCP Server Configuration

### Active MCP Servers (Docker MCP Gateway)

| Server | Purpose | Usage |
|--------|---------|-------|
| **context7** | Library documentation | `"Look up WordPress hooks via context7"` |
| **playwright** | Browser automation | Screenshots, visual QA |
| **docker** | Container management | Docker CLI operations |

### Using context7 for Documentation

```
# WordPress
"Use context7 to get WordPress template hierarchy docs"
"Look up ACF get_field() documentation via context7"

# Tailwind CSS
"Use context7 for Tailwind CSS grid utilities"
"Get Tailwind responsive design docs via context7"

# Vite
"Get Vite WordPress integration docs via context7"
```

### Using Playwright for Visual QA

```
# Navigate and capture
mcp__MCP_DOCKER__browser_navigate → URL
mcp__MCP_DOCKER__browser_resize → width/height
mcp__MCP_DOCKER__browser_take_screenshot → filename

# Always close browser when done
mcp__MCP_DOCKER__browser_close
```

## Agent Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    ORCHESTRATOR AGENT                        │
│           (Coordinates workflow, manages handoffs)           │
└─────────────────────────────────────────────────────────────┘
                              │
        ┌─────────────────────┼─────────────────────┐
        │                     │                     │
        ▼                     ▼                     ▼
┌───────────────┐     ┌───────────────┐     ┌───────────────┐
│   WordPress   │     │   Frontend/   │     │   UX/UI       │
│   Theme Agent │     │   Build Agent │     │   Review Agent│
└───────────────┘     └───────────────┘     └───────────────┘
        │                     │                     │
        │           ┌─────────┴─────────┐           │
        │           ▼                   ▼           │
        │   ┌───────────────┐   ┌───────────────┐   │
        │   │   DevOps      │   │   Database/   │   │
        │   │   Agent       │   │   ACF Agent   │   │
        │   └───────────────┘   └───────────────┘   │
        │                                           │
        └───────────────────────────────────────────┘
                    Shared Knowledge Base
                  (.claude/knowledge/)
```

### Agent Selection Guide

| Request Type | Primary Agent | Supporting |
|--------------|---------------|------------|
| New page template | WordPress Theme | Frontend |
| Implement section from Figma | Frontend/Build | WordPress, UX Review |
| Compare with Figma | UX/UI Review | - |
| Deploy to server | DevOps | - |
| Create contact form | Database/ACF | WordPress Theme |
| Add custom post type | Database/ACF | WordPress Theme |
| Fix responsive issue | Frontend/Build | UX Review |

## Coding Standards

### PHP (WordPress)
```php
<?php
// Always escape output
echo esc_html( $title );
echo esc_attr( $class );
echo esc_url( $link );

// Prefix all functions
function cocoora_function_name() {}

// ACF field checks
if ( $value = get_field( 'field_name' ) ) :
    // use $value
endif;
```

### Tailwind CSS
```css
/* Use @layer for custom components */
@layer components {
  .btn-primary {
    @apply bg-cocoora-blue text-white px-6 py-3 rounded-lg
           hover:bg-cocoora-navy transition-colors;
  }
}
```

### JavaScript
```javascript
// Use ES modules
export function initComponent() {
  const element = document.querySelector('[data-component]');
  if (!element) return;
  // ...
}
```

## Safety Rules

### WordPress Security
1. Always escape output: `esc_html()`, `esc_attr()`, `esc_url()`
2. Sanitize input: `sanitize_text_field()`, `sanitize_email()`
3. Use nonces for forms: `wp_nonce_field()` / `wp_verify_nonce()`
4. Prefix all functions with `cocoora_`
5. Never modify WordPress core files

### Deployment Safety
1. Always backup before deployment
2. Test on staging before production
3. Never store secrets in git
4. Use SSH keys, never passwords

### Browser Cleanup
**IMPORTANT**: Always close browser after Playwright operations:
```
mcp__MCP_DOCKER__browser_close
```

## Figma Comparison Workflow

Since no native Figma MCP exists:

1. **Export from Figma**: Save frames as PNG to `/figma-exports/`
2. **Capture live site**: Use Playwright to screenshot at same breakpoints
3. **Compare**: UX/UI Review agent identifies discrepancies
4. **Fix**: Route fixes to appropriate agent

### Breakpoints for Testing
| Name | Width | Use |
|------|-------|-----|
| Mobile | 375px | iPhone SE |
| Tablet | 768px | iPad |
| Desktop | 1280px | Laptop |
| Desktop L | 1440px | External monitor |

## Quick Start

```bash
# 1. Install dependencies
npm install

# 2. Copy environment file
cp .env.example .env

# 3. Start Docker
docker compose up -d

# 4. Visit http://localhost:8080 to set up WordPress

# 5. Activate theme
docker compose exec wordpress wp theme activate cocoora-theme --allow-root

# 6. Start development
npm run dev
```

## Contact

**Organization**: Cocoora di Primecare srl
**Address**: Via Emanuele Gianturco 92, Naples (NA), Italy
**Phone**: +39 081.1822.7784
**Email**: info@cocoora.it
