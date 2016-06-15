#!/bin/bash
host="localhost"
user="iot"
pass="testing123"
dbname="iot"
tablename="online"

while [ 1 ]
do
{
sleep 1
echo root
sleep 1
echo nasa2016
sleep 1
echo ./getIP.sh
sleep 1
echo exit
} | telnet 192.168.1.1 > tmp 2>&1

sql_delete="DELETE FROM online"
echo "$sql_delete" | mysql -h $host -u "$user" -p"$pass" "$dbname"

grep "br1" tmp | while read ip mac br1; do

sql="INSERT INTO \`online\`(\`mac\`, \`ip\`) VALUES ('"$mac"','"$ip"')"
echo $sql

echo "$sql" | mysql -h $host -u "$user" -p"$pass" "$dbname"
done
sql_2="SELECT * FROM online"
echo "$sql_2" | mysql -h $host -u "$user" -p"$pass" "$dbname"
sleep 5
done
