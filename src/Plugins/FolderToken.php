<?php

namespace BoxStorage\Plugins;

use Cache;
use League\Flysystem\Plugin\AbstractPlugin;

class FolderToken extends AbstractPlugin
{
    public function getMethod()
    {
        return 'folderToken';
    }

    public function handle($folderId)
    {

        $resp = Cache::remember($folderId, 60, function () use ($folderId) {
            return $this->filesystem->getAdapter()->client->downscopeToken($folderId)->getJson();
        });
        return $resp;
    }
}
