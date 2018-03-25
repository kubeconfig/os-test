FROM php:7.1-fpm-alpine

MAINTAINER "NPO ICT" <hosting@npo.nl>


LABEL   io.k8s.description="PHP-FPM 7.1 instance" \
	io.k8s.display-name="php-fpm 7.1" \
	io.openshift.expose-services="9000:9000" \
	io.openshift.tags="builder,php-fpm,webserver,php" \
	io.openshift.s2i.scripts-url="image:///usr/libexec/s2i"

RUN apk add --no-cache mysql-client

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
