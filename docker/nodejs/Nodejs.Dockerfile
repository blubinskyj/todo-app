FROM node:lts-alpine

RUN apk --update --no-cache add tzdata

WORKDIR /var/www

CMD npm install \
&& npm run watch