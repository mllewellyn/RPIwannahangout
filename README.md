RPIwannahangout
===============

Awesome app for RPI students to find people to hangout with

===============

How to set up propel and RPIWannaHangOut databases:

Set up RPIWannaHangOut database and database user
	Run this command “mysql --user=root --password=pass < setup_db_and_user.sql”
		the --user and --pass flags are only if your default user doesn’t have
		access privileges
	OR in phpmyadmin click on the SQL tab, copy and paste the code in
	setup_db_and_user.sql, click go in the bottom right
Set up database tables
	Run this command from the root directory of the project
	“./vendor/propel/propel/bin/propel sql:insert”
	OR Run this command “mysql RPIWannaHangOut --user=root --password=pass <
	generated-sql/RPIWannaHangOut.sql”
		as above the --user and --pass flags are only if your default user
		doesn’t have access privileges
	OR in phpmyadmin click on RPIWannaHangOut database on the left then click
	on the SQL tab, copy and paste the code in generated-sql/RPIWannaHangOut.sql,
	click go in the bottom right

================


Max database schema notes:
*means foreign key stuff going on
Database tables:
	Events
		start + end time
		*creator
		where
		title
		description
		need car
	Users
		first + last name
		email
		user group
		has car? (# seats?)
	Users interested in event
		event id
		*user id
		user bringing car (# seats?)
	Comments
		*event_id
		*author_id
		creation_date
		edit_date ??
		comment text