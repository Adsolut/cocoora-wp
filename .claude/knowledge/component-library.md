# Cocoora Component Library

Documentation of reusable components in the Cocoora theme.

## Buttons

### Primary Button
```html
<a href="#" class="btn-primary">Label</a>
```

**Tailwind Classes:**
```css
.btn-primary {
  @apply inline-flex items-center justify-center px-6 py-3
         font-semibold rounded-lg transition-all duration-200
         bg-cocoora-blue text-white
         hover:bg-cocoora-navy focus:ring-2 focus:ring-cocoora-blue focus:ring-offset-2;
}
```

### Secondary Button
```html
<a href="#" class="btn-secondary">Label</a>
```

### Outline Button
```html
<a href="#" class="btn-outline">Label</a>
```

---

## Cards

### Basic Card
```html
<article class="card">
  <div class="card-body">
    <h3>Title</h3>
    <p>Content</p>
  </div>
</article>
```

### Card with Image
```html
<article class="card">
  <a href="#" class="block aspect-video overflow-hidden">
    <img src="..." alt="..." class="w-full h-full object-cover">
  </a>
  <div class="card-body">
    <h3>Title</h3>
    <p>Content</p>
  </div>
</article>
```

**Tailwind Classes:**
```css
.card {
  @apply bg-white rounded-xl shadow-md overflow-hidden
         transition-shadow hover:shadow-lg;
}
.card-body {
  @apply p-6;
}
```

---

## Sections

### Standard Section
```php
<section class="section">
  <div class="container">
    <!-- Content -->
  </div>
</section>
```

### Light Background Section
```php
<section class="section-light">
  <div class="container">
    <!-- Content -->
  </div>
</section>
```

**Tailwind Classes:**
```css
.section {
  @apply py-16 md:py-24;
}
.section-light {
  @apply section bg-cocoora-light;
}
```

---

## Navigation

### Nav Link
```html
<a href="#" class="nav-link">Link</a>
<a href="#" class="nav-link-active">Active Link</a>
```

### Mobile Menu Toggle
```html
<button type="button" data-menu-toggle @click="toggle()">
  <!-- Menu icon -->
</button>
```

---

## Forms

### Form Input
```html
<div>
  <label for="name" class="form-label">Name</label>
  <input type="text" id="name" class="form-input">
</div>
```

### Form Textarea
```html
<div>
  <label for="message" class="form-label">Message</label>
  <textarea id="message" rows="5" class="form-input"></textarea>
</div>
```

**Tailwind Classes:**
```css
.form-input {
  @apply block w-full rounded-lg border-gray-300
         shadow-sm focus:border-cocoora-blue focus:ring-cocoora-blue;
}
.form-label {
  @apply block text-sm font-medium text-gray-700 mb-1;
}
```

---

## Icons

### Icon in Container
```html
<div class="w-12 h-12 flex items-center justify-center bg-cocoora-blue/10 text-cocoora-blue rounded-lg">
  <svg class="w-6 h-6">...</svg>
</div>
```

### Dashicons (WordPress)
```php
<span class="dashicons dashicons-portfolio"></span>
```

---

## ACF Section Layouts

Available layouts for ACF Flexible Content:

| Layout | Template | Description |
|--------|----------|-------------|
| `hero` | `section-hero.php` | Full-width hero with background |
| `services` | `section-services.php` | Services grid |
| `cta` | `section-cta.php` | Call to action banner |
| `contact` | `section-contact.php` | Contact form + info |

### Usage in Templates
```php
<?php
if ( have_rows( 'sections' ) ) :
    while ( have_rows( 'sections' ) ) :
        the_row();
        get_template_part( 'template-parts/sections/section', get_row_layout() );
    endwhile;
endif;
?>
```

---

## Alpine.js Components

### Mobile Menu
```html
<div x-data="mobileMenu">
  <button @click="toggle()">Menu</button>
  <nav x-show="open" x-cloak>...</nav>
</div>
```

### Accordion
```html
<div x-data="accordion">
  <button @click="toggle(0)">Item 1</button>
  <div x-show="isOpen(0)">Content 1</div>
</div>
```

---

## Animation Classes

### Fade In on Scroll
```html
<div data-animate="fade-in">Content</div>
```

### Available Animations
- `fade-in` - Fade in
- `slide-up` - Slide up
- `slide-left` - Slide from left
- `slide-right` - Slide from right
- `scale-in` - Scale in

---

## Utility Classes

### Text Gradient
```html
<span class="text-gradient">Gradient Text</span>
```

### Container Variants
```html
<div class="container">Default container</div>
<div class="container-narrow">Narrow container (max-w-4xl)</div>
<div class="container-wide">Wide container (max-w-7xl)</div>
```
