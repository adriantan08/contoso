Database is in database dump folder.

User login is: test@email.com
Password should be: password

There's a lockout mechanism involved should the user try to login more that 5 times. As of the moment, only the login above would work.

Routes are as aligned, except for some changes in the preference usage of 'new' and it was replaced with 'add':
- {domain}/add/company - should display the form for adding a new company
- {domain}/add/employee - should display the form for adding a new employee to a company
 -{domain}/company - should display all companies information in the database with capability to AJAX refresh the table
- {domain}/company/{company_id} - should display the information about the requested company
- {domain}/employees/{company_id} - should display all the employees in the company in a table
- {domain}/employees/{company_id}/{employee_id} - should display information about the employee along with a form to edit the employee details