FROM alpine:latest
LABEL maintainer="dmpop@cameracode.coffee"
LABEL version="0.1"
LABEL description="Hako container image"
RUN apk update
RUN apk add php-cli php-xml php-mbstring
COPY . /usr/src/hako
WORKDIR /usr/src/hako
EXPOSE 8000
CMD [ "php", "-S", "0.0.0.0:8000" ]
