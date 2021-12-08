## Todo app project

This todo app was creating on internship course in Agiliway by Bogdan Lubinskyj (19.10.2021 - 9.12.2021)
Application has to provide ability:
1. Create group for TODO entries with specific name
2. Delete group for TODO entries
3. Update group name for TODO entries
4. Show list of groups for TODO entries
5. Show created date and time for group of TODO entries
6. *** Paginate groups list for TODO entries (20 per page, button next, button
      previous, pages count, etc)
7. Show list of TODO entries inside group
8. Create TODO entry inside group
9. Set to status 'DONE' TODO entry (has to distinguish from undone on FE)
10. Show date and time of changing status to 'DONE'
11. *** Paginate list for TODO entries inside group (10 per page)
12. Sort by name, status, date and time list of TODO entries inside group
13. Show status message for any user action
14. Show styled 404 page if not found.

     Application could depend on any technologies. However, backend has to be done
     using PHP (any framework or no framework). Backend could use any database
     picked by yourself.
     Backend could be done as API or MVC. No auth required.  
     Frontend using ANY JS libraries or no libraries at all. It is not necessary for
     application to be mobile ready. Only desktop version is required.
     Whole project has to start up through docker.
     All text in application must be in english
     Any improvements on top of requirements are welcome.

*** additional functionality, could be skipped

###Note
- docker-compose file are in todo-app/docker.
- For linux use docker-compose.linux.yml by command `docker-compose -f docker-compose.linux.yml up`.
- For windows use docker-compose.yml by `command docker-compose up`
