FROM php:8.3.0alpha1-cli-alpine3.18

LABEL maintainer="ahkui <ahkui@outlook.com>"

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN apk add --no-cache git

RUN addgroup -g $PGID -S laradock && \
    adduser -u $PUID -S laradock -G laradock

USER laradock

RUN cd /home/laradock && git clone https://github.com/mattpass/ICEcoder.git

WORKDIR /home/laradock/ICEcoder

CMD ["php","-S","0.0.0.0:8080"]
