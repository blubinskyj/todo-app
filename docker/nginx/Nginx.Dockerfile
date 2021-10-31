FROM nginx:alpine

RUN apk --update --no-cache add certbot tzdata openrc py3-pip

RUN cp /usr/share/zoneinfo/Europe/Kiev /etc/localtime \
&& echo "Europe/Kiev" > /etc/timezone

RUN pip3 install certbot-dns-cloudflare

WORKDIR /var/www

CMD ["nginx"]

EXPOSE 80 443
