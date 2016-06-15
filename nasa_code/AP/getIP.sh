#!/bin/sh

for i in $(wl -i wl0.1 assoclist | awk '{print $2}')
do 
	cat /proc/net/arp |\
	grep -i $i |\
	awk '{print $1" "$4" "$6}'
done
