<?php

namespace BoxStorage;

use BoxStorage\Plugins\FolderToken;
use Illuminate\Support\ServiceProvider;
use LaravelBox\LaravelBox as BoxClient;
use League\Flysystem\Filesystem;
use Storage;

class BoxStorageServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Storage::extend('box', function ($app, $config) {
            $client = new BoxClient(
                $config['access_token']
            );
            $flysystem = new Filesystem(new BoxAdapter($client));

            $flysystem->addPlugin(new FolderToken());

            return $flysystem;
        });
    }


    public function register()
    {
    }


}
