# Connect to MSSQL in PHP with Frontend

## About the Project

This project is a sample implementation for connecting **Microsoft SQL Server** in **PHP**, featuring a simple frontend interface. It is suitable for developers who need to establish a connection between PHP and MSSQL and want to see a practical implementation of this process.

## Features

- Connect to MSSQL using PHP
- Simple frontend interface using **jQuery** and **TailwindCSS**
- Uses **ODBC Driver** for database communication
- Compatible with Windows environments and servers supporting MSSQL
- Database connection details can be updated dynamically after login

## Setup and Usage

### 1. Prerequisites

- **PHP 8.1 or higher**
- **Microsoft SQL Server**
- **ODBC Driver** (available in the `.requirements` folder)

### 2. Installing Dependencies

To run the project, you first need to install the **ODBC Driver**. You can find the required file in the `.requirements` folder:

```
.requirements/msodbcsql.msi
```

After installation, ensure that the **SQL Server service** is running and the **ODBC settings** are correctly configured.

### 3. Database Connection Setup

In this project, database connection details are not hardcoded in the script. Instead, they are collected dynamically after login and can be updated online through the user interface.

### 4. Running the Project

Once setup is complete, place the project on a **local server** such as **XAMPP** or **IIS** and run it.

If using **XAMPP**, place the project in the `htdocs` folder and open it in your browser:

```
http://localhost/connect-to-mssql-in-php-with-front/index.php
```

If using a remote server, ensure that **firewall settings** and **access permissions** are properly configured.

## Online Demo

You can test the project online at:

**[View Demo](https://mssql.misterbr.ir/)**

## Troubleshooting

### 1. `Could not find driver` Error

If you encounter this error, verify that the **ODBC Driver** is properly installed and enabled in PHP settings.

### 2. `Login failed for user` Error

Ensure that the **username** and **password** are correct and have sufficient permissions to access **SQL Server**.

### 3. `Connection Timeout` Error

- Check that **SQL Server** allows **remote connections**.
- Ensure port 1433 is open in the **Windows Firewall**.

## Contributors

If you have suggestions for improving the project, feel free to contribute by submitting a **Pull Request** on GitHub.

---

**Happy Coding!** 🚀

