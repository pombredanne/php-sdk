<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Service;

use VulnDb\Vulnerability;

/**
 * Reference Service
 *
 * {@internal
 *     Use this service to reference third party data sources.
 * }}
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 */
class ReferenceService
{
    /**
     * Common Weakness Enumeration
     *
     * @see https://cwe.mitre.org/data/index.html
     */
    const CWE_URL_FORMAT = 'https://cwe.mitre.org/data/definitions/%d.html';

    /**
     * OWASP Top 10 - 2010
     *
     * @deprecated
     *
     * @see https://www.owasp.org/index.php/Top_10_2010-Main
     */
    const OWASP_TOP_10_2010_URL_FORMAT = 'https://www.owasp.org/index.php/Top_10_2010-A%d';

    /**
     * OWASP Top 10 - 2013
     *
     * @see https://www.owasp.org/index.php/Top_10_2013-Top_10
     */
    const OWASP_TOP_10_2013_URL_FORMAT = 'https://www.owasp.org/index.php/Top_10_2013-A%d';

    /**
     * WASC Threat Classification v2.0
     *
     * @see http://projects.webappsec.org/w/page/13246978/Threat%20Classification
     *
     * @var array
     */
    private static $wascIdToUrlMap = array(
        42 => 'http://projects.webappsec.org/w/page/13246913/Abuse%20of%20Functionality',
        11 => 'http://projects.webappsec.org/w/page/13246915/Brute%20Force',
        7  => 'http://projects.webappsec.org/w/page/13246916/Buffer%20Overflow',
        12 => 'http://projects.webappsec.org/w/page/13246917/Content%20Spoofing',
        18 => 'http://projects.webappsec.org/w/page/13246918/Credential%20and%20Session%20Prediction',
        8  => 'http://projects.webappsec.org/w/page/13246920/Cross%20Site%20Scripting',
        9  => 'http://projects.webappsec.org/w/page/13246919/Cross%20Site%20Request%20Forgery',
        10 => 'http://projects.webappsec.org/w/page/13246921/Denial%20of%20Service',
        45 => 'http://projects.webappsec.org/w/page/13246925/Fingerprinting',
        27 => 'http://projects.webappsec.org/w/page/13246930/HTTP%20Response%20Smuggling',
        25 => 'http://projects.webappsec.org/w/page/13246931/HTTP%20Response%20Splitting',
        26 => 'http://projects.webappsec.org/w/page/13246928/HTTP%20Request%20Smuggling',
        24 => 'http://projects.webappsec.org/w/page/13246929/HTTP%20Request%20Splitting',
        3  => 'http://projects.webappsec.org/w/page/13246946/Integer%20Overflows',
        6  => 'http://projects.webappsec.org/w/page/13246926/Format%20String',
        29 => 'http://projects.webappsec.org/w/page/13246947/LDAP%20Injection',
        30 => 'http://projects.webappsec.org/w/page/13246948/Mail%20Command%20Injection',
        28 => 'http://projects.webappsec.org/w/page/13246949/Null%20Byte%20Injection',
        31 => 'http://projects.webappsec.org/w/page/13246950/OS%20Commanding',
        33 => 'http://projects.webappsec.org/w/page/13246952/Path%20Traversal',
        34 => 'http://projects.webappsec.org/w/page/13246953/Predictable%20Resource%20Location',
        5  => 'http://projects.webappsec.org/w/page/13246955/Remote%20File%20Inclusion',
        32 => 'http://projects.webappsec.org/w/page/13246956/Routing%20Detour',
        37 => 'http://projects.webappsec.org/w/page/13246960/Session%20Fixation',
        35 => 'http://projects.webappsec.org/w/page/13246962/SOAP%20Array%20Abuse',
        36 => 'http://projects.webappsec.org/w/page/13246964/SSI%20Injection',
        19 => 'http://projects.webappsec.org/w/page/13246963/SQL%20Injection',
        38 => 'http://projects.webappsec.org/w/page/13246981/URL%20Redirector%20Abuse',
        39 => 'http://projects.webappsec.org/w/page/13247005/XPath%20Injection',
        41 => 'http://projects.webappsec.org/w/page/13247001/XML%20Attribute%20Blowup',
        43 => 'http://projects.webappsec.org/w/page/13247003/XML%20External%20Entities',
        44 => 'http://projects.webappsec.org/w/page/13247002/XML%20Entity%20Expansion',
        23 => 'http://projects.webappsec.org/w/page/13247004/XML%20Injection',
        46 => 'http://projects.webappsec.org/w/page/13247006/XQuery%20Injection',
        15 => 'http://projects.webappsec.org/w/page/13246914/Application%20Misconfiguration',
        16 => 'http://projects.webappsec.org/w/page/13246922/Directory%20Indexing',
        17 => 'http://projects.webappsec.org/w/page/13246932/Improper%20Filesystem%20Permissions',
        20 => 'http://projects.webappsec.org/w/page/13246933/Improper%20Input%20Handling',
        22 => 'http://projects.webappsec.org/w/page/13246934/Improper%20Output%20Handling',
        13 => 'http://projects.webappsec.org/w/page/13246936/Information%20Leakage',
        48 => 'http://projects.webappsec.org/w/page/13246937/Insecure%20Indexing',
        21 => 'http://projects.webappsec.org/w/page/13246938/Insufficient%20Anti-automation',
        1  => 'http://projects.webappsec.org/w/page/13246939/Insufficient%20Authentication',
        2  => 'http://projects.webappsec.org/w/page/13246940/Insufficient%20Authorization',
        49 => 'http://projects.webappsec.org/w/page/13246942/Insufficient%20Password%20Recovery',
        40 => 'http://projects.webappsec.org/w/page/13246943/Insufficient%20Process%20Validation',
        47 => 'http://projects.webappsec.org/w/page/13246944/Insufficient%20Session%20Expiration',
        4 =>  'http://projects.webappsec.org/w/page/13246945/Insufficient%20Transport%20Layer%20Protection',
        14 => 'http://projects.webappsec.org/w/page/13246959/Server%20Misconfiguration',
    );

