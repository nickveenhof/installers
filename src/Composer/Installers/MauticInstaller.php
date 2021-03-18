<?php
namespace Composer\Installers;

use Composer\Package\PackageInterface;

class MauticInstaller extends BaseInstaller
{
    protected $locations = array(
        'plugin'           => 'plugins/{$name}/',
        'theme'            => 'themes/{$name}/',
        'core'             => 'app/',
    );

    /**
     * @param PackageInterface $package
     *
     * @return string
     */
    private function getDirectoryName(PackageInterface $package)
    {
        $extra = $package->getExtra();

        if (!empty($extra['install-directory-name'])) {
            return $extra['install-directory-name'];
        }

        return $this->toCamelCase($package->getPrettyName());
    }

    /**
     * @param string $packageName
     *
     * @return string
     */
    private function toCamelCase($packageName)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', basename($packageName))));
    }

    /**
     * Format package name of mautic-plugins to CamelCase
     */
    public function inflectPackageVars($vars)
    {
        var_dump($vars);
        if ($vars['type'] == 'mautic-plugin') {
            $vars['name'] = $this->getDirectoryName($vars['name']);
        }

        return $vars;
    }

}
