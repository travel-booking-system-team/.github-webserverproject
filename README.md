# 🛫 Travel Booking System  

## 📖 Description  
**Travel Booking System** is a web application that allows users to register, log in, and manage their flight reservations for domestic and international travel easily and efficiently.  It includes a user authentication system, booking management, and a database connection to store user and travel data.


## 👨‍💻 Authors
- Lucas Otaviano Meira Lobato  
- Jessica Narita Hattori
- Zenhayevsky Carolina Solorzano Acevedo  
- Diana Paola Toala Lopez


  ## ✨ Features  

✅ **User Registration/Login** 🔐  
   - Secure login using email and password.  
   - Users can reset their password via email verification.  

✅ **User Profile Management** 👤  
   - Users can update personal details.  
   - View booking history.  

✅ **Browse Destinations** 🌍  
   - List of available destinations with images, descriptions, and prices.  
   - Filters for easy searching.  

✅ **Booking System** 📅  
   - Users can select destinations, choose travel dates, and book a trip.  

✅ **Cancel a Booking** ❌  
   - Users can cancel their bookings via their account.  
   - Receive an email confirmation.  

✅ **Reschedule a Booking** 🔄  
   - Modify travel dates (subject to availability).  
   - Receive an updated confirmation email.  

✅ **Admin Panel** 🛠  
   - Admins can manage bookings, users, and destinations.  

✅ **Payment Integration (Optional)** 💳  
   - Secure payment processing using Stripe or PayPal.  

✅ **Email Notifications** 📧  
   - Automatic emails for booking confirmations, cancellations, and reschedules.  

✅ **Reviews & Ratings** ⭐  
   - Users can leave feedback and rate destinations.  
   - Admins can moderate reviews.  

✅ **Wishlist/Favorites** ❤️  
   - Users can save destinations for future bookings.  

✅ **Basic Support System** 💬  
   - Contact form or chat system for user inquiries.

     
## 🏗️ System Architecture  
The system follows a **client-server architecture

**📌 Architecture Diagram:**  
![Architecture Diagram](https://github.com/travel-booking-system-team/.github-webserverproject/blob/main/architecture/architecture.png)  

---

## 🛠️ Technologies Used  
- **Server-side language:** PHP  
- **Database:** MySQL  
- **Front-end:** HTML, CSS, JavaScript  
- **Version control:** Git 

---

## 🗄️ Database Schema  
The database schema is designed to store information about users, flights, and reservations.  

**📌 Database Schema Diagram:**  
![Database Schema](https://github.com/travel-booking-system-team/.github-webserverproject/blob/main/database/db_diagram.png)

**📌 Database Script:**  
![Database Script](https://github.com/travel-booking-system-team/.github-webserverproject/blob/main/database/db_backup.sql)

---

## 📌 Prerequisites  
Before running the project, make sure you have:  
- Apache server with PHP (`XAMPP` or `WAMP`)  
- MySQL  
- Git  


---


## ⚙️ Installation & Setup  
1. **Clone the repository**  
   ```sh
   git clone https://github.com/travel-booking-system-team/.github-webserverproject.git


---


## 📂 Project Structure  
```bash
/travel-booking-system
├── /css          # Stylesheets
├── /php          # Backend scripts 
├── /images       # Project images
├── /includes     # Footer and Header
├── index.php     # Home page
├── login.php     # User login page
├── register.php  # User registration page
├── dashboard.php # User dashboard
├── README.md     # Documentation file
├── /architecture # Architecture Diagram
└── /database     # Database file

