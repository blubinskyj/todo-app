FROM node:lts-alpine

RUN apk --update --no-cache add tzdata

USER node

WORKDIR /var/www

CMD npm install \
&& npm run watch