    /**
     * Get CWE URL
     *
     * @param integer $cweId
     *
     * @return string
     */
    public function getCweUrl($cweId)
    {
        return sprintf(self::CWE_URL_FORMAT, $cweId);
    }

    /**
     * Get OWASP Top 10 URL
     *
     * @param integer $owaspVersion
     * @param integer $riskId
     *
     * @return string
     */
    public function getOwaspTop10Url($owaspVersion, $riskId)
    {
        $owaspVersion = (int) $owaspVersion;

        if ($owaspVersion === 2013) {
            return sprintf(self::OWASP_TOP_10_2013_URL_FORMAT, $riskId);
        }

        if ($owaspVersion === 2010) {
            return sprintf(self::OWASP_TOP_10_2010_URL_FORMAT, $riskId);
        }
    }

    /**
     * Get OWASP Top 10
     *
     * @param \VulnDb\Vulnerability $vulnerability
     *
     * @return array
     */
    public function getOwaspTop10References(Vulnerability $vulnerability)
    {
        $refs = array();

        foreach ($vulnerability->owaspTop10 as $owaspVersion => $risks) {
            foreach ($risks as $riskId) {
                $ref = $this->getOwaspTop10Url($owaspVersion, $riskId);

                if ($ref) {
                    $refs[] = array($owaspVersion, $riskId, $ref);
                }
            }
        }

        return $refs;
    }

    /**
     * Get WASC URL
     *
     * @param integer $wascId
     *
     * @return string
     */
    public function getWascUrl($wascId)
    {
        if (array_key_exists($wascId, self::$wascIdToUrlMap)) {
            return self::$wascIdToUrlMap[$wascId];
        }
    }
}
