# Web development

Coursework for the course Web Development

## Overview

Fill the e-mail address and password fields to change the header's color to the user's favourite one. 

## Features

* Simple API with [one endpoint](docs/api/get_favourite_color.md)
* Simple, Bootstrap-based front page, with AJAX calls

## Install steps

1. Clone the repository.
2. Set web root for the public_html folder.
3. Set up a mysql database and fill it with the [database.sql](data/database.sql) file.
4. Create a file named `config.ini` based on the [config-default.ini](config-default.ini) and set the values.
5. Set the following environmental variables (under Windows you can use the [startserver-debug.cmd](startserver-debug.cmd) script, and then skip this one):
    * `WEBFEJLESZTES_BASE` base directory of the project.
    * `WEBFEJLESZTES_CONFIG` the config file's path inside the base directory.
