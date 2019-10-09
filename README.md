# Access My Info
AMI is a web application that helps people to create legal requests for copies of their personal information from data operators. AMI is a step-by-step wizard that results in the generation of a personalized formal letter requesting access to the information that an operator stores and utilizes about a person.

**Note**: This is a placeholder application meant to be customized. It is not the code repository for the [AMI Canada](https://accessmyinfo.ca) or [AMI Hong Kong](https://accessmyinfo.hk) implementations. For a full guide on running an Access My Info campaign, check out [https://accessmyinfo.org](https://accessmyinfo.org).

## Installation
AMI is for the most part, a static HTML website. Any webserver that can serve HTML files should be capable of serving AMI.

If you want to track the number of requests created, you will need PHP and MYSQL on your server as well.

## Static App
The AMI app lives in the `static` folder. The app is compiled upon page load  by JavaScript that looks at the contents of the `js/data.js` file. It then scans `static/index.html` to identify special HTML templates, then does some business logic to populate the templates with the contents of the data model.

If you wish to track statistics then you can remove the `static/index.html` file and use `static/index.php` instead.

### Customization
As mentioned above, this codebase is for a placeholder application. You will see placeholder logos and references to {{YOUR ORG}} that you should replace with your own organization's information.

You should furthermore review the privacy policy in the footer of the website and make any necessary updates as required by your local jurisdiction.

### Data Model
The `data.js` file includes the structured information for the application.

This includes a list of industries, companies, information categories, and personal identifiers.

**Industries** are the types of businesses or organizations that users start their request by selecting. Industries must have a `name`, `id`, `description`, and `icon`.

**Companies** are the organizations to which the user sends a request. Companies must have a `name`, `id`, `logo`, `contact`, and be assigned an `industry`. Company contact information must at least have the following attributes: `title`, `has_mail`, `has_email`. `has_mail` and `has_email` should be set to true or false. One of them must be true at least. If `has_mail` is true, then the company contact object must also have `address1`, `address2`, `city`, `region`, `postalcode`, and `country` defined. If `has_email` is true, then `email` must also be set and include a valid email address.

**Info Categories** are the types of personal information that companies might hold on people, and that users can include in their request letters. Each info categories must have the following: `name`, `id`, `description`, and be assigned one or more `industries`. `industries` is an array, so even if one industry is assigned, it would have to look like this `["industry1"]`.

**Personal Identifiers** are included in a request so the company can find the requester in their records. Personal identifiers must have the following attributes: `name`, `id`, `description`, and be assigned one or more `industries`. `industries` is an array, so even if one industry is assigned, it would have to look like this `["industry1"]`. Personal identifiers may also include an `options` attribute. This will allow the user to choose from a list of options for a particular identifier (like province of residence). `options` must be an array of objects, with each object having the `id` and `name` attributes. For example: `"options": [{"id": "first", "name": "First Option"}]`

### Editing the frontend
There are lots of comments throughout `index.php` and `js/ami/*.js` files to help you along with customizing the look and feel. Have fun!

If you don't want to use stats or don't have a PHP webserver, simply rename `index.php` to `index.html` and remove all `<?php ..... ?>` stuff (top of file and near bottom), following the instructions in the comments.

## Statistics
To track statistics, you will need a PHP web server with a MYSQL database.

The statistics code lives in the `stats` folder.

`index.php` displays a simple table of how many stats each company has received.

`process_request.php` is the file that the frontend sends its statistics form data to. You will have to configure `index.php` to point to the right URL, following the comments in the last script block at the bottom of the page.

It's best practice to move the `private` folder out of the webroot or add an `.htaccess` file to the folder to make it private. These files should not be accessible on the public internet for security reasons.

### Installation
Create a new MYSQL database for tracking stats.

Copy `stats/private/db/db_connection_template.php` to`stats/private/db/db_connection.php`, and edit the new file to point to that new database, and edit the credentials as needed.

Execute the `install.sql` command in PHPMyAdmin or through command line. THis will create the required database tables.


