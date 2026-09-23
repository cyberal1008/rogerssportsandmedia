# Rogers Sports and Media (WordPress)

AWS Environment

Basic site environment:

- WordPress 5.7.x
- Nginx 1.2.1
- PHP 7.x.x
- MySQL 5.x

## Repository Structure

- config folder contains the local, integration, production WP config constants.
- db folder contains required db dump for local set up.
- webroot folder contains WP default folder structure.
- bin folder contains maintenance scripts.

### Technical SEO

Fixes from the RSM Technical SEO Audit live in the child theme under
`webroot/wp-content/themes/rogerssportsandmedia.com/inc/`:

- `seo-hidden-h1.php` - adds a screen-reader-only `<h1>` to the 46 pages that
  render without one, and only when the page has no `<h1>` of its own.
- `seo-archive-visibility.php` - withdraws archive URLs that were never linked
  or designed (tag, author, and the rsm_* taxonomy/CPT query archives), and
  marks paginated archives `noindex,follow`. The withdrawn URLs are forced to a
  real 404 by an explicit `template_redirect` guard: un-registering the query
  vars alone is not enough, as WordPress would otherwise fall through to the
  front page with a 200.
- `seo-redirects.php` - 301s for the 21 pages the audit flagged for removal.

The three files hook `template_redirect` in order - H1 buffer (0), redirects
(1), then the 404 guard (2) - so a retired page still redirects rather than 404s.

Note: `rsm_show`, `rsm_highlight` and `rsm_solution` lose the editor's Preview
and View buttons, because core gates those on `is_post_type_viewable()`. These
types are registered with `rewrite => false` and are only rendered inside
sliders on other pages, so they had no front-end URL to preview.

**After deploying the SEO changes, flush rewrite rules** (Settings > Permalinks >
Save, or `wp rewrite flush`) so the withdrawn archives start returning 404.

## Local Development with Docker

### Prerequisites

- Docker Desktop (https://www.docker.com/products/docker-desktop)
- Docker Compose (included with Docker Desktop)

### Quick Start

#### 1. Generate SSL Certificates

```bash
chmod +x docker/certs/generate-cert.sh
./docker/certs/generate-cert.sh
```

#### 2. Update your hosts file

Add the following line to your `/etc/hosts` file (on macOS/Linux) or `C:\Windows\System32\drivers\etc\hosts` (on Windows):

```
127.0.0.1  local-www.rogerssportsandmedia.com
```

#### 3. Start Docker containers

```bash
docker compose -f docker-compose-local.yml up -d
```

This will start:
- **PHP 8.5-FPM** container
- **Nginx** web server with HTTPS (port 443)
- **MySQL 8.0** database
- **Redis 7** cache server

#### 4. Access the site

Open your browser and navigate to:
```
https://local-www.rogerssportsandmedia.com
```

### Docker Commands

#### Start containers
```bash
docker compose -f docker-compose-local.yml up -d
```

#### Stop containers
```bash
docker compose -f docker-compose-local.yml down
```

#### View logs
```bash
docker compose -f docker-compose-local.yml logs -f [service_name]
# Example: docker compose -f docker-compose-local.yml logs -f php
```

#### Access PHP container shell
```bash
docker compose -f docker-compose-local.yml exec php sh
```

#### Access MySQL container
```bash
docker compose -f docker-compose-local.yml exec db mysql -u root -p
```

#### Run WP-CLI commands
```bash
docker compose -f docker-compose-local.yml exec php wp [command]
# Example: docker compose -f docker-compose-local.yml exec php wp db info
```

### Database

- **Host**: db (inside containers) or 127.0.0.1:3307 (from host machine)
- **User**: root
- **Password**: root
- **Database**: rogerssportsandmedia
- **Port**: 3307

#### Connect with Sequel Ace (macOS)

1. Open **Sequel Ace** application
2. Click **"+"** button to create a new connection
3. Fill in the connection details:
   - **Host**: `127.0.0.1`
   - **Port**: `3307`
   - **Username**: `root`
   - **Password**: `root`
   - **Database**: `rogerssportsandmedia` (optional, can be left blank)
4. Click **"Test Connection"** to verify
5. Click **"Add Favorite"** to save the connection
6. Click **"Connect"** to access the database

**Note**: Ensure Docker containers are running (`docker compose -f docker-compose-local.yml ps`) before connecting.

### Import DB Backup

Use the following command to import the provided compressed SQL backup.

#### Import `.sql.gz` backup into MySQL container (recommended)
```bash
gzip -dc /Users/Hardikkumar.Desai/Downloads/rogerssam-2026-06-10_07_05_59.sql.gz | docker compose -f docker-compose-local.yml exec -T db mysql -u root -proot rogerssportsandmedia
```

#### Import `.sql.gz` backup from host machine (if MySQL client is installed locally)
```bash
gzip -dc /Users/Hardikkumar.Desai/Downloads/rogerssam-2026-06-10_07_05_59.sql.gz | mysql -h 127.0.0.1 -P 3307 -u root -proot rogerssportsandmedia
```

#### Verify import
```bash
docker compose -f docker-compose-local.yml exec db mysql -u root -proot -e "USE rogerssportsandmedia; SHOW TABLES;"
```

### Redis Cache

- **Host**: redis (inside containers)
- **Port**: 6379
- **Database**: 2 (as configured in config/local.php)

### Troubleshooting

#### Containers won't start
```bash
# Check Docker logs
docker compose -f docker-compose-local.yml logs
```

#### Port already in use
```bash
# Find process using port
lsof -i :443  # or :80 or :3306

# Kill the process (macOS/Linux)
kill -9 <PID>
```

#### SSL certificate errors in browser

On macOS, trust the self-signed certificate:
```bash
sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain docker/certs/local-www.rogerssportsandmedia.com.crt
```

#### Cannot connect to database

Ensure containers are running:
```bash
docker compose -f docker-compose-local.yml ps
```

If database container is not running, check logs:
```bash
docker compose -f docker-compose-local.yml logs db
```

### Performance Notes

- Redis is configured for caching (database 2)
- PHP memory limit: 256M
- Upload max filesize: 64M
- Static assets (JS, CSS, images) are cached with 1-year expiration

## Compile SASS / JS for RSM Themes

#### You need to Install NPM https://nodejs.org/en/ and Gulp https://gulpjs.com/

```
npm install --global gulp-cli
```

#### Change directory into,

```
webroot/wp-content/themes
```

#### Run the following steps below,

```
npm install
```

#### Run the Gulp Watch to monitor and generate required css files

```
gulp

```

#### Run release task before deploying to staging or production

```
gulp release

```

Integration url: https://int-www.rogerssportsandmedia.com/
