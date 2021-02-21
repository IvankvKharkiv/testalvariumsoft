Subject: Test task for job application.

Important!!! Project must be served localy via "php artisan serve" or virtual host or othervise links in javascripts won't work.

Short task description:
 - There are two enteties: employees and departments.
 - Employees may be payed mounthly or by hour wage. For those with hourly wage salary must be calculated when showing in table.
 - Ability to import - export employees list in XML format.
 - Showing list on page /employes.
 - Ability to show list by department at route: /employes/[department]
 - Pagination of list
 - Number per page: 10, 25, 50 100.


There are only two pages: "Welcome Page" and "Employes" in project:

![alt text](https://raw.githubusercontent.com/IvankvKharkiv/testalvariumsoft/master/readmeimages/page1.png)

1 - navigation between two pages.
2 - button for uploading mixed list, with new employees and edited old employees.
3 - with this button all the employees in provided list would be considered as new ones.

To upload list - press "Choose File" button and then corresponding "Upload button".

On "Employees" page you'll be able to see the list of employees, choose number of employees per page as well as choose department to filter though. 

![alt text](https://raw.githubusercontent.com/IvankvKharkiv/testalvariumsoft/master/readmeimages/page2.png)

1 - choosing number of employees per page.
2 - filtering through departments.
3 - download complete list of employees from db.
4 - download list from current page filtered through departments and according to page number and quantity per page.
5 - obviously pagination browthering.
6 - downloading complete list of employees by firstly saving temp.xml on server and then provide a link for user. The 3 and 4 buttons transfer raw .xml string to front and then on front the actual file is build. This is better for at least one reason: no need to set scheduled events on server to delete temp files. But this functionality was build to show that I am familiar with both approaches.


On the next picture the xml files structure is shown:
![alt text](https://raw.githubusercontent.com/IvankvKharkiv/testalvariumsoft/master/readmeimages/xml_stracture.png)
![alt text](https://raw.githubusercontent.com/IvankvKharkiv/testalvariumsoft/master/readmeimages/xmlstructureerror.png)
![alt text](https://raw.githubusercontent.com/IvankvKharkiv/testalvariumsoft/master/readmeimages/done.png)
![alt text](https://raw.githubusercontent.com/IvankvKharkiv/testalvariumsoft/master/readmeimages/newrecord.png)
