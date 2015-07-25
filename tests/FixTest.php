<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Tests;

use VulnDb\Fix;

class FixTest extends \PHPUnit_Framework_TestCase
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
        $obj = new Fix($data);

        $this->assertEquals($expected, (string) $obj);
    }

    /**
     * @return array
     */
    public function dataToString()
    {
        return array(
            array(
                '(10) One line of guidance',
                array(
                    'effort' => 10,
                    'guidance' => 'One line of guidance',
                )
            ),
            array(
                '(20) Multi-line guidance is concatenated',
                array(
                    'effort' => 20,
                    'guidance' => array(
                        'Multi-line guidance',
                        'is concatenated'
                    ),
                )
            ),
        );
    }
}
