#!/bin/bash

set -eax

docker run --rm -v $(pwd):/var/www -w /var/www  composer install --ignore-platform-reqs
