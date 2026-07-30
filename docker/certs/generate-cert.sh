#!/bin/bash

# Self-signed SSL certificate generation script for local development
# This script generates SSL certificates for local-www.rogerssportsandmedia.com

set -e

DOMAIN="local-www.rogerssportsandmedia.com"
CERT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
CERT_FILE="$CERT_DIR/${DOMAIN}.crt"
KEY_FILE="$CERT_DIR/${DOMAIN}.key"
DAYS=365

echo "Generating self-signed SSL certificate for $DOMAIN..."
echo ""

# Check if certificates already exist
if [ -f "$CERT_FILE" ] && [ -f "$KEY_FILE" ]; then
    echo "✓ SSL certificates already exist at:"
    echo "  Certificate: $CERT_FILE"
    echo "  Key: $KEY_FILE"
    echo ""
    read -p "Do you want to regenerate them? (y/n) " -n 1 -r
    echo ""
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 0
    fi
fi

# Generate self-signed certificate valid for DAYS
openssl req -x509 -newkey rsa:2048 -keyout "$KEY_FILE" -out "$CERT_FILE" \
    -days "$DAYS" -nodes -subj "/CN=$DOMAIN/O=Local Development/C=CA" \
    -addext "subjectAltName=DNS:$DOMAIN,DNS:www.$DOMAIN" \
    2>/dev/null

if [ $? -eq 0 ]; then
    echo "✓ SSL certificates generated successfully!"
    echo ""
    echo "Certificate: $CERT_FILE"
    echo "Key: $KEY_FILE"
    echo "Expires in: $DAYS days"
    echo ""
    echo "If you're using macOS, you may want to trust this certificate:"
    echo "  sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain $CERT_FILE"
    echo ""
else
    echo "✗ Error: Failed to generate SSL certificate"
    exit 1
fi
