# **Task Management Application (Laravel)**

A clean, simple Laravel-based task management application for creating, editing, deleting, and reordering tasks by project. Built following Laravel best practices, with clear structure, RESTful controllers, drag-and-drop sorting, and MySQL storage.


# **Overview**

This application allows users to:

* Create tasks
* Edit and delete tasks
* Drag-and-drop reorder tasks
* Automatically update priority after sorting
* Filter by project
* Persist task ordering in MySQL


# **Requirements**


To run the project locally, you need:

* **PHP 8.2+**
* **Laravel 11+**
* **Composer**
* **MySQL 8+**
* A local server environment:

  * ✔ **Laravel Herd** (recommended)
  * ✔ **XAMPP / MAMP** (for manual PHP + MySQL control)

> **Node.js is NOT required.**
> This project uses Laravel Blade + built-in JS only.

---

# 🚀 **Installation Guide**

Below are two separate setup paths depending on how the user gets the code.


#  **Scenario A — You Downloaded the ZIP File**

Follow this if you are using thr ZIP file.

---

## 1️ **Extract the ZIP File**

* Download the ZIP and create a new folder, copy and paste the ZIP file in that folder.
* Right-click on the zip file and select → **Extract here**
* Rename the folder: task-management-site (optional):

---

## 2️ **Move the project into your server directory**

Depending on your environment:

### ✔ **If using Laravel Herd**

* Simply place the folder in the Herd directory
* Example:

  ```
  ~/Herd/task-management-site
  ```

### ✔ **If using XAMPP**

Move it into:

```
C:\xampp\htdocs\task-management-site
```

### ✔ **If using MAMP**

Move it into:

```
/Applications/MAMP/htdocs/task-management-site
```

---

## 3️ **Open a terminal inside the project folder**

Example:

**macOS/Herd/MAMP:**

```bash
cd ~/Code/task-management-site
```

**Windows/XAMPP:**

```bash
cd C:\xampp\htdocs\task-management-site
```

---

## 4️ **Install dependencies**

```bash
composer install
```

(Note: When the installation starts, you may see repeated warnings like:
Failed to download package from dist: The zip extension and unzip/7z commands are both missing
This is because Composer cannot use zip downloads without PHP’s zip extension or external unzip tools.
# You might choose to ignore it

OR
# Open your php.ini file (e.g., C:\xampp\php\php.ini).
# Ensure the following line is uncommented (remove the leading ;):
extension=zip)
---

## 5️ **Create your environment file**

```bash
cp .env.example .env
```

---

## 6️ **Generate the app key**

```bash
php artisan key:generate
```

---

## 7️ **Create a MySQL database**

Name it:

```
task_management
```

Using:

* **phpMyAdmin** (XAMPP/MAMP)
* **Herd DB Manager** (if using Herd)
* Or MySQL CLI

---

## 8️ **Update your `.env` file**

```
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

---

## 9️⃣ **Run migrations**

```bash
php artisan migrate
```

---

##  **Serve the application**

### ✔ **Laravel Herd (Recommended)**

Just open:

```
http://task-management-site.test
```

### ✔ **XAMPP / MAMP**

Start Apache + MySQL
Then run:

```bash
php artisan serve
```

App will be available at:

```
http://127.0.0.1:8000
```

---

# 🟦 **Scenario B — You Cloned the Project Using Git**

If you used:

```bash
git clone https://github.com/Peud001/task-management-site.git
```

Then everything else is **exactly the same**:

1. `cd task-management-site`
2. `composer install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. Set DB credentials
6. `php artisan migrate`
7. Run the server

See steps above for details.

---

# **Database Structure**

## **Projects Table**

* id
* name
* timestamps

## **Tasks Table**

* id
* project_id
* name
* priority
* timestamps

---

#  **Drag-and-Drop Sorting**

The browser sends reordered IDs to:

```
POST /tasks/reorder
```

Controller:

```php
foreach ($order as $index => $id) {
    Task::where('id', $id)->update([
        'priority' => $index + 1
    ]);
}
```

---

#  **Routes Overview**

### **Tasks**

 Method  Route               Description 
 
 GET     /tasks              List tasks  
 GET     /tasks/create       Create form 
 POST    /tasks              Store task  
 GET     /tasks/{task}/edit  Edit form   
 PUT     /tasks/{task}       Update task 
 DELETE  /tasks/{task}       Delete task 
 POST    /tasks/reorder      Sort tasks  

### **Projects**

 Method  Route      Description    
  
 GET     /projects  List projects  
 POST    /projects  Create project 

