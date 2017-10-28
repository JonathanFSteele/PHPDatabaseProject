##Apache / PHP on Mac OS:

https://coolestguidesontheplanet.com/get-apache-mysql-php-and-phpmyadmin-working-on-macos-sierra/
sudo apachectl start
sudo apachectl stop
sudo apachectl restart
httpd -v
http://localhost after starting.

##To troubleshoot:
apachectl configtest
NOTE: Apache / PHP instructions from the page above. I DID set up the Sites directory because I had permission problems trying to use the webserver directory.


##ATOM setup of php autocomplete package:
For atom php auto-complete to work, follow the download/install instructions here:
https://getcomposer.org/download/

(Start in this directory and run the install script (4 lines - paste in at once. At cmd line.)

I put it in my /Users/greggorysteele/Documents/php_composer folder, then moved it with these commands:
sudo chmod a+x composer.phar
sudo mv composer.phar /usr/local/bin/composer.phar

Then in atom, set the directory to composer and it should stop complaining about the php autocomplete.

##To make beautify work, you need the php-cs-fixer:
I got it with this:

$ curl -L http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -o php-cs-fixer
then:

$ sudo chmod a+x php-cs-fixer
$ sudo mv php-cs-fixer /usr/local/bin/php-cs-fixer
Then, just run php-cs-fixer.



##PHP Tutorials:
https://www.w3schools.com/php/default.asp

##PHP MySQL Examples:
https://www.w3schools.com/php/php_mysql_connect.asp
https://www.w3schools.com/php/php_mysql_select.asp

mySQL libraries come with PHP. No extra installs needed.

Dev
ec.steeleconsult.com / 54.186.5.231 - web box
54.186.5.231 - database
un/pw - gsteele / [hard]

/users/greggorysteele/Sites



Delete History:
https://stackoverflow.com/questions/41953300/how-to-delete-the-old-git-history
