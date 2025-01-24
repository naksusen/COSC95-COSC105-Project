# <div align="center" style="background: linear-gradient(to right, blue, pink); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 2.5em;">COSC95-COSC105-Project</div>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A web-based **Event Registration System** built with PHP, HTML, CSS, JavaScript, and MySQL. This system allows users to easily sign up for events, while administrators can create, delete, edit, or modify events, manage registrations, handle participant details, and scan QR codes for verification.

## Features
- **User Registration:** Students can easily sign up for events by filling out an online registration form.
- **Admin Panel:** Administrators can manage events, view participant information, and approve registrations.
- **QR Code Generation:** After registering, a unique QR code is generated for each user. Administrators can scan these QR codes for attendance tracking and payment confirmation purposes.
- **MySQL Database:** All event and registration data is stored in a MySQL database for easy management and retrieval.

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **QR Code Generation:** PHP-based QR code generation library for creating and scanning QR codes.

## Installation Instructions
### Prerequisites
Before you begin, ensure you have the following installed on your local machine:
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- A web server like [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/)
- [PHP QR Code library](https://github.com/t0k4rt/php-qrcode) for generating and scanning QR codes.

### Steps to Install
1. **Clone the Repository**
   
   First, clone this repository to your local machine:
   ```bash
   git clone https://github.com/naksusen/COSC95-COSC105-Project.git

3. **Set Up the Database**
   
   - Open MySQL (via XAMPP or WAMP) and create a new database.
   - Import the `g-arat.sql` file provided and/or create your tables based on your project’s requirements.
     
5. **Place the Project in Your Web Server's Root Directory**
   
    If you're using XAMPP, move the entire project folder into the `htdocs` directory. If you're using WAMP, place the project in the `www` directory.
   
7. **Run the Web Server** <br>
   Start your web server (Apache) and MySQL services via XAMPP or WAMP.
   
8. **Access the Project**
   
   Open your browser and navigate to:

   ```arduino
   http://localhost/COSC95-COSC105-Project

## Usage
- **For Users:** Register to create your credentials, visit the homepage, view event details, and sign up for events. After registration, a unique QR code will be generated for the user
- **For Admins:** Log in to the admin panel to manage events and participant registrations. Admins can create, delete, edit, or modify events, as well as scan the QR code generated for students to confirm their attendance or payment.

<div align="center" style="color: #666; font-weight: 300;">
© 2025 Project Contributors (JJC): Jackie, Janet, Charl
</div>
