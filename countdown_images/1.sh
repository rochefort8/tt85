#/bin/sh

count=102

while [ 1 ];
do
    curl "http://placehold.jp/480x320.jpg?text=$count" > $count.jpg
    if [ $count -gt 120 ]; then
	break;
    fi
    let count=$count+1

done


