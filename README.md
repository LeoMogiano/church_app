# Church Administration Web Application

Welcome to the Church Administration Web Application repository. This web application is designed to help manage various aspects of church administration, including user management, event management, income tracking, and role management. It follows the Model-View-Controller (MVC) architectural pattern for a structured and maintainable codebase.

## Features

- **User Management:** Create and manage user accounts for church members and staff.

- **Event Management:** Schedule and manage church events, including services, meetings, and special occasions.

- **Income Tracking:** Record and track church income, including tithes, offerings, and donations.

- **Role Management:** Assign roles to church members, such as pastor, deacon, and elder.

-  **Relationship Management:** Record and track relationships between church members, such as family, friends, and coworkers.

## Project Structure

The project is structured following the MVC pattern:

- **Model:** Contains database interactions, business logic, and data models.

- **View:** Includes the presentation layer responsible for rendering HTML and user interfaces.

- **Controller:** Manages the application's core logic, handling requests, and orchestrating data flow.

- **Public:** Store public assets like CSS, JavaScript, and images.

- **Config:** Configuration files for database connections and other settings.

- **Database:** Contains SQL scripts for creating and seeding the database.

## Installation

1. Clone this repository to your web server directory:

    ```bash
    https://github.com/LeoMogiano/arqui_project.git
    ```

2. Intall XAMPP or WAMP to run the application locally.

3. Config the database connection in the `config/database.php` and `models/IglesiaDB.php` files.

4. Run server and open the application in your browser.

    ```bash
    php -S localhost:8080 -t public
    ```

## Screenshots

*Screen*

<img loading="lazy" width="90%" src="./screenshots/s1.png" alt="Screen" />


## Contribution

Contributions are welcome! If you'd like to contribute to this project, please fork the repository, make your changes, and submit a pull request.

## License

This project is open-source and available under the [MIT License](LICENSE). You're free to use and modify it for your church administration needs.

## Contact

If you have any questions or need assistance, feel free to contact us.

Enjoy using the Church Administration Web Application!
