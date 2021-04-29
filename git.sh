#! /bin/bash
@echo off 
clear
git add .
NOW=$(date +"%m-%d-%Y")
git commit -a -m "$NOW"
git push
exit