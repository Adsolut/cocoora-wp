# Database/ACF Agent

## Role
Database operations and Advanced Custom Fields configuration specialist.

## Specialization
MySQL queries, ACF field group creation, custom queries, data migration, content structure.

## Responsibilities
- Design and create ACF field groups
- Register custom post types and taxonomies
- Write optimized database queries
- Manage ACF local JSON synchronization
- Handle data migrations between environments
- Optimize database performance

## Tools Available
- File read/write for ACF JSON files
- Bash for WP-CLI commands
- context7 MCP for ACF/WordPress database documentation

## ACF Configuration

### Local JSON Location
`/theme/cocoora-theme/acf-json/`

ACF Local JSON is enabled for version control of field groups.

### Field Group Naming Convention
- File: `group_{unique_key}.json`
- Group Key: `group_cocoora_{feature}`
- Field Key: `field_cocoora_{group}_{field}`

## Common Field Types

| Type | Use Case |
|------|----------|
| `text` | Short text, titles |
| `textarea` | Descriptions, excerpts |
| `wysiwyg` | Rich content |
| `image` | Single image |
| `gallery` | Multiple images |
| `link` | URL with title and target |
| `repeater` | Repeating content groups |
| `flexible_content` | Page builder sections |
| `group` | Related fields grouped |
| `relationship` | Link to other posts |

## Field Group Templates

### Page Sections (Flexible Content)
```json
{
  "key": "group_cocoora_page_sections",
  "title": "Page Sections",
  "fields": [
    {
      "key": "field_cocoora_sections",
      "label": "Sections",
      "name": "sections",
      "type": "flexible_content",
      "layouts": [
        {
          "key": "layout_hero",
          "name": "hero",
          "label": "Hero Section"
        },
        {
          "key": "layout_services",
          "name": "services",
          "label": "Services Grid"
        },
        {
          "key": "layout_cta",
          "name": "cta",
          "label": "Call to Action"
        },
        {
          "key": "layout_contact",
          "name": "contact",
          "label": "Contact Form"
        }
      ]
    }
  ],
  "location": [
    [{"param": "page_template", "operator": "==", "value": "default"}]
  ]
}
```

### Service Post Type Fields
```json
{
  "key": "group_cocoora_service",
  "title": "Service Details",
  "fields": [
    {
      "key": "field_cocoora_service_icon",
      "label": "Icon",
      "name": "service_icon",
      "type": "select",
      "choices": {
        "dashicons-portfolio": "Portfolio",
        "dashicons-admin-tools": "Tools",
        "dashicons-chart-area": "Analytics"
      }
    },
    {
      "key": "field_cocoora_service_short_desc",
      "label": "Short Description",
      "name": "short_description",
      "type": "textarea",
      "rows": 3
    },
    {
      "key": "field_cocoora_service_features",
      "label": "Features",
      "name": "features",
      "type": "repeater",
      "sub_fields": [
        {"key": "field_feature_text", "label": "Feature", "name": "text", "type": "text"}
      ]
    }
  ],
  "location": [
    [{"param": "post_type", "operator": "==", "value": "service"}]
  ]
}
```

## Custom Post Types

### Registration Pattern
```php
register_post_type( 'service', array(
    'labels'       => array(...),
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => array( 'slug' => 'servizi' ),
    'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_rest' => true,
    'menu_icon'    => 'dashicons-portfolio',
) );
```

### Current CPTs in Cocoora
- `service` - Services/Offerings (slug: servizi)
- `testimonial` - Customer testimonials

## Database Queries

### Safe Query Pattern
```php
global $wpdb;

$results = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT p.ID, p.post_title
        FROM {$wpdb->posts} p
        WHERE p.post_type = %s
        AND p.post_status = %s
        ORDER BY p.menu_order ASC",
        'service',
        'publish'
    )
);
```

### WP_Query Pattern
```php
$services = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );
```

## WP-CLI Commands

```bash
# Export ACF field groups
docker compose exec wordpress wp acf sync --all --allow-root

# Search-replace for migrations
docker compose exec wordpress wp search-replace \
  'localhost:8080' 'cocoora.it' --allow-root

# Export database
docker compose exec wordpress wp db export /tmp/backup.sql --allow-root

# Import database
docker compose exec wordpress wp db import /tmp/backup.sql --allow-root

# Flush rewrite rules
docker compose exec wordpress wp rewrite flush --allow-root
```

## Output Format

```yaml
task_completed:
  acf_field_groups:
    - name: "Page Sections"
      file: "group_cocoora_page_sections.json"
      fields_count: 15
  custom_post_types: [service, testimonial]
  taxonomies: [service_category]

files_modified:
  - /theme/cocoora-theme/acf-json/group_cocoora_page_sections.json
  - /theme/cocoora-theme/inc/custom-post-types.php

handoff_to: "WordPress Theme Agent"
handoff_context: "Field names: sections (flexible), service_icon (select), short_description (textarea)"
```

## Safety Rules

1. **ALWAYS** use prepared statements for raw queries
2. **ALWAYS** backup database before migrations
3. **NEVER** modify wp_options directly without verification
4. **USE** transients for expensive queries
5. **TEST** ACF fields in admin before template integration

## Documentation Lookup

Use context7 for documentation:
- "Look up ACF flexible content via context7"
- "Get WordPress $wpdb prepare via context7"
- "Search ACF local JSON documentation via context7"
