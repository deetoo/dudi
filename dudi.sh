#!/bin/sh

USERFILE="/home/www-data//user.dat"
SERVERSFILE="/home/www-data/servers.dat"
RUNLOG="/home/www-data/log"
ERRLOG="/home/www-data/errors"
ALERTEMAIL="CHANGE@EMAIL.ADRESS"


if [ -f $USERFILE ]
	then
DelUser=`cat $USERFILE`

if [ $DelUser = "root" ]
	then
		echo "Admin user may not be disabled." >$RUNLOG
		exit
	fi

while read server
	do
         echo "Account: $DelUser disabled at: `date`" >$RUNLOG
		 ssh root@$server "usermod -L -e 1 $DelUser" >$ERRLOG 
         mail -s "DUDI Alert" $ALERTEMAIL < $RUNLOG
	done < $SERVERSFILE
rm $USERFILE

else
	echo "No user.dat exists, exiting."
	exit
fi

