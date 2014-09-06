#!/usr/bin/env bash


CWD=`pwd`
for file in `ls *mp4` 
do	
	# 格式转换
	name=${file%.*}
	#ffmpeg -i $file -acodec libvorbis -aq 5 -ac 2 -qmax 25 -threads 2 $name.webm
	ffmpeg -i $file -r 1 -f image2 $name.png
done
