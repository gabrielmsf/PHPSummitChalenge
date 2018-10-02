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
        $user_folders = $folders->list($this->userId);
        $user_space = $folders->getStorageSpace($this->userId);
        $user_space = intval(str_replace('GB', '', $user_space));
        $total_size = 0;

        foreach ($user_folders as $folder) {
            $size_str = $folder->size;
            $total_size += intval(str_replace('MB', '', $size_str));
        }

        $total_size = $total_size/1024;

        $percentage = ceil(($total_size/$user_space) * 100);

        return $percentage . '%';
    }
}
