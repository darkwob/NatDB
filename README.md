# NatDB - PDO-Based CRUD Operations Class

NatDB is a simple PHP class that facilitates basic CRUD (Create, Read, Update, Delete) operations using PDO (PHP Data Objects) with a MySQL database. This class provides an easy way to interact with your database, allowing you to perform common database operations seamlessly.

## Usage

1. **Download or Clone Repository**

   Clone the repository or download the ZIP file and extract it to your project directory.

2. **Include NatDB Class File**

   Include the `Database.php` file in your PHP script where you intend to use the NatDB class.

   ```php
   require_once('path/to/Database.php');
   ```

## Create an Instance of NatDB
Create an instance of the Database class by providing your database credentials.

  ```php
$database = new Database("localhost", "username", "password", "database_name");
   ```

## Perform CRUD Operations
Create (Insert) Operation:

  ```php
$newData = array("column1" => "value1", "column2" => "value2");
$database->create($newData);

   ```

## Read (Select) Operation:

  ```php
$record = $database->read(1);
print_r($record);

   ```

## Update Operation:

  ```php
$updateData = array("column1" => "new_value1", "column2" => "new_value2");
$database->update(1, $updateData);
  ```

## Delete Operation:

  ```php
$database->delete(1);
  ```


## Adjust Table and Database Name

Make sure to replace 'your_table_name' with the actual name of your `database` table in the Database class methods.

# Security Considerations
Input Validation:
Ensure that you validate and sanitize user input before passing it to the create and update methods to prevent SQL injection attacks.

Error Handling:
Implement proper error handling mechanisms based on your application's requirements.

Environment Variables:
Consider using environment variables for sensitive information such as database credentials to enhance security.

Contributions
Feel free to contribute to the project by opening issues or submitting pull requests.

License
This project is licensed under the MIT License - see the LICENSE file for details.
