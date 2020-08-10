FROM nginx
RUN echo "Hello World!!"
RUN apt update -yqq \
    && apt full-upgrade -y \
    && apt install nano
# Define mountable directories.
VOLUME ["/etc/nginx/sites-enabled", "/etc/nginx/certs", "/etc/nginx/conf.d", "/var/log/nginx", "/var/www/wgtcrm"]
# Define working directory.
COPY ./docker/nginx/conf.d/wgtcrm.conf  /etc/nginx/conf.d/wgtcrm.conf
WORKDIR /etc/nginx

# Expose ports.

EXPOSE 80
EXPOSE 443

#COPY ./docker/nginx/certificate.crt /etc/nginx/certs/certificate.crt
#COPY ./docker/nginx/private.key /etc/nginx/certs/private.key
#RUN chown -R root:root /etc/nginx/certs
#RUN chmod -R 600 /etc/nginx/certs
#EXPOSE 3030
#EXPOSE 5555



# Define default command.
CMD ["nginx", "-g", "daemon off;"]
