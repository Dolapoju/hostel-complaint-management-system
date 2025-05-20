
# ComplainIT

This web app automates the complaint management in a hostel setting
***

## Features

### Students

- User Authentication.
- Submission and Management of Complaints.

### Workers

- User Authentication.
- View and completion of complaints depending on occupation: plumbers,carpenters and aluminum.

### Hostel Administrator

- User Authenication.
- Approval/pushing of complaints to workers.
- Monitoring the status of complaints: date completed, by whom, whom approved et cetera.
***

## Technology
- **Frontend:** HTML, CSS, Javascript
- **Backend:** PHP, MYSQL
***

## Installation

1. Clone the repo.
2. rename `dblinksample.php` to `dblink.php`.
3. change the servername, username and password to your local server details.
4. create a database called `complaint_management`.
5. import the database structute into the database using the sql file in the database folder.
6. Start your local server.
***
## Project Structure

Files are grouped based on users, workers and admin with the exception of the worker sign up page which is in the admin folder.
***

## Glossary

- *Unapproved Complaints:* These are complaints that haven't been appoved by the admin and cannot be seen by the workers, once a complaint is approved it leaves this view.
- *Complaint History:* This is where complaints that have been approved can be viewed, whether completed or uncompleted that is for students.For workers this is where every complaint that has been completed can be viewed.
- *Pending Complaints:* These are complaints that are waiting to be completed by workers.
- *Approved History:* These are conplaints that have been approved by the hall administrators and are visible to workers.