
#1301319563
ll
#1301319568
nano www/index.html 
#1301319615
sudo nano www/index.html 
#1301319619
nano www/index.html 
#1301319726
nano www/index.html 
#1301319732
cd www/
#1301319733
ll
#1301319742
touch teste
#1301319744
ll
#1301319747
rm teste 
#1301319749
ll
#1301319757
mv index.html index-bkp.html 
#1301319760
nano index-bkp.html 
#1301319775
ll
#1301319789
cat index-bkp.html > new.html
#1301319793
nano new.html 
#1301319809
mv new.html index.html 
#1301319811
ll


#1310159634
apt-get install wkhtmltopdf
#1310159639
uname -a
#1310159672
sudo su
#1310160561
man haml 
#1310160570
man html2haml 
#1310160734
wget -c http://code.google.com/p/wkhtmltopdf/downloads/detail?name=wkhtmltopdf-0.9.9-static-i386.tar.bz2
#1310160739
ll
#1310160745
ll -h
#1310160749
rm detail\?name\=wkhtmltopdf-0.9.9-static-i386.tar.bz2 
#1310160775
wget -c http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.9.9.tar.bz2
#1310160815
wget -c http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.9.9-static-i386.tar.bz2
#1310160877
wget -c "http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.9.9-static-i386.tar.bz2"
#1310160967
wget -c http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.10.0_rc2-static-i386.tar.bz2
#1310160979
links http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.10.0_rc2-static-i386.tar.bz2
#1310161033
ll
#1310161037
ll -h
#1310161062
tar jxf wkhtmltopdf-0.10.0_rc2-static-i386.tar.bz2 
#1310161065
ll
#1310161080
ll www/
#1310161112
mv wkhtmltopdf-i386 www/wkhtmltopdf
#1310161120
cd www/
#1310161121
ll
#1310161126
./wkhtmltopdf 
#1310161129
ll
#1310161141
./wkhtmltopdf index.html index.pdf
#1310161146
klll
#1310161148
ll
#1310161201
./wkhtmltopdf http://www.racaboxer.com.br rb.pdf
#1310161208
ll
#1310161215
ll -h
#1310161415
ll
#1310161426
mkdir boleto
#1310161432
mv wkhtmltopdf boleto/
#1310161433
ll
#1310161438
rm *pdf
#1310161439
ll
#1310161442
ll boleto/
#1310161604
ll
#1310161611
ll boleto/
#1341230669
ll
#1341230679
cll application/
#1341230681
ll application/
#1341230693
passwd lucianomarinho
#1341230698
passwd
#1341230716
passwd
#1341232527
ll
#1341232540
chmod 777 *
#1341232542
ll
#1409845165
ll
#1409845170
cd www/
#1409845171
ll
#1409845184
cd ..
#1409845185
ll
#1409845201
cd application/views/scripts/index/
#1409845201
ll
#1409845205
nano scripts.phtml 
#1409845346
pwd
#1409845349
cd ..
#1409845349
cd ..
#1409845350
cd ..
#1409845351
ll
#1409845362
nano controllers/IndexController.php 
#1409845410
ll
#1409845414
nano Bootstrap.php 
#1409845427
ll
#1409845431
nano configs/application.ini 
#1409845441
ll
#1409845442
cd ..
#1409845443
ll
#1409845451
grep -r "racaboxer" .
