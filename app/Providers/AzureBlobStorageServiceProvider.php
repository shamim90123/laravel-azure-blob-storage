<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter; // Correct namespace
use Illuminate\Filesystem\FilesystemAdapter;

class AzureBlobStorageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the Azure driver
        \Storage::extend('azure', function ($app, $config) {
            $client = BlobRestProxy::createBlobService(
                "DefaultEndpointsProtocol=https;AccountName={$config['name']};AccountKey={$config['key']}"
            );

            $adapter = new AzureBlobStorageAdapter($client, $config['container']);

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}
