#!/bin/bash
printf "Running tests..."

php tests/test1.php
RESULT1=$?
php tests/test2.php
RESULT2=$?
php tests/test3.php
RESULT3=$?

if [ "$RESULT1" != "0" ]; then
    echo -e "Test 1 failed"
    exit 1
fi
if [ "$RESULT2" != "0" ]; then
    echo -e "Test 2 failed"
    exit 1
fi
if [ "$RESULT3" != "0" ]; then
    echo -e "Test 3 failed"
    exit 1
fi

echo "OK"
exit 0