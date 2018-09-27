<?php

namespace Challenge;

class Challenge
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function calcFolderUsedPercent($folders)
    {
        $userFolders = $folders->list($this->userId);

        $userUsage = $this->calcUserFolderUsage($userFolders);
        $userStorage = $this->convertUserStorageSpace($folders->getStorageSpace($this->userId));

        $percent = ceil($userUsage / $userStorage * 100);

        return  $percent . '%';
    }

    protected function calcUserFolderUsage($userFolders)
    {
        $usage = 0;

        foreach ($userFolders as $folder) {
            $usage += (int) str_replace('MB', '', $folder->size);
        }

        return $usage;
    }

    protected function convertUserStorageSpace($userStorage)
    {
        return (int) str_replace('GB', '', $userStorage) * 1024;
    }
}
