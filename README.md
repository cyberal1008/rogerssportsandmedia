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

## Local Development with Colima & Docker

### Prerequisites

- Homebrew (macOS package manager)
- **Colima** (Container runtime for macOS/Linux - no Docker Desktop required)
- **Docker CLI** & **Docker Compose**

#### Installing Prerequisites via Homebrew:

```bash
brew install colima docker docker-compose
```

### Quick Start

#### 1. Start Colima runtime

```bash
colima start --cpu 2 --memory 4
```

To verify Colima is running:

```bash
colima status
```

#### 2. Generate SSL Certificates

```bash
chmod +x docker/certs/generate-cert.sh
./docker/certs/generate-cert.sh
```

#### 3. Update your hosts file

Add the following line to your `/etc/hosts` file (on macOS/Linux) or `C:\Windows\System32\drivers\etc\hosts` (on Windows):

```
127.0.0.1  local-www.rogerssportsandmedia.com
```

#### 4. Start Docker containers

```bash
docker compose -f docker-compose-local.yml up -d
```

This will start:
- **PHP 8.5-FPM** container (connects to local MAMP MySQL DB on port 3306)
- **Nginx** web server with HTTPS (port 443)
- **Redis 7** cache server

#### 5. Access the site

Open your browser and navigate to:
```
https://local-www.rogerssportsandmedia.com
```

### Colima Commands

#### Start Colima daemon
```bash
colima start
```

#### Stop Colima daemon
```bash
colima stop
```

#### Check Colima status
```bash
colima status
```

#### Restart Colima
```bash
colima restart
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

#### Run WP-CLI commands
```bash
docker compose -f docker-compose-local.yml exec php wp [command]
# Example: docker compose -f docker-compose-local.yml exec php wp db info
```

### Database (MAMP App Local DB)

- **Host**: `host.docker.internal:3306` (inside containers) or `127.0.0.1:3306` (from host machine)
- **User**: root
- **Password**: root
- **Database**: rogerssportsandmedia
- **Port**: 3306

#### Connect with Sequel Ace (macOS)

1. Open **Sequel Ace** application
2. Click **"+"** button to create a new connection
3. Fill in the connection details:
   - **Host**: `127.0.0.1`
   - **Port**: `3306`
   - **Username**: `root`
   - **Password**: `root`
   - **Database**: `rogerssportsandmedia` (optional, can be left blank)
4. Click **"Test Connection"** to verify
5. Click **"Add Favorite"** to save the connection
6. Click **"Connect"** to access the database

**Note**: Ensure MAMP MySQL server is running on port 3306.

### Import DB Backup

Use the following command to import the provided compressed SQL backup into your local MAMP MySQL database.

#### Import `.sql.gz` backup into local MAMP DB
```bash
gzip -dc /Users/Hardikkumar.Desai/Downloads/rogerssam-2026-06-10_07_05_59.sql.gz | mysql -h 127.0.0.1 -P 3306 -u root -proot rogerssportsandmedia
```

Or using MAMP's bundled MySQL client if needed:
```bash
gzip -dc /Users/Hardikkumar.Desai/Downloads/rogerssam-2026-06-10_07_05_59.sql.gz | /Applications/MAMP/Library/bin/mysql -h 127.0.0.1 -P 3306 -u root -proot rogerssportsandmedia
```

#### Verify import
```bash
mysql -h 127.0.0.1 -P 3306 -u root -proot -e "USE rogerssportsandmedia; SHOW TABLES;"
```

### Redis Cache

- **Host**: redis (inside containers)
- **Port**: 6379
- **Database**: 2 (as configured in config/local.php)

### Troubleshooting

#### Colima service not running or socket issue
```bash
# Check Colima status
colima status

# Start Colima if stopped
colima start

# If docker command cannot connect to daemon, ensure DOCKER_HOST is unset or set to colima socket
export DOCKER_HOST="unix://$HOME/.colima/default/docker.sock"
```

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
