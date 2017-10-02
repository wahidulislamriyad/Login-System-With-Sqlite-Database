PHP Login System
	With SQLite Database
	Including User Picture Upload Feature
	Stylish, Secure & Easy
	Developed by Wahidul Islam Riyad
	Web: https://r-server.000webhostapp.com/login-sqlite
	Download: https://r-server.000webhostapp.com/php-login-sqlite.zip
	https://www.facebook.com/wahidulislamriyad
	Google Mail (Gmail): wahidulislamriyad@gmail.com
	

	Copyright (C) 2017 Wahidul Islam Riyad


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Build: 2017090001

The enclosed code is a PHP class I came up with to enable secure logins on any site it's dropped into. Some configuration is required, but as you will see, it's fast, secure, easy to set up, and most of all gets the job done.

This version uses PDO and SQLite3 to quickly read and write user information to an SQLite database, rather than requiring MySQL to be installed and setup.

Here is what you need to get started using the script:

Requirements
- PHP5+
	- PDO & PDO-SQLite enabled
- Apache
	- mod_rewrite enabled

Installation

A) Configuration
    1) config.php
        You will need to do some configurations inside config.php to /databases folder
        Edit or change these configs there
    
    2) .htaccess
        For some security purpose edit or change configs inside .htaccess file in root folder of this system
        As Required:

        /------------------------------------------------------
        Options -Multiviews

        RewriteEngine On
        RewriteBase /

        RewriteRule ^index$ /projects/login/index.php [L]
        RewriteRule ^login?$ /projects/login/login.php [L]
        RewriteRule ^signup$ /projects/login/sign-up.php [L]
        RewriteRule ^forgot$ /projects/login/forgot.php [L]
        RewriteRule ^forgot-pass$ /projects/login/forgot-page.php [L]
        RewriteRule ^change$ /projects/login/change.php [L]
        RewriteRule ^profile$ /projects/login/profile.php [L]
        RewriteRule ^logout$ /projects/login/logout.php [L]
        ------------------------------------------------------/

        Change the filenames (on the right side of the RewriteRule) if you used your own pages or renamed any of the files above.

B) Database creation
    You don't need to create a new one. A bulit .db file is included inside /databases folder
    But if you want to use your own database then try these lines to create tables and column in your .db file

    Table creation query for this login system:

    CREATE TABLE users (id INT PRIMARY KEY NOT NULL, username TEXT NOT NULL, password TEXT NOT NULL, name TEXT NOT NULL, email TEXT NOT NULL, phone TEXT NOT NULL, role TEXT NOT NULL, active TEXT NOT NULL, last TEXT NOT NULL);

    Database Insertion for this login system:

    INSERT INTO users (id,username,password, name,email,phone,role,active,last)
    VALUES (1, 'username', 'password', 'name',  'email', 'phone', 'role', 'active', 'last activity' );

    Edit these lines as you needs

C) Basic Usage

    Simply add <?php require_once('_login.php'); ?> to the top of any page where you want to use the script.

And that's all!


Features

- Authentication using PHP and SQLite
- Session & Cookie is used to login users
- Remember me option on Log In
- Salted passwords
- Secured against SQL Injection
- Built in change password, phone, name, & password recovery
- Profile Picture Uploading
- Stylish Login page & Profile page
- User registration notification

Summary

I chose to write my own class rather than using a pre-made one so I could fix all the bugs and security flaws of the scripts that already exist, and so there would be something that works with SQLite.

Let me know if you come up with any bugs or questions.  Things are in the works to make the script extendable (with plugins and such) to add features such as user tracking and profiles.  The script as is provides a secure system of login, registration, and account management.  When finished, I plan to make an OpenID and MySQL version as well.


-------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------
Contents
    
    css
        Includes all of stylesheets thats are required to stylize pages of this system

        btn-classes.css
        style.css
        styleinput.css
        stylepp.css
        sweetalert.css
    
    js
        Includes all of scripts thats are required to process pages of this system

        jquery.form.min.js
        jquery-2.0.3.min.js
        moment-2.2.1.js
        sweetalert.js
        sweetalert.min.js

    images
        Includes all imaginary files that are used to stylize profile page

        bg.png
        clip.png
        edit.png
        mail.png
        menu.png
        msg.png
        pencil.png
        ph.png
        pw.png
        star.png

    Originals
        Includes default config.php, built-in .db & .htaccess to protect /databases folder

        config.php
        UserData.db
        .htaccess

    sqlite_crud
        Managing system of UserData.db that are built-in with this login system
        (This system is protected with Basic Authentication. Check .htpasswd for username and password)

        .htaccess
        .htpasswd
        db_connect.php
        delete.php
        index.php
        update.php
    
    Readme
        Includes readme files in varius types of files

    databases
        .htaccess
            It's protects the folder from unauthorized access and unauthorized downloading
            (This .htaccess doesn't contains login method for this page. If you want then create it yourself)
        UserData.db
            Database file for this login system
        config.php
            It contains all configuration thats are required to this login system
        pictures
            Container for user pictures thats are going to use in profile page and others

    Thats all files are included with this project
