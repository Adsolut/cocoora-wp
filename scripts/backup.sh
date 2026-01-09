#!/bin/bash
#
# Cocoora WordPress Backup Script
# Creates backup of database and theme files
#
# Usage: ./scripts/backup.sh [local|remote]
#

set -e

# Load environment variables
if [ -f .env ]; then
    source .env
fi

# Configuration
BACKUP_TYPE="${1:-local}"
BACKUP_DIR="./backups"
TIMESTAMP=$(date +%Y%m%d-%H%M%S)
BACKUP_NAME="cocoora-backup-${TIMESTAMP}"

echo ""
echo "💾 Cocoora Backup Script"
echo "════════════════════════════════════════════════════════"
echo ""

# Create backup directory
mkdir -p "${BACKUP_DIR}"

if [ "$BACKUP_TYPE" = "local" ]; then
    echo "📦 Creating LOCAL backup..."
    echo ""

    # Create temp directory
    TEMP_DIR="${BACKUP_DIR}/${BACKUP_NAME}"
    mkdir -p "${TEMP_DIR}"

    # Step 1: Database backup
    echo "🗄️  Backing up database..."
    docker compose exec -T db mysqldump \
        -u ${DB_USER:-wordpress} \
        -p${DB_PASSWORD:-wordpress} \
        ${DB_NAME:-wordpress} > "${TEMP_DIR}/database.sql"

    if [ $? -eq 0 ]; then
        echo "   ✅ Database exported: database.sql"
    else
        echo "   ❌ Database backup failed"
        rm -rf "${TEMP_DIR}"
        exit 1
    fi

    # Step 2: Theme backup
    echo "📁 Backing up theme files..."
    cp -r ./theme/cocoora-theme "${TEMP_DIR}/theme"
    echo "   ✅ Theme copied: theme/"

    # Step 3: Uploads backup (optional)
    echo "🖼️  Checking for uploads..."
    if docker compose exec -T wordpress test -d /var/www/html/wp-content/uploads 2>/dev/null; then
        echo "   Backing up uploads (this may take a while)..."
        docker compose exec -T wordpress tar -czf - -C /var/www/html/wp-content uploads 2>/dev/null > "${TEMP_DIR}/uploads.tar.gz" || true
        if [ -s "${TEMP_DIR}/uploads.tar.gz" ]; then
            echo "   ✅ Uploads archived: uploads.tar.gz"
        else
            rm -f "${TEMP_DIR}/uploads.tar.gz"
            echo "   ⚠️  Uploads backup skipped (empty or failed)"
        fi
    else
        echo "   ⚠️  No uploads directory found"
    fi

    # Step 4: Compress everything
    echo "🗜️  Compressing backup..."
    cd "${BACKUP_DIR}"
    tar -czf "${BACKUP_NAME}.tar.gz" "${BACKUP_NAME}"
    rm -rf "${BACKUP_NAME}"
    cd - > /dev/null

    # Calculate size
    BACKUP_SIZE=$(ls -lh "${BACKUP_DIR}/${BACKUP_NAME}.tar.gz" | awk '{print $5}')

    echo ""
    echo "════════════════════════════════════════════════════════"
    echo "✅ Backup complete!"
    echo "════════════════════════════════════════════════════════"
    echo ""
    echo "   File: ${BACKUP_DIR}/${BACKUP_NAME}.tar.gz"
    echo "   Size: ${BACKUP_SIZE}"
    echo ""
    echo "To restore:"
    echo "   tar -xzf ${BACKUP_DIR}/${BACKUP_NAME}.tar.gz"
    echo "   docker compose exec -T db mysql -u wordpress -pwordpress wordpress < database.sql"
    echo ""

elif [ "$BACKUP_TYPE" = "remote" ]; then
    echo "📦 Creating REMOTE backup..."
    echo ""

    # Validate configuration
    if [ -z "$REMOTE_HOST" ] || [ -z "$REMOTE_USER" ]; then
        echo "❌ Missing remote configuration in .env file"
        echo "Required: REMOTE_HOST, REMOTE_USER"
        exit 1
    fi

    # Create backup on remote server
    echo "🔗 Connecting to ${REMOTE_HOST}..."

    ssh -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
        ${REMOTE_USER}@${REMOTE_HOST} \
        "cd /var/www/html && \
         mkdir -p ~/backups && \
         wp db export ~/backups/${BACKUP_NAME}-db.sql --allow-root && \
         tar -czf ~/backups/${BACKUP_NAME}-theme.tar.gz -C wp-content/themes cocoora-theme && \
         echo 'Backup created on remote server'"

    # Download backup
    echo ""
    echo "📥 Downloading backup..."
    mkdir -p "${BACKUP_DIR}"
    scp -i "${SSH_KEY_PATH:-~/.ssh/id_rsa}" \
        ${REMOTE_USER}@${REMOTE_HOST}:~/backups/${BACKUP_NAME}-* \
        "${BACKUP_DIR}/"

    echo ""
    echo "════════════════════════════════════════════════════════"
    echo "✅ Remote backup complete!"
    echo "════════════════════════════════════════════════════════"
    echo ""
    echo "Files saved to: ${BACKUP_DIR}/"
    ls -la "${BACKUP_DIR}/${BACKUP_NAME}"* 2>/dev/null || true
    echo ""

else
    echo "❌ Unknown backup type: $BACKUP_TYPE"
    echo "Usage: ./scripts/backup.sh [local|remote]"
    exit 1
fi
