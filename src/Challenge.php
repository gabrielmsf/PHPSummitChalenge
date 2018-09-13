<?php

namespace Challenge;

use \Challenge\Models\Folders;

class Challenge
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function calcFolderUsedPercent(Folders $folders)
    {
        $conversion = 1024;
        $storageGB = intval(str_replace('GB', '', $folders->getStorageSpace($this->userId)));
        $userFolders = $folders->list($this->userId);
        $spaceUsed = $this->spaceUsed($userFolders);

        $storageMB = $storageGB * $conversion;
        $percentUsed = ($spaceUsed * 100) / $storageMB;

        return ceil($percentUsed) . '%';
    }

    private function spaceUsed(array $userFolders)
    {
        $size = 0;

        foreach ($userFolders as $folder) {
            $size += intval(str_replace('MB', '', $folder->size));
        }

        return $size;
    }
}
