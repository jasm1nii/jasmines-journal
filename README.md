# jasmine's journal

[![GitHub commits since latest release (by SemVer including pre-releases)](https://img.shields.io/github/commits-since/jasm1nii/jasmines-journal/latest/main?logo=github&labelColor=rebeccapurple&color=mediumpurple)](https://github.com/jasm1nii/jasmines-journal/commits/main) ![GitHub repo size](https://img.shields.io/github/repo-size/jasm1nii/jasmines-journal?logo=git&labelColor=rebeccapurple&color=mediumpurple)
 [![StackShare](http://img.shields.io/badge/tech-stack-0690fa.svg?style=flat&labelColor=rebeccapurple&color=mediumpurple&logo=stackshare)](https://stackshare.io/jasm1nii/jasmines-journal)
 
[![Website](https://img.shields.io/website?up_color=seagreen&down_color=palevioletred&url=https://jasm1nii.xyz/&labelColor=rebeccapurple)](https://jasm1nii.xyz/) [![Chromium HSTS preload](https://img.shields.io/hsts/preload/jasm1nii.xyz?logo=googlechrome&labelColor=rebeccapurple&color=seagreen)](https://hstspreload.org/?domain=jasm1nii.xyz) [![Mozilla HTTP Observatory Grade](https://img.shields.io/mozilla-observatory/grade-score/jasm1nii.xyz?logo=mozilla&labelColor=rebeccapurple&color=seagreen)](https://observatory.mozilla.org/analyze/jasm1nii.xyz)

welcome to my hand-crafted personal website and coding sandbox 🛠

![Screenshot 2023-11-18 at 10-11-30 jasmine's journal](https://github.com/jasm1nii/jasmines-journal/assets/67263692/f8b1c36a-b865-43de-b3d2-6eac233c9f89)

## local deployment guide

### base requirements

- [**PHP 8**](https://www.php.net/) or newer.

- [**composer**](https://getcomposer.org/) for updating PHP dependencies.
    
    if you'd prefer not to install composer globally, the executable `composer.phar` file (located in the `/bin` directory) can be used instead - more on that in the instructions.

- **MariaDB** or **MySQL** for the database.

### general instructions

1. **clone this repository** to your machine:

    1.  via `composer` (global installation) - this will automatically  install the required dependencies:

        - latest:

            ```bash
            composer create-project jasm1nii/jasmines-journal:dev-main
            ```

        - stable:

            ```bash
            composer create-project jasm1nii/jasmines-journal
            ```

    2. via `git` CLI:

        - latest:

            ```bash
            git clone https://github.com/jasm1nii/jasmines-journal
            ```

        - stable:

            ```bash
            git clone https://github.com/jasm1nii/jasmines-journal --branch (version tag)
            ```

    3. via direct download as a `.zip` archive:
    
        - [latest](https://github.com/jasm1nii/jasmines-journal/archive/refs/heads/main.zip)

        - [stable](https://github.com/jasm1nii/jasmines-journal/releases)


2. if you haven't already, **install the required dependencies**:

    1. via `composer` (global installation):

        ```bash
        composer install
        ```

    2. via `composer.phar`:

        ```bash
        php bin/composer.phar install
        ```


3. **configure your web server** to use `/public_html` as the document root, as well as to redirect requests for nonexistent files to `/public_html/index.php`.

    - **for apache**, an `.htaccess` file is already included to handle the latter, but ensure to set the former in your `httpd.conf` file.


4. **that's it!** you can now view this site at whatever localhost address you've set 👾

### additional configuration

per version 2.3, a `guestbook_sample.sql` file is provided in the `/resources/databases` directory. to use it, you'll need to import the file manually to your server database. after that, tweak any parameters as needed in `/config/env_sample.ini` and `/config/src_paths.php`.