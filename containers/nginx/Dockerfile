FROM nginx:1.13-alpine

MAINTAINER "NPO ICT" <hosting@npo.nl>


LABEL   io.k8s.description="NGINX 1.13 Proxy instance" \
	io.k8s.display-name="nginx 1.13" \
	io.openshift.expose-services="8080:http" \
	io.openshift.tags="builder,nginx,webserver,proxy" \
	io.openshift.s2i.scripts-url="image:///usr/libexec/s2i"

ARG FPM=php-fpm
ENV FPM ${FPM}

COPY ./s2i/bin/ /usr/libexec/s2i

COPY config/nginx.conf /etc/nginx/

RUN mkdir -p /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs && \
	chown -R 1001:0 /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs && \
	chmod ug+rwx /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs && \
	chmod ug+rw /etc/nginx/nginx.conf && \
	chown -R 1001:0 /etc/nginx

COPY ./uid_entrypoint /bin/uid_entrypoint

RUN chmod g=u /etc/passwd
ENTRYPOINT [ "uid_entrypoint" ]
USER 1001

EXPOSE 8080

CMD ["/usr/libexec/s2i/usage"]
