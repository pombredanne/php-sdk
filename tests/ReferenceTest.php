<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Tests;

use VulnDb\Reference;

class ReferenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $expected
     * @param array  $data
     *
     * @dataProvider dataToString
     * @group unit
     */
    public function testToString($expected, $data)
    {
        $obj = new Reference($data);

        $this->assertEquals($expected, (string) $obj);
    }

    /**
     * @return array
     */
    public function dataToString()
    {
        return array(
            array(
                '[MyTitle](http://example/)',
                array(
                    'title' => 'MyTitle',
                    'url' => 'http://example/',
                )
            ),
        );
    }
}
