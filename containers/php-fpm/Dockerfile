FROM php:7.1-fpm-alpine

MAINTAINER "NPO ICT" <hosting@npo.nl>


LABEL   io.k8s.description="PHP-FPM 7.1 instance" \
	io.k8s.display-name="php-fpm 7.1" \
	io.openshift.expose-services="9000:9000" \
	io.openshift.tags="builder,php-fpm,webserver,php" \
	io.openshift.s2i.scripts-url="image:///usr/libexec/s2i"

# docker-entrypoint.sh dependencies
RUN apk add --no-cache \
# in theory, docker-entrypoint.sh is POSIX-compliant, but priority is a working, consistent image
		bash \
# BusyBox sed is not sufficient for some of our sed expressions
		sed \
# If you want to dump mysql databases
		mysql-client

# install the PHP extensions we need
RUN set -ex; \
	\
	apk add --no-cache --virtual .build-deps \
		libjpeg-turbo-dev \
		libpng-dev \
	; \
	\
	docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
	docker-php-ext-install gd mysqli opcache; \
	\
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --virtual .wordpress-phpexts-rundeps $runDeps; \
	apk del .build-deps

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini



COPY ./s2i/bin/ /usr/libexec/s2i


RUN mkdir -pv /e/ap/site/tmp/sessions /e/ap/site/pages /e/ap/site/logs /e/ap/site/tmp/php-fpm && \
	chown -R 1001:0 /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs &&\
	chmod -R ug+rwx /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs

COPY ./uid_entrypoint /bin/uid_entrypoint

RUN chmod a+x /usr/libexec/s2i/* /bin/uid_entrypoint

RUN chmod g=u /etc/passwd
ENTRYPOINT [ "uid_entrypoint" ]
USER 1001

EXPOSE 9000

CMD ["/usr/libexec/s2i/usage"]
