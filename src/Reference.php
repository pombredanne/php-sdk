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
 * Vulnerability Reference
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 */
class Reference
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $title;

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url   = $data['url'];
        $this->title = $data['title'];
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf('[%s](%s)', $this->title, $this->url);
    }
}
