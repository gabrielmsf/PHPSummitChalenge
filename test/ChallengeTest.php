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
            (object) ['folderName' => 'Others', 'size' => '589KB'],
            (object) ['folderName' => 'Drafts', 'size' => '1459KB'],
            (object) ['folderName' => 'Jobs', 'size' => '20MB'],
            (object) ['folderName' => 'Family', 'size' => '78MB'],
            (object) ['folderName' => 'Projects', 'size' => '130MB'],
            (object) ['folderName' => 'Travels', 'size' => '119MB'],
        ];

        $userFolders2 = [
            (object) ['folderName' => 'Drafts', 'size' => '188MB'],
            (object) ['folderName' => 'Family', 'size' => '205MB'],
            (object) ['folderName' => 'Projects', 'size' => '290MB'],
            (object) ['folderName' => 'Others', 'size' => '320MB'],
            (object) ['folderName' => 'Jobs', 'size' => '1090MB'],
            (object) ['folderName' => 'Travels', 'size' => '1644MB'],
        ];

        return [
            [1, $userFolders1, '2GB', '20%'],
            [2, $userFolders2, '5GB', '75%'],
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
            ->setMethods(['list', 'getStorageSpace'])
            ->getMock();

        $folders->expects($this->once())
            ->method('list')
            ->with($userId)
            ->willReturn($userFolders);

        $folders->expects($this->once())
            ->method('getStorageSpace')
            ->with($userId)
            ->willReturn($userStorage);

        $this->challenge = new Challenge($userId);
        $percentUsed = $this->challenge->calcFolderUsedPercent($folders);

        $this->assertSame($userPercentageUsedRoundExpected, $percentUsed);
    }
}
