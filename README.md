# Task Management Web App

This is a lightweight PHP-based task management application. Users can create, edit, delete, publish/unpublish, and mark tasks as complete.

## Features

- User login and session handling
- Add, edit, and delete tasks
- Mark tasks as complete using a checkbox
- Publish/unpublish tasks
- Automatically creates the database and tables on first load

## Technologies Used

- PHP
- MySQL
- HTML/CSS
- Bootstrap (for UI styling)
- Font Awesome (icons)

## Setup Instructions

1. **Clone or download** the project to your web server directory (e.g., `htdocs` for XAMPP).
2. Make sure MySQL is running.
3. Open the project in your browser (e.g., `http://localhost/Interview/`).
4. The app will automatically create the database and necessary tables on first load using `setup.php`.

## Default Configuration

- **Database name**: `synrgise_db`
- **MySQL user**: `root`
- **MySQL password**: `newpass`  
- **Servername**: `localhost`
  *(You can change this in `Config.php`)*

## File Structure

- `index.php` – Homepage/dashboard
- `add_task.php` – Add a new task
- `edit_task.php` – Edit an existing task
- `delete_task.php` – Delete a task
- `mark_complete.php` – Mark task as complete
- `setup.php` – Automatically creates the database and tables
- `assets/` – Contains CSS, JS, and icon files

## Notes

- Each task is associated with a username.
- Tasks can be published or unpublished and sorted by due date.
- The checkbox allows users to select tasks and mark them as complete using the "Mark Complete" button.
- Disclaimer the project is not fully functional