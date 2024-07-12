#!/bin/bash
printf "Running tests..."

php tests/test1.php
php tests/test2.php
php tests/test3.php

printf "OK"