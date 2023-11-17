# jasmine's journal

[![StackShare](http://img.shields.io/badge/tech-stack-0690fa.svg?style=flat)](https://stackshare.io/jasm1nii/jasmines-journal)

welcome to my hand-crafted personal website and coding sandbox 🛠

## deploying locally

### important note

as of now, graceful error handling does not exist for missing database credentials. if this repository is deployed as is, PHP will throw a fatal error when viewing certain pages that require them (namely the homepage and the guestbook).

### base requirements

- [**PHP 8**](https://www.php.net/) or newer.

- [**composer**](https://getcomposer.org/) for installing this project's dependencies.
    
    if you'd prefer not to install composer globally, the executable `composer.phar` file (located in the `bin` directory) can be used instead - more on that in the instructions.

- **MariaDB** or **MySQL** for the database.

### general instructions

- in this project's root directory, **install the required libraries** via command line:

    - via composer:

    ```bash
    composer install
    ```

    - via `composer.phar`:

    ```bash
    php bin/composer.phar install
    ```

- **configure your web server** to use `public_html` as the document root, as well as to redirect requests for nonexistent files to `index.php`.

    - **for apache**, an `.htaccess` file is already included to handle the latter, but ensure to set the former in your `httpd.conf` file.


- that's it! you can now view this site at whatever localhost address you've set 👾