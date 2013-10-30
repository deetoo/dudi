dudi
====

Distributed Useraccount Disabler

I started this project a while back. We had a plan for being able to quickly disable user accounts across
hundreds of servers. This could have been accomplished easily enough with a shell script looping through a list
of servers, but the project was ultimately going to be handled by HR/front-office people. So the system had
to be both very easy to use, and to track its usage.<br>

Concept
=======
First thing, this project is intended to exist within a protected environment, this is NOT a secure solution, it's not 
designed with an emphasis on security, just practicality. 

Assumptions
===========
It's assumed you know how to create, and configure a trusted SSH key relationship between servers. The way I employed
this script was to have a normal user account (ex: dudi), create an SSH key, and copy it to the root account on ALL of the
servers this script would function on (not secure, I *know*). The normal user account that will be executing this script
also needs to be joined to whatever group your web-server account uses (on Debian, it's www-data). The reason for
this, is because that account must be able to read, and then DELETE the temporary user.dat file which contains the
user account which will be disabled. In my deployment, I simply created a /home/www-data directory to store many
of the files, and then I made sure my 'dudi' user was joined to the www-data group, and could both read, and delete
files within /home/www-data
That should make sense, I hope :)


There are a few requirements that must be met for this project to work for you:<br>
<ul>
<li> You will need SSH-key trusts setup from the server that hosts this project, to ALL servers it will disable user accounts on.</li>
<li> Apache, and PHP ust be installed on the host server.</li>
<li> The project can attempt to email a person, or list when a user account is disabled, outbound SMTP is needed for this.</li>
</ul>

Nuts and Bolts
==============
The underlying process is very simple, I'll list the operational steps below:<br>
<ol>
<li> You are given the task of disabling the 'jdoe' user acount.</li>
<li> You point your web browser to the URL of the host machine and enter your username/password.</li>
<li> After authenticating, you enter 'jdoe' in the form, and press submit.</li>
<li> The system checks against a list of usernames that should NEVER be disabled.</li>
<li> If the username passes that check, it's passed to a data file.</li>
<li> At a pre-defined schedule, cron runs a job that looks for that data file, and if it exists, reads the contents.</li>
<li> The cron job now has a user to disable, it reads a list of servers, connects to each sequentially, disables the account.</li>
<li> Any errors are logged.</li>
<li> An email is then crafted which gives details on each operation, and any errors. The mail is sent to a list, or user.</li>
<li> The data file with the 'jdoe' user account is deleted.</li>
