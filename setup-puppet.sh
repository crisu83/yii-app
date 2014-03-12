#!/bin/bash

$(which git > /dev/null 2>&1)
FOUND_GIT=$?

if [ "${FOUND_GIT}" -ne '0' ]; then
    echo "Installing git-core..."
    sudo apt-get update
    sudo apt-get install -y git-core
fi

$(which librarian-puppet > /dev/null 2>&1)
FOUND_LIB_PUPPET=$?

if [ "${FOUND_LIB_PUPPET}" -ne '0' ]; then
    echo "Installing librarian-puppet..."
    gem install librarian-puppet --no-rdoc --no-ri
fi

echo "Running librarian-puppet install..."
cd /vagrant && librarian-puppet install