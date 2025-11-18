
# **Task Management Application (Laravel)**

A clean, simple Laravel-based task management application that supports creating, updating, deleting, reordering, and organizing tasks by project. This application was built using Laravel best practices, readable code structure, RESTful controllers, migrations, Eloquent relationships, and drag-and-drop UI behavior.


## **Overview**

This web application allows users to:

* Create tasks
* Edit tasks
* Delete tasks
* Reorder tasks using intuitive drag-and-drop
* Automatically update task priority after reordering (#1 at top)
* Store tasks in a MySQL database
* Filter tasks by project from a dropdown menu

All functionality follows Laravel conventions and best practices.

# **Features**

### **Task Management**

* Create new tasks
* Edit existing tasks
* Delete tasks
* Real-time drag-and-drop sorting
* Automatic priority recalculation
* Persistent task order stored in MySQL

### **Project Management**

* Create projects
* Assign each task to a project (optional)
* Filter task list by selected project
* “All Projects” option to view all tasks

### **Technical Features**

* Laravel 12+
* RESTful controllers
* Eloquent ORM with `hasMany` / `belongsTo` relationships
* AJAX-based reorder endpoint
* MySQL database for persistent storage


# **Requirements**

To run this project locally, you need:

* **PHP 8.2+**
* **Laravel 11+**
* **Composer**
* **MySQL 8+**
* Local dev environment such as:

  * **Laravel Herd** (used for development)
  * XAMPP/MAMP


# **Installation**

Follow the steps below to install and run the project.


## 1️ **Clone the Repository**

```bash
git clone [https://github.com/Peud001/task-management-site.git](https://github.com/Peud001/task-management-site.git)

cd task-management-site


## 2️ **Install PHP Dependencies**

```bash
composer install

If using Laravel Herd, PHP is already configured automatically.


## 3️ **Setup Environment File**

Duplicate the example environment file:

```bash
cp .env.example .env

Then configure your MySQL database:


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=yourpassword


# **Database Migrations**

Run the database migrations:

```bash
php artisan migrate
```

This creates the tables:

* `projects`
* `tasks`

### **Projects Table**

* id
* name
* timestamps

### **Tasks Table**

* id
* project_id (nullable, FK)
* name
* priority
* timestamps


# **Feature Implementation Details**


## **Drag-and-Drop Sorting**

Tasks can be reordered in the browser using drag-and-drop.

**How it works:**

1. User drags a task to a new position.
2. JavaScript collects all task IDs in their new order.
3. Browser sends JSON payload to:

POST /tasks/reorder

4. The controller updates each task’s priority:

```php
foreach ($order as $index => $id) {
    Task::where('id', $id)->update([
        'priority' => $index + 1
    ]);
}

5. The task list instantly updates.


## **Project Filtering**

Users can select a project from a dropdown:

* When a project is selected, only tasks for that project appear.
* “None” displays all tasks.

Controller logic:

```php
if ($projectId) {
    $query->where('project_id', $projectId);
}
```

# 🛣 **Routes Overview**

### **Tasks**

  Method   Route                Description                    
  
  GET      /tasks               Task list with project filter  
  GET      /tasks/create        Task creation form             
  POST     /tasks               Store task                     
  GET      /tasks/{task}/edit   Edit form                      
  PUT      /tasks/{task}        Update task                    
  DELETE   /tasks/{task}        Delete task                    
  POST     /tasks/reorder       Drag-and-drop reorder endpoint 

### **Projects**

  Method   Route       Description    

  GET      /projects   List projects  
  POST     /projects   Create project 

