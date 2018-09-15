<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Challenge\Challenge;

class ChallengeTest extends TestCase
{
    /** @var Challenge */
    private $challenge;

    public function providerFoldersUsed()
    {
        $userFolders1 = [
            (object) ['folderName' => 'Jobs', 'size' => '105MB'],
            (object) ['folderName' => 'Family', 'size' => '265MB'],
            (object) ['folderName' => 'Projects', 'size' => '381MB'],
            (object) ['folderName' => 'Travels', 'size' => '273MB'],
        ];

        $userFolders2 = [
            (object) ['folderName' => 'Drafts', 'size' => '931MB'],
            (object) ['folderName' => 'Projects', 'size' => '365MB'],
            (object) ['folderName' => 'Others', 'size' => '1198MB'],
            (object) ['folderName' => 'Jobs', 'size' => '1090MB'],
        ];

        return [
            [1, $userFolders1, '2GB', '50%'],
            [2, $userFolders2, '5GB', '70%'],
        ];
    }

    /**
     * @dataProvider providerFoldersUsed
     * @param integer $userId
     * @param array $userFolders
     * @param string $userStorage
     * @param string $userPercentageUsedRoundExpected
     * @return void
     */
    public function testCalcFolderUsedPercent($userId, $userFolders, $userStorage, $userPercentageUsedRoundExpected)
    {
        $folders = $this->getMockBuilder(\Challenge\Models\Folders::class)
            ->setMethods(['list'])
            ->getMock();

        $folders->expects($this->once())
            ->method('list')
            ->with($userId)
            ->willReturn($userFolders);

        $this->challenge = new Challenge($userId);
        $percentUsed = $this->challenge->calcFolderUsedPercent($folders, $userStorage);

        $this->assertSame($userPercentageUsedRoundExpected, $percentUsed);
    }
}
