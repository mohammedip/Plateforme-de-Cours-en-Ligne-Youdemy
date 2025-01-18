# Youdemy - Online Course Platform

## Project Context
Youdemy is an online course platform designed to revolutionize learning by offering an interactive and personalized experience for both students and teachers. The platform enables intuitive management of courses, users, and content while adhering to the fundamental principles of Object-Oriented Programming (OOP).

---

## Main Features

### # Front Office

#### ## Visitor
- Access to the course catalog with pagination.
- Course search by keywords.
- Account creation with a role choice:
  - Student
  - Teacher

#### ## Student
- View the course catalog.
- Search and view course details:
  - Description, content, instructor, etc.
- Enroll in courses after authentication.
- Access a **"My Courses"** section listing enrolled courses.

#### ## Teacher
- Add new courses with details such as:
  - Title
  - Description
  - Content (video or document)
  - Tags
  - Category
- Manage courses:
  - Edit
  - Delete
  - View enrolled students.
- Access a **"Statistics"** section showing data such as:
  - Number of enrolled students.
  - Total courses.
  - Trends based on enrollments.

---

### # Back Office

#### ## Administrator
- Approve teacher accounts.
- Manage users:
  - Activate
  - Suspend
  - Delete
- Manage content:
  - Create, update, and delete courses, categories, and tags.
  - Bulk insert tags for efficiency.
- View global statistics:
  - Total number of courses.
  - Course distribution by category.
  - Course with the most students.
  - Top 3 most popular teachers.

---

## Cross-Functional Features
- A course can have **multiple tags** (many-to-many relationship).
- Use of **polymorphism** in functionalities such as:
  - Adding a course.
  - Displaying a course.
- Authentication and authorization system to protect sensitive routes.
- Access control:
  - Users can only access features corresponding to their roles.

---

## Technical Requirements
- Adherence to **OOP principles**:
  - Encapsulation
  - Inheritance
  - Polymorphism
- Relational database with relationships:
  - One-to-Many
  - Many-to-Many
- Management of logged-in users using **PHP sessions**.
- Validation of user data for security.

---

## Project Structure

### # Database
- **Courses**:
  - Title, description, content (video/document), category, tags.
- **Users**:
  - Students, teachers, and administrators.
- Relationships between entities:
  - One-to-Many (e.g., Category → Courses)
  - Many-to-Many (e.g., Courses ↔ Tags)

### # Key Modules
1. **Course Management**:
   - Add, edit, delete.
2. **User Management**:
   - Registration, validation, role management.
3. **Statistics**:
   - Global and specific data per user.

---

## Installation and Setup

### # Prerequisites
1. **PHP**: Version 7.4 or higher.
2. **MySQL**: Database server.
3. Local server (e.g., XAMPP, WAMP, or Laragon).


### Technologies Used
1. **Backend**: PHP (OOP).
2. **Frontend**: HTML, CSS, TailwindCSS, JavaScript.
3. **Database**: MySQL.
4. **Session Management**: PHP Sessions.
5. **Data Validation**: Secure PHP scripts.
