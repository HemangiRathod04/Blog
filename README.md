<!-- blog post with user and admin : user have post,comments and admin have user listing , front end validation and backend validation  applied -->

# Laravel Project: Post and Comment Management

## Introduction
This project is a Laravel application that allows users to manage posts and comments. It includes features for user registration, login, role-based access control, and CRUD operations for posts and comments.

---

## Requirements
- PHP >= 8.0
- Composer
- MySQL or any other database supported by Laravel

---

## Installation Steps
1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Create Database**
   - Create a database named `post_comment` (or update `.env` file with your database credentials).

4. **Set Environment Variables**
   - Copy the `.env.example` file and rename it to `.env`.
   - Update the `.env` file with your database details.

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed Database**
   ```bash
   php artisan db:seed --class=RolesTableSeeder
   php artisan db:seed --class=AdminSeeder
   ```

7. **Serve the Application**
   ```bash
   php artisan serve
   ```
   Access the application at `http://127.0.0.1:8000`.

---

## Features
### User Features
- **Registration with Validation**
  - Users can register with validation rules.

- **Login**
  - Separate login options for Users and Admins.

### Admin Features
- **Manage Users**
  - Admin can create, edit, and delete users.

- **CRUD Operations on Users**
  - Create users with validation.
  - Edit user details.
  - Delete users with confirmation.

### Post Management (Users)
- **Add Post**
  - Users can create new posts.

- **Edit Post**
  - Users can update their posts.

- **Delete Post**
  - Users can delete their posts with confirmation.

### Comment Management (Users)
- **Add Comment**
  - Users can add comments to posts.

- **Manage Comments**
  - Add multiple comments.
  - Edit comments.
  - Delete comments with confirmation.

- **Comment Listing**
  - View all comments.

---

## Screenshots
1. **User Registration**
   ![Register Page](path/to/register-screenshot.png)

2. **User Login**
   ![Login Page](path/to/login-screenshot.png)

3. **Admin User Management**
   - Create User
   - Edit User
   - Delete User

4. **Post Management**
   - Add Post
   - Edit Post
   - Delete Post

5. **Comment Management**
   - Add Comment
   - Edit Comment
   - Delete Comment

---

## License
This project is licensed under the [MIT License](LICENSE).

---

## Contributions
Feel free to submit issues or pull requests. Contributions are welcome!

