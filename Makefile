
DATE=`date +%F`

clean:
	find . -name "*~" -exec rm {} \; -print

tar-ball-release:
	make clean
	cd ..; tar --exclude=.svn -czvf /tmp/release-$(DATE).tar.gz HCDXOnlineLog
	scp /tmp/release-$(DATE).tar.gz root@tx.kotalampi.com:/home/www/docs/hard-core-dx/online-log-latest.tar.gz

get-new-init-db:
	ssh root@tx.kotalampi.com "mysqldump -d HCDX  -p" > init_db.sql
	ssh root@tx.kotalampi.com "mysqldump HCDX texts ITU Bands Categories languages  -p" >> init_db.sql


