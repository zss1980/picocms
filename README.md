# picocms
just another a very small cms
using Laravel 5, MySQL, model Page that should have a table:
pages

id (Primary)	int(11)		 	 	 
title	varchar(255)		 	 	 
issection	tinyint(1)	 	 	 	 
ischild	tinyint(1)	 	 	 	 
parent_id	int(11)	 	 	 	 
route_name	varchar(255)	 	 	 	 
published	tinyint(4)

It's a place for keeping all pages and supages addresses and names.

