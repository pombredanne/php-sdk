<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb;

/**
 * Vulnerability Fix
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 */
class Fix
{
    /**
     * @var integer
     */
    public $effort;

    /**
     * @var string
     */
    public $guidance;

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->effort   = $data['effort'];
        $this->guidance = implode(' ', (array) $data['guidance']);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf('(%s) %s', $this->effort, $this->guidance);
    }
}
