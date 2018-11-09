# Museum of Jewish Heritage Website

Base repo to support the Museum of Jewish Heritage (MJH) website, built in WordPress.

The following notes are more guidelines than enforced policies. Please reach out to the MJH team for any problems, issues, suggestions.

## Repo Notes

- WordPress managed by Bedrock 
- Noticably absent from this repo:
	- WordPress Core: this is by design, no need to replicate, please do not commit. Lastest WordPress will be installed on servers as part of deployment. Each dev is responsible for setting up their own local dev environment via composer.
	- `web/app/uploads/`: also by design, please do not commit
- `.gitignore` has been setup to help enforce these concepts, please update as needed or reasonable if it is causing problems.

## Environment setup

Environment is being managed via [Bedrock](https://roots.io/bedrock/),  a modern WordPress stack that helps you get started with the best development tools and project structure.

### Requirements
* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 5.6.4
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

### Installation

1. Pull in git project repository:
	`git pull origin master`

2. MJH team can provide `.env` file and you can customize environment variables in `.env`  file
* `DB_NAME` - Database name
* `DB_USER` - Database user
* `DB_PASSWORD` - Database password
* `DB_HOST` - Database host
* `WP_ENV` - Set to environment (`development`, `staging`, `production`)
* `WP_HOME` - Full URL to WordPress home (http://example.com)
* `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
* `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`
* `ACF_PRO_KEY` - If using acf pro, provide key with this configuration

If you want to automatically generate the security keys (assuming you have wp-cli installed locally) you can use the very handy [wp-cli-dotenv-command][wp-cli-dotenv] or, you can cut and paste from the [Roots WordPress Salt Generator][roots-wp-salt].

3. Theme is brought down via git repository in `web/app/themes`

4. We are using `http://mjh.local` as our local development url

5. Set your site vhost document root to `/path/to/site/web/` (`/path/to/site/current/web/` if using deploys)

6. In project root, run `composer install` to bring down wordpress core, dependencies and contributed plugins

7. Import your database provided by MJH team or it will ask to install barebones copy

8. Access WP admin at `http://mjh.local/wp/wp-admin`


## Development / Deployment Workflow

* Deployments to staging and production will be triggered manually by the MJH team

#### Branch Descriptions
* `/master`
* core base code used to merge dev code and keep clean
* `/dev`
* use the dev branch for local development, commit work frequently
* `/staging` 
* changes commited to staging will be deployed to staging environment
* `/production` 
* contains only production ready code

### Theme Management

* To get the initial theme build, navigate to the theme dir `cd web/app/themes/mjh/`
* Run `yarn` to update dependencies
* Run `yarn build` to compile the build, a `dist` dir will be created, do not commit it, prod and staging branches will be compiled for production by the MJH team

Please review documention in theme directory for further notes. Files can be comitted directly to the root of this git project repository https://github.com/mjh-nyc/mjh-superproject/tree/master/web/app/themes/mjh

### Plugin Management

**  Contrib Plugins**

- Contrib plugins can be brought in via composer to `/web/app/plugins/yourpluginname` using `composer require <package_name>:<version`> 
- Source for wordpress composer packages  `https://wpackagist.org`

**Custom Plugins**

- Custom plugins should be set up so that they can be brought in via composer to `/web/app/plugins/yourpluginname`
