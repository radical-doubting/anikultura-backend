#!/bin/sh

AGENT_BINARY=agent-linux-amd64
VERSION=0.27.0

if test -f "$AGENT_BINARY"; then
    echo "$AGENT_BINARY already exists."
    exit 1;
fi

curl -O -L https://github.com/grafana/agent/releases/download/v$VERSION/$AGENT_BINARY.zip
unzip $AGENT_BINARY.zip
rm $AGENT_BINARY.zip
chmod a+x $AGENT_BINARY
