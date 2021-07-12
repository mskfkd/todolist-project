FROM ubuntu:latest
RUN touch test
RUN echo 'hello world' > test


FROM mysql:5.7

# MySQLの設定
COPY ~/dev/docker-dev/db/my.cnf /etc/mysql/conf.d/my.cnf
# 初期投入データ
COPY ~/dev/docker-dev/db/mysql_init/schema.sql /docker-entrypoint-initdb.d

