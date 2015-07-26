<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Service;

use GitWrapper\GitWrapper;
use Symfony\Component\Finder\Finder;
use VulnDb\Vulnerability;

/**
 * VulnDb Repository Service
 *
 * {@internal
 *     Use this service to interact with the vulndb/data repository.
 * }}
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 */
class VulnDbDataRepositoryService
{
    const REPOSITORY_URL = 'https://github.com/vulndb/data.git';
    const REPOSITORY_PATH = '/../../data';
    const DATABASE_PATH = '/../../vulndb';
    const JSON_DATA_PATH = '/../../vulndb/db';

    /**
     * Get repository version
     *
     * @return string
     */
    public function getRepositoryVersion()
    {
        $wrapper = new GitWrapper();
        $repositoryPath = __DIR__ . self::REPOSITORY_PATH;

        if (! file_exists($repositoryPath . '/.git')) {
            return '';
        }

        $output = rtrim($wrapper->git('log -n1 --pretty=format:%H', $repositoryPath));

        return $output;
    }

    /**
     * Update the vulnerability database (returning any output from the git wrapper)
     *
     * @throws \Exception
     */
    public function updateDatabase()
    {
        $wrapper  = new GitWrapper();
        $repositoryPath = __DIR__ . self::REPOSITORY_PATH;

        if (! file_exists($repositoryPath . '/.git')) {
            $git = $wrapper->clone(self::REPOSITORY_URL, $repositoryPath);

            $git->getOutput();
        } else {
            $wrapper->git('pull', $repositoryPath);
        }

        $this->replaceJsonFiles();
    }

    /**
     * Replace json files
     */
    private function replaceJsonFiles()
    {
        $repositoryPath = __DIR__ . self::REPOSITORY_PATH;
        $jsonDataPath   = __DIR__ . self::JSON_DATA_PATH;
        $dbVersionPath  = __DIR__ . self::DATABASE_PATH . '/db-version.txt';

        $finder = new Finder();
        $finder->files()->in($repositoryPath . '/db')->name('*.json');

        $names = array();

        // copy new and updated files
        foreach ($finder as $file) {
            $name = basename($file);
            $names[$name] = true;

            copy($file, $jsonDataPath . '/' . $name);
        }

        $finder = new Finder();
        $finder->files()->in($jsonDataPath)->name('*.json');

        // remove obsolete files
        foreach ($finder as $file) {
            $name = basename($file);

            if (array_key_exists($name, $names)) {
                continue;
            }

            unlink($file);
        }

        file_put_contents($dbVersionPath, $this->getRepositoryVersion() . "\n");
    }
}
