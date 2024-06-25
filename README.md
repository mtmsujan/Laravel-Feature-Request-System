# Laravel Feature Request System

This project is a Feature Request and Roadmap Website developed using Laravel and Tailwind CSS. The website allows users to submit suggestions, feature requests, or feedback for a product/software. Users can also vote and comment on other users' posts, view the roadmap, and customize the color scheme based on the product's primary color. Admins will receive notifications whenever a user submits a post.

## Features

-   **User Suggestions**: Users can post their suggestions, feature requests, or feedback.
-   **Voting System**: Users can vote on other users' posts to prioritize features.
-   **Commenting System**: Users can comment on posts to provide additional feedback.
-   **Roadmap View**: Users can view the development roadmap of the product.
-   **Color Customization**: Admins can change the website's color scheme to match the product's primary color.
-   **Admin Notifications**: Admins receive notifications when new posts are submitted.

## Installation

To install and run this project as a Laravel application, follow these steps:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/mtmsujan/laravel-feature-fequest-system.git
    cd feature-request-website
    ```
2. **Install dependencies::**
   Navigate to the project directory:

    bash
    Copy code
    cd feature-request-roadmap

3. **Install dependencies::**

    bash
    Copy code
    composer install
    npm install
    npm run dev

4. **Copy the .env.example file to .env::**

    bash
    Copy code
    cp .env.example .env

5. **Generate an application key::**

    bash
    Copy code
    php artisan key:generate
    Configure your .env file:

    Update the .env file with your database credentials and other necessary configuration.

6. **Run database migrations:**

    bash
    Copy code
    php artisan migrate

7. **Serve the application:**

    bash
    Copy code
    php artisan serve
    Your website should now be running at http://localhost:8000.

## Usage

1. **Admin Customization:**
   To change the color scheme, navigate to the admin settings page and update the primary color to match your product's branding.

2. **User Submissions:**
   Users can submit feature requests, suggestions, and feedback through the submission form.
   Users can vote on and comment on others' posts.

3. **Viewing the Roadmap:**
   Users can view the development roadmap to see planned features and updates.

## Contributing

**If you would like to contribute to this project, please follow these steps:**

1. Fork the repository.
2. Create a new branch (git checkout -b feature-branch).
3. Make your changes.
4. Commit your changes (git commit -m 'Add some feature').
5. Push to the branch (git push origin feature-branch).
6. Open a pull request.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

If you have any questions or feedback, please feel free to contact me at [mtmsujon@gmail.com].

Thank you for using the Feature Request & Roadmap Website!
