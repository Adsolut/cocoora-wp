#!/bin/bash
#
# Cocoora WordPress Deployment Script
# Deploys theme files to production server
#
# Usage: ./scripts/deploy.sh [staging|production]
#

set -e

# Load environment variables
if [ -f .env ]; then
    source .env
fi

# Configuration
ENVIRONMENT="${1:-staging}"
THEME_DIR="./theme/cocoora-theme"

# Environment-specific settings
if [ "$ENVIRONMENT" = "production" ]; then
    REMOTE_HOST="${PRODUCTION_HOST:-${REMOTE_HOST}}"
    REMOTE_PATH="${PRODUCTION_PATH:-${REMOTE_PATH}}"
    echo "⚠️  Deploying to PRODUCTION"
elif [ "$ENVIRONMENT" = "staging" ]; then
    REMOTE_HOST="${STAGING_HOST:-staging.${REMOTE_HOST}}"
    REMOTE_PATH="${STAGING_PATH:-${REMOTE_PATH}}"
    echo "📦 Deploying to STAGING"
else
    echo "❌ Unknown environment: $ENVIRONMENT"
    echo "Usage: ./scripts/deploy.sh [staging|production]"
    exit 1
fi

# Validate configuration
if [ -z "$REMOTE_HOST" ] || [ -z "$REMOTE_PATH" ] || [ -z "$REMOTE_USER" ]; then
    echo "❌ Missing deployment configuration in .env file"
    echo "Required: REMOTE_HOST, REMOTE_PATH, REMOTE_USER"
    exit 1
fi

# Confirm production deployment
if [ "$ENVIRONMENT" = "production" ]; then
    read -p "Are you sure you want to deploy to PRODUCTION? (yes/no) " confirm
    if [ "$confirm" != "yes" ]; then
        echo "Deployment cancelled."
        exit 0
    fi
fi

echo ""
echo "🚀 Starting deployment to ${REMOTE_HOST}..."
echo "   Path: ${REMOTE_PATH}"
echo ""

# Step 1: Build production assets
echo "📦 Building production assets..."
npm run build

if [ $? -ne 0 ]; then
    echo "❌ Build failed. Aborting deployment."
    exit 1
fi

echo "✅ Build complete"
echo ""

# Step 2: Create backup on remote (optional)
if [ "$ENVIRONMENT" = "production" ]; then
    echo "💾 Creating backup on remote server..."
    ssh -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
        ${REMOTE_USER}@${REMOTE_HOST} \
        "cd ${REMOTE_PATH} && tar -czf ../cocoora-theme-backup-\$(date +%Y%m%d-%H%M%S).tar.gz ." \
        2>/dev/null || echo "⚠️  Backup skipped (directory may not exist)"
    echo ""
fi

# Step 3: Sync theme files
echo "📤 Syncing theme files..."
rsync -avz --delete \
    --exclude 'node_modules' \
    --exclude '.git' \
    --exclude '.gitignore' \
    --exclude 'src' \
    --exclude '.DS_Store' \
    -e "ssh -i ${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
    ${THEME_DIR}/ \
    ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}/

if [ $? -ne 0 ]; then
    echo "❌ File sync failed. Aborting deployment."
    exit 1
fi

echo "✅ Files synced"
echo ""

# Step 4: Set permissions
echo "🔒 Setting file permissions..."
ssh -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
    ${REMOTE_USER}@${REMOTE_HOST} \
    "find ${REMOTE_PATH} -type f -exec chmod 644 {} \; && find ${REMOTE_PATH} -type d -exec chmod 755 {} \;"

echo "✅ Permissions set"
echo ""

# Step 5: Clear caches
echo "🧹 Clearing caches..."
ssh -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
    ${REMOTE_USER}@${REMOTE_HOST} \
    "cd /var/www/html && wp cache flush --allow-root 2>/dev/null || true"

# Clear any object cache plugins
ssh -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
    ${REMOTE_USER}@${REMOTE_HOST} \
    "cd /var/www/html && wp transient delete --all --allow-root 2>/dev/null || true"

echo "✅ Caches cleared"
echo ""

# Step 6: Verify deployment
echo "🔍 Verifying deployment..."
REMOTE_VERSION=$(ssh -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
    ${REMOTE_USER}@${REMOTE_HOST} \
    "grep 'Version:' ${REMOTE_PATH}/style.css | head -1 | awk '{print \$2}'" 2>/dev/null || echo "unknown")

echo "   Remote theme version: ${REMOTE_VERSION}"
echo ""

# Complete
echo "════════════════════════════════════════════════════════"
echo "✅ Deployment to ${ENVIRONMENT} complete!"
echo "════════════════════════════════════════════════════════"
echo ""
echo "Next steps:"
echo "  1. Verify the site at https://${REMOTE_HOST}"
echo "  2. Check for any console errors"
echo "  3. Test critical user flows"
echo ""
