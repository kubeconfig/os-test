FROM nginx:mainline-alpine

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

# Appcluster paden aanmaken
# Permissies _bijna_ goed zetten, notice de ug+rw op site/tmp, 
# helaas werkt het nog niet beter (minder rechten)	
RUN mkdir -p /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs /e/wb/ostest1/conf/vhosts && \
	chown -R 1001:0 /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs /etc/nginx /e/wb/ostest1/conf && \
	chmod ug+rwx /e/ap/site/tmp /e/ap/site/pages /e/ap/site/logs && \
	chmod ug+rw /etc/nginx/nginx.conf  

COPY ./uid_entrypoint /bin/uid_entrypoint

COPY config/wordpress.vhost /e/wb/ostest1/conf/vhosts/

RUN chmod a+x /usr/libexec/s2i/* /bin/uid_entrypoint

RUN chmod g=u /etc/passwd
ENTRYPOINT [ "uid_entrypoint" ]
USER 1001

EXPOSE 8080

CMD ["/usr/libexec/s2i/usage"]