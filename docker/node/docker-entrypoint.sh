#!/usr/bin/env sh
set -eo pipefail

uid=$(stat -c %u /srv/app)
gid=$(stat -c %g /srv/app)

sed -ie "s/$(id -u node):$(id -g node)/$uid:$gid/g" /etc/passwd

chown -R node:node /home/node

if [ $# -eq 0 ]; then
    sleep 9999d
else
    su node -s /bin/sh -c "$*"
fi
