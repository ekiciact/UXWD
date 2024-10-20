# SnapAdv - Adventure & Snaps Management Platform

## Overview
SnapAdv is a web-based platform that helps users manage and share their adventures and moments, referred to as "snaps." Built using the CodeIgniter PHP framework, the application provides a clean user interface, dynamic JavaScript elements, and intuitive tools for creating, finding, and interacting with various adventure-based content.

## Features
- **Adventure Creation & Discovery**: Users can create adventures, explore existing ones, and find exciting new locations.
- **User Profiles**: Each user has a profile page where they can update their information and upload images.
- **Interactive Snap Management**: Allows users to create and manage "snaps," which are shareable media associated with their adventures.
- **Media Management**: Includes support for uploading and cropping images using Croppie.js, with easy-to-use buttons for interaction.
- **Map Integration**: Uses Leaflet.js to help users find and explore adventures on a map.

## Project Structure
- **application/**: Contains the main application files for handling the backend logic and routing (CodeIgniter MVC structure).
- **public/assets/**: Holds all the frontend assets such as JavaScript files, CSS, and images.
- **writable/**: Stores the writable data, including logs, cache, and uploads.

## Installation
1. Clone this repository to your local machine:
   ```sh
   git clone https://github.com/yourusername/SnapAdv.git
   ```
2. Navigate to the project directory:
   ```sh
   cd SnapAdv
   ```
3. Set up your server environment with PHP and MySQL.
4. Update the database configuration in `application/config/database.php`.
5. Run the application by accessing it via your local web server.

## Technologies Used
- **Backend**: PHP with CodeIgniter Framework
- **Frontend**: HTML, CSS, JavaScript (jQuery, Leaflet.js, Croppie.js)
- **Database**: MySQL

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Contact
For questions or suggestions, please reach out to the maintainer at [your email here].

