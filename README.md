# Laravel Hubspot Custom Object Store

Welcome to the Laravel Hubspot Custom Object Store! This project demonstrates how to use Laravel to interact with the HubSpot API and store custom object data.

## Project Overview

The purpose of this project is to showcase how you can integrate Laravel with the HubSpot API to store data in a custom object. It provides a simple example of how to use the `HubspotService` class to send data to HubSpot and save it in a custom object.

### Key Features

- Integration with HubSpot API
- Storing data in a custom object
- Demonstrating API communication with Guzzle HTTP Client

## Installation

To get started with the project, follow these installation steps:

1. Clone the repository to your local machine:

   ```
   git clone https://github.com/Parthfaladu/laravel-hubspot-custom-object.git
   ```

2. Change into the project directory:

   ```
   cd laravel-hubspot-custom-object
   ```

3. Install PHP dependencies using Composer:

   ```
   composer install
   ```

4. Create a `.env` file by copying `.env.example`:

   ```
   cp .env.example .env
   ```

5. Generate the application key:

   ```
   php artisan key:generate
   ```

6. Configure the `.env` file with your database and other environment settings.

7. Run database migrations:

   ```
   php artisan migrate
   ```

8. Start the development server:

   ```
   php artisan serve
   ```

Your Laravel project is now up and running! Access it in your web browser at `http://localhost:8000`.

## How to Use the HubspotService

The `HubspotService` class in this project provides a convenient way to interact with the HubSpot API and store data in HubSpot's custom object.

### Prerequisites

Before using the `HubspotService`, make sure you have the following:

- A HubSpot account.
- An API key from HubSpot with the necessary permissions.

### Installation

The `HubspotService` class is already included in the project, so you don't need to install it separately.

### Configuration

To use the `HubspotService`, open the `.env` file and provide your HubSpot API key:

```dotenv
HUBSPOT_API_KEY=your_hubspot_api_key_here
```

### How to Use

In your Laravel application, you can now use the `HubspotService` to store data in HubSpot. Here's an example:

```php
use App\Services\HubspotService;

// Instantiate the HubspotService
$hubspotService = new HubspotService();

// Define the custom object type in HubSpot where you want to store the data
$objectType = 'posts';

// Prepare the data to be stored (replace 'property_name' with actual property names in your custom object)
$data = [
    'property_name' => 'Value 1',
    'another_property' => 'Value 2',
    // Add more properties as needed
];

try {
    // Use the storeCustomObject method to store the data in HubSpot
    $response = $hubspotService->storeCustomObject($objectType, $data);
    // Process the response as needed
    // For example, log the success message, display a success notification, etc.
} catch (Exception $e) {
    // Handle any errors that might occur during the API request
    // For example, log the error, display an error message to the user, etc.
    Log::error('Error storing data in HubSpot: ' . $e->getMessage());
}
```

Make sure to replace `'property_name'` with the actual property names in your custom object and customize the error handling based on your project requirements.

## Contributing

We welcome contributions to this project. If you find a bug or have an idea for an improvement, feel free to create an issue or submit a pull request.

## License

This project is open-source and licensed under the [MIT License](LICENSE).
```
