<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Tests\Service;

use VulnDb\Service\VulnDbDataRepositoryService;

class VulnDbDataRepositoryServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group functional
     */
    public function testUpdateDatabase()
    {
        $this->markTestSkipped('TODO: move GitWrapper to service factory');
    }

    /**
     * @group functional
     */
    public function testGetRepositoryVersion()
    {
        $obj = new VulnDbDataRepositoryService();

        $output = $obj->getRepositoryVersion();

        $this->assertEquals(40, strlen($output));
    }
}
