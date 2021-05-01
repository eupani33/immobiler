#! /bin/bash
@echo off 
clear
git add .
NOW=$(date +"%d-%m-%Y")
git commit -a -m "$NOW"
git push
exit