<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Tests;

use GitWrapper\GitWrapper;
use VulnDb\Version;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group unit
     */
    public function testConstant()
    {
        $this->assertTrue(defined('VulnDb\Version::VERSION'));
    }

    /**
     * @group functional
     */
    public function testTag()
    {
        $wrapper = new GitWrapper();
        $output = $wrapper->git('tag -l', __DIR__ . '/..');

        $this->assertTrue($output === null);
    }
}
