#!/bin/bash
if [ $1 = "wp" ]; then
	cp -a ./wp_base/. .
fi
if [ $1 = "pw" ]; then
	cp -a ./pw_base/. .
fi