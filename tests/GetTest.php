<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 02.04.21 05:15:11
 */

declare(strict_types = 1);
namespace dicr\tests;

use dicr\topvisor\entity\Folder;
use dicr\topvisor\entity\GetFoldersRequest;
use dicr\topvisor\entity\GetGroupsRequest;
use dicr\topvisor\entity\GetHistoryRequest;
use dicr\topvisor\entity\GetKeywordsRequest;
use dicr\topvisor\entity\GetProjectsRequest;
use dicr\topvisor\entity\Group;
use dicr\topvisor\entity\HistoryResult;
use dicr\topvisor\entity\Keyword;
use dicr\topvisor\entity\Project;
use dicr\topvisor\TopVisorApi;
use PHPUnit\Framework\TestCase;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;

use function count;

use const PROJECT_ID;
use const REGION_INDEX;

/**
 * Class TariffRequestTest
 */
class GetTest extends TestCase
{
    /**
     * Модуль.
     *
     * @return TopVisorApi
     * @throws InvalidConfigException
     */
    private static function api(): TopVisorApi
    {
        return Yii::$app->get('topvisor');
    }

    /**
     * @throws Exception
     */
    public function testGetProject(): void
    {
        /** @var GetProjectsRequest $request */
        $request = self::api()->request([
            'class' => GetProjectsRequest::class,
            'limit' => 10
        ]);

        $response = $request->send();
        self::assertNotEmpty($response->result);
        self::assertInstanceOf(Project::class, $response->result[0]);
        echo 'Total projects: ' . count($response->result) . "\n";
    }

    /**
     * @throws Exception
     * @noinspection PhpUnitMissingTargetForTestInspection
     */
    public function testGetFolders(): void
    {
        /** @var GetFoldersRequest $request */
        $request = self::api()->request([
            'class' => GetFoldersRequest::class,
            'projectId' => PROJECT_ID
        ]);

        $response = $request->send();
        self::assertNotEmpty($response->result);
        self::assertInstanceOf(Folder::class, $response->result[0]);
        echo 'Total folders: ' . count($response->result) . "\n";
    }

    /**
     * @throws Exception
     */
    public function testGetGroups(): void
    {
        /** @var GetGroupsRequest $request */
        $request = self::api()->request([
            'class' => GetGroupsRequest::class,
            'projectId' => PROJECT_ID
        ]);

        $response = $request->send();
        self::assertNotEmpty($response->result);
        self::assertInstanceOf(Group::class, $response->result[0]);
        echo 'Total groups: ' . count($response->result) . "\n";
    }

    /**
     * @throws Exception
     */
    public function testGetKeywords(): void
    {
        /** @var GetKeywordsRequest $request */
        $request = self::api()->request([
            'class' => GetKeywordsRequest::class,
            'projectId' => PROJECT_ID,
            'limit' => 10
        ]);

        $response = $request->send();
        self::assertNotEmpty($response->result);
        self::assertInstanceOf(Keyword::class, $response->result[0]);
        echo 'Total keywords: ' . count($response->result) . "\n";
    }

    /**
     * @throws Exception
     */
    public function testGetHistory(): void
    {
        /** @var GetHistoryRequest $request */
        $request = self::api()->request([
            'class' => GetHistoryRequest::class,
            'projectId' => PROJECT_ID,
            'regionsIndexes' => [REGION_INDEX],
            'date1' => (idate('Y') - 1) . '-' . date('m-d'),
            'date2' => date('Y-m-d'),
            'limit' => 10
        ]);

        $response = $request->send();
        self::assertInstanceOf(HistoryResult::class, $response->result);
        self::assertNotEmpty($response->result->keywords);
        echo 'Total keywords: ' . count($response->result->keywords) . "\n";
    }
}
