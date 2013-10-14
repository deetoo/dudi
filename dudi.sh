#!/bin/sh

USERFILE="/tmp/user.dat"
SERVERSFILE="/tmp/servers.dat"

if [ -f $USERFILE ]
	then
DelUser=`cat $USERFILE`

if [ $DelUser = "root" ]
	then
		echo "Admin user may not be disabled."
		exit
	fi

while read server
	do
		ssh root@$server 'usermod -L -e 1 $DelUser'
	done < $SERVERSFILE

else
	echo "No user.dat exists, exiting."
	exit
fi

