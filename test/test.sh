#!/bin/bash

curl -L $1/login.php | grep "新漢"
echo "Test Done"
