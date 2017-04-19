#!/usr/bin/env bash

for b in alice-fixtures doctrine-migrations easy-admin sonata-admin uploader
do
    git checkout $b
    git rebase master
done
