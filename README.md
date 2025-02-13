# Azure Blob Storage Integration with Laravel

This guide explains how to integrate Azure Blob Storage with a Laravel application using the `league/flysystem-azure-blob-storage` package.

## Prerequisites

Before you begin, ensure you have the following:

- **Azure Storage Account**:
  - Create an Azure Storage Account.
  - Obtain the following details from your Azure portal:
    - Storage Account Name
    - Storage Account Key
    - Container Name

- **Laravel Application**: Ensure you have a Laravel application set up.

- **Composer**: Ensure Composer is installed to manage dependencies.

## Installation

### 1. Install Required Packages

Run the following command to install the necessary packages:

```bash
composer require league/flysystem-azure-blob-storage microsoft/azure-storage-blob
```

## 2. Configure Azure Blob Storage

Add the following environment variables to your `.env` file to configure Azure Blob Storage:

```env
AZURE_STORAGE_NAME=your_storage_account_name
AZURE_STORAGE_KEY=your_storage_account_key
AZURE_STORAGE_CONTAINER=your_container_name
```

3. Add Azure Disk Configuration

Update the config/filesystems.php file to include a new disk for Azure Blob Storage:


'disks' => [
    // Other disks...

    'azure' => [
        'driver'    => 'azure',
        'name'      => env('AZURE_STORAGE_NAME'),
        'key'       => env('AZURE_STORAGE_KEY'),
        'container' => env('AZURE_STORAGE_CONTAINER'),
    ],
],
4. Create a Custom Service Provider
Create a custom service provider to register the Azure driver. Run the following Artisan command:

```bash
php artisan make:provider AzureBlobStorageServiceProvider
```

Please follow the AzureBlobStorageServiceProvider.php file.

5. Register the Service Provider
Add the custom service provider to the providers array in config/app.php:


'providers' => [
    // Other service providers...

    App\Providers\AzureBlobStorageServiceProvider::class,
],

6. Clear Configuration Cache
Clear the configuration cache to ensure Laravel picks up the new changes:

```bash
php artisan config:cache
```

---

## 👨‍💻 Author
Developed by **Shamim Reza**. Connect with me on [GitHub](https://github.com/shamim90123).
