FROM lahouely/php_apache_pdo:latest
COPY commands_webapp /var/www/html/
RUN mkdir /tmp/sessions
RUN mkdir /tmp/resumes
RUN chown www-data:www-data /tmp/sessions
RUN chown www-data:www-data /var/www/html/cv
RUN printf "session.save_path = \"0;/tmp/sessions\"" > /usr/local/etc/php/conf.d/session.save_path.ini
#Overriding the CMD
CMD ["apache2-foreground"]