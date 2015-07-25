<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Tests\Service;

use VulnDb\Service\ReferenceService;
use VulnDb\Vulnerability;

class ReferenceServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group unit
     */
    public function testGetCweUrl()
    {
        $obj = new ReferenceService();

        $this->assertEquals(
            'https://cwe.mitre.org/data/definitions/200.html',
            $obj->getCweUrl(200)
        );
    }

    /**
     * @param mixed   $expected
     * @param integer $owaspVersion
     * @param integer $riskId
     *
     * @dataProvider dataGetOwaspTop10Url
     * @group unit
     */
    public function testGetOwaspTop10Url($expected, $owaspVersion, $riskId)
    {
        $obj = new ReferenceService();

        $this->assertEquals(
            'https://cwe.mitre.org/data/definitions/200.html',
            $obj->getCweUrl(200)
        );
    }

    /**
     * @return array
     */
    public function dataGetOwaspTop10Url()
    {
        return array(
            array(
                'https://www.owasp.org/index.php/Top_10_2010-A10',
                2010,
                10,
            ),
            array(
                'https://www.owasp.org/index.php/Top_10_2013-A20',
                2013,
                20,
            ),
            array(
                null,
                2007,
                40,
            ),
        );
    }

    /**
     * @group functional
     */
    public function testGetOwaspTop10References()
    {
        $data = array(
            'id' => 1,
            'title' => 'MyTitle',
            'description' => array('Description'),
            'severity' => 'high',
            'fix' => array(
                'effort' => 10,
                'guidance' => array('Guidance'),
            ),
            'owasp_top_10' => array("2010" => array(1), "2013" => array(2, 4)),
            'filename' => 'Filename',
        );

        $vulnerability = new Vulnerability($data);

        $obj = new ReferenceService();

        $this->assertEquals(
            array(
                array(2010, 1, 'https://www.owasp.org/index.php/Top_10_2010-A1'),
                array(2013, 2, 'https://www.owasp.org/index.php/Top_10_2013-A2'),
                array(2013, 4, 'https://www.owasp.org/index.php/Top_10_2013-A4'),
            ),
            $obj->getOwaspTop10References($vulnerability)
        );
    }

    /**
     * @group unit
     */
    public function testGetWascUrl()
    {
        $obj = new ReferenceService();

        $this->assertEquals(
            'http://projects.webappsec.org/w/page/13246955/Remote%20File%20Inclusion',
            $obj->getWascUrl(5)
        );
    }
}
