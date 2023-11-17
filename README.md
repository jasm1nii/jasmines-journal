# jasmine's journal

[![GitHub commits since latest release (by SemVer including pre-releases)](https://img.shields.io/github/commits-since/jasm1nii/jasmines-journal/latest/main)](https://github.com/jasm1nii/jasmines-journal/commits/main) ![GitHub repo size](https://img.shields.io/github/repo-size/jasm1nii/jasmines-journal)
 [![StackShare](http://img.shields.io/badge/tech-stack-0690fa.svg?style=flat)](https://stackshare.io/jasm1nii/jasmines-journal)
 
 [![Chromium HSTS preload](https://img.shields.io/hsts/preload/jasm1nii.xyz)](https://hstspreload.org/?domain=jasm1nii.xyz) [![Mozilla HTTP Observatory Grade](https://img.shields.io/mozilla-observatory/grade-score/jasm1nii.xyz)](https://observatory.mozilla.org/analyze/jasm1nii.xyz)


welcome to my hand-crafted personal website and coding sandbox 🛠

## local deployment guide

### important note

as of now, graceful error handling does not exist for missing database credentials. if this repository is deployed as is, PHP will throw a fatal error when viewing certain pages that require them (namely the homepage and the guestbook).

### base requirements

- [**PHP 8**](https://www.php.net/) or newer.

- [**composer**](https://getcomposer.org/) for installing PHP dependencies.
    
    if you'd prefer not to install composer globally, the executable `composer.phar` file (located in the `bin` directory) can be used instead - more on that in the instructions.

- **MariaDB** or **MySQL** for the database.

### general instructions

1. **clone this repository** to your file system - [compressed archives](https://github.com/jasm1nii/jasmines-journal/releases) are also available to download and extract.

2. in this project's root directory, **install the required libraries** via command line:

    - via composer:

        ```bash
        composer install
        ```

    - via `composer.phar`:

        ```bash
        php bin/composer.phar install
        ```

3. **configure your web server** to use `public_html` as the document root, as well as to redirect requests for nonexistent files to `index.php`.

    - **for apache**, an `.htaccess` file is already included to handle the latter, but ensure to set the former in your `httpd.conf` file.


4. **that's it!** you can now view this site at whatever localhost address you've set 👾