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
gulp watch

```

Integration url: https://int-www.rogerssportsandmedia.com/
