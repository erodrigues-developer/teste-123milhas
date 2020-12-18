#!/bin/bash
php ../vendor/bin/openapi --bootstrap ./swagger-constants.php --output ../public/openapi.json ./swagger-v1.php ../app/Http/Controllers