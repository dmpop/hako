#!/usr/bin/env bash

container=$(buildah from alpine:latest)
buildah run $container apk update
buildah run $container apk add php-cli php-xml php-mbstring
buildah copy $container . /usr/src/hako/
buildah config --workingdir /usr/src/hako $container
buildah config --port 3000 $container
buildah config --cmd "php -S 0.0.0.0:3000" $container
buildah config --label description="Hako container image" $container
buildah config --label maintainer="dmpop@cameracode.coffee" $container
buildah config --label version="0.1" $container
buildah commit --squash $container hako
buildah rm $container
