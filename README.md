dudi
====

Distributed Useraccount Disable

I started this project a while back. We had a plan for being able to quickly disable user accounts across
hundreds of servers. This could have been accomplished easily enough with a shell script looping through a list
of servers, but the project was ultimately going to be handled by HR/front-office people. So the system had
to be both very easy to use, and to track its usage.<br>

There are a few requirements that must be met for this project to work for you:<br>
<ul>
<li> You will need SSH-key trusts setup from the server that hosts this project, to ALL servers it will disable user accounts on.</li>
<li> Apache, and PHP ust be installed on the host server.</li>
<li> The project can attempt to email a person, or list when a user account is disabled, outbound SMTP is needed for this.</li>
</ul>

Nuts and Bolts
==============
The underlying process is very simple, I'll list the operational steps below:<br>
<br>
1) You are given the task of disabling the 'jdoe' user acount.<br>
2) Youpoint your web browser to the URL of the host machine and enter your username/password.<br>
3) After authenticating, you enter 'jdoe' in the form, and press submit.<br>
4) The system checks against a list of usernames that should NEVER be disabled.<br>
5) If the username passes that check, it's passed to a data file.<br>
6) At a pre-defined schedule, cron runs a job that looks for that data file, and if it exists, reads the contents.<br>
7) The cron job now has a user to disable, it reads a list of servers, connects to each sequentially, disables the account.<br>
8) Any errors are logged.<br>
9) An email is then crafted which gives details on each operation, and any errors. The mail is sent to a list, or user.<br>
10) The data file with the 'jdoe' user account is deleted.<br>
