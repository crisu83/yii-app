#!/bin/bash

$(which git > /dev/null 2>&1)
FOUND_GIT=$?

if [ "${FOUND_GIT}" -ne '0' ]; then
    echo "Installing git-core..."
    sudo apt-get update
    sudo apt-get install -y git-core
fi

$(which gem > /dev/null 2>&1)
FOUND_GEM=$?

if [ "${FOUND_GEM}" -ne '0' ]; then
    echo "Installing rubygems..."
    sudo apt-get install rubygems
fi

$(which librarian-puppet > /dev/null 2>&1)
FOUND_LIB_PUPPET=$?

if [ "${FOUND_LIB_PUPPET}" -ne '0' ]; then
    echo "Installing librarian-puppet..."
    gem install librarian-puppet --no-rdoc --no-ri
fi

echo "Installing puppet modules..."
cd /vagrant/puppet && librarian-puppet install