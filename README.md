# Gym Management System

A PHP project designed to help gyms manage their members, streamline administrative tasks, and promote the gym to potential customers. This system provides an efficient, user-friendly platform for gym owners and staff to handle memberships, track attendance, manage payments, and present information about the gym to the public.


## Project Overview

Gym Management System is a web-based application built primarily using PHP, with supporting technologies such as MySQL, CSS, and JavaScript. It is intended to automate and simplify the daily operations of a gym, from member registration to payment tracking and gym promotion.

## Features

- **Member Registration:** Add, update, or remove gym members.
- **Membership Plans:** Manage different membership types and plans.
- **Attendance Tracking:** Record and monitor member attendance.
- **Payment Management:** Track payments, dues, and generate receipts.
- **Staff Management:** Manage gym staff information and roles.
- **Promotional Page:** Showcase gym facilities, trainers, and offers for potential customers.
- **Dashboard:** Overview of gym statistics and activities.

## Purpose

- Streamline the management of gym members and staff.
- Automate payment tracking and reduce manual errors.
- Provide a professional web presence to attract and inform potential customers.
- Enable gym owners to focus on business growth by reducing administrative overhead.

## Demo

You can run the project locally to see a demo (see setup instructions below).

## Requirements

- **Web Server:** [XAMPP](https://www.apachefriends.org/), [WAMP](https://www.wampserver.com/), [MAMP](https://www.mamp.info/), or any server supporting PHP and MySQL.
- **PHP:** Version 7.0 or higher.
- **MySQL:** Version 5.7 or higher.
- **Browser:** Any modern web browser (Chrome, Firefox, Edge, etc.).

## Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Rajak13/GymManagementSystem.git
   ```

2. **Move the Project to Web Server Directory**
   - If using XAMPP, move the project folder into `C:\xampp\htdocs\`
   - If using WAMP, move it to `C:\wamp\www\`
   - For MAMP, move to `Applications/MAMP/htdocs/`

3. **Setup the Database**
   - Open phpMyAdmin (`http://localhost/phpmyadmin`)
   - Create a new database (e.g., `gym_management`)
   - Import the database file:
     - Look for a `.sql` file in the project directory (e.g., `database.sql`)
     - Import it into your newly created database

4. **Configure Database Connection**
   - Edit the database configuration file (commonly `config.php` or inside a `/config` folder)
   - Update the following details as per your local server:
     ```php
     $host = 'localhost';
     $user = 'root';
     $password = '';
     $database = 'gym_management';
     ```
   - Save the changes.

5. **Start the Server**
   - Open XAMPP/WAMP/MAMP control panel
   - Start Apache and MySQL services

6. **Access the Application**
   - Open your browser and go to: `http://localhost/GymManagementSystem/`

## Usage Instructions

- **Login:** Use the provided admin or staff credentials, or register a new user if the signup option is available.
- **Navigate Dashboard:** Access member management, attendance, payments, and promotional pages via the sidebar or navigation menu.
- **Add/Manage Members:** Use the 'Members' section to add, edit, or remove gym members.
- **Attendance:** Mark attendance for members.
- **Payments:** Record new payments, view payment history, and manage dues.
- **Promotional Content:** Update information, images, and offers to keep your gym’s public page attractive for potential customers.



## Troubleshooting

- **Blank Page/Error:** Check database configuration and ensure Apache/MySQL are running.
- **Database Errors:** Ensure you have imported the `.sql` file and updated credentials in config.
- **Asset Not Loading:** Make sure file paths in your HTML/PHP files are correct relative to your server directory.

## License

This project is for educational purposes. For commercial use, please contact me at rajakansari833@gmail.com.

---

**Developed by [Rajak13](https://github.com/Rajak13)**  
For any issues, open an [issue](https://github.com/Rajak13/GymManagementSystem/issues).
