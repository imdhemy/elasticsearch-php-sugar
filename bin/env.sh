#!/usr/bin/env sh

# Copies the .env.example file to .env if it doesn't exist
if [ ! -f .env ]; then
  cp .env.example .env
  echo "Copied .env.example to .env"
else
  echo ".env file already exists"
fi
