<?php

namespace CaptainFLAM\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Installer\PackageEvent;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\Filesystem;
use Composer\Package\BasePackage;

class CleanupPlugin implements PluginInterface, EventSubscriberInterface
{
	/** @var  \Composer\Composer $composer */
	protected $composer;
	/** @var  \Composer\IO\IOInterface $io */
	protected $io;
	/** @var  \Composer\Config $config */
	protected $config;
	/** @var  \Composer\Util\Filesystem $filesystem */
	protected $filesystem;
	/** @var  array $rules */
	protected $rules;

	/**
	 * {@inheritDoc}
	 */
	public function activate(Composer $composer, IOInterface $io)
	{
		$this->composer = $composer;
		$this->io = $io;
		$this->config = $composer->getConfig();
		$this->filesystem = new Filesystem();
		$this->rules = CleanupRules::getRules();
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function deactivate(Composer $composer, IOInterface $io)
	{
	}

	/**
	 * {@inheritDoc}
	 */
	public function uninstall(Composer $composer, IOInterface $io)
	{
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'post-package-install' => 'onPostPackageInstall',
			'post-package-update' => 'onPostPackageUpdate',
//			'post-install-cmd' => 'onPostInstallUpdateCmd',
//			'post-update-cmd' => 'onPostInstallUpdateCmd',
			'pre-autoload-dump' => 'onPostInstallUpdateCmd',
		);
	}

	/**
	 * Function to run after a package has been installed
	 */
	public function onPostPackageInstall(PackageEvent $event)
	{
		$this->io->write('****    Clean Packages - Post Package Install    ****');
		/** @var \Composer\Package\CompletePackage $package */
		$package = $event->getOperation()->getPackage();
		
		$this->cleanPackage($package);
	}

	/**
	 * Function to run after a package has been updated
	 */
	public function onPostPackageUpdate(PackageEvent $event)
	{
		$this->io->write('****    Clean Packages - Post Package Update    ****');
		/** @var \Composer\Package\CompletePackage $package */
		$package = $event->getOperation()->getTargetPackage();
		
		$this->cleanPackage($package);
	}

	/**
	 * Function to run after a package has been updated
	 *
	 * @param CommandEvent $event
	 */
	public function onPostInstallUpdateCmd(Event $event)
	{
		$this->io->write('****    Clean Packages - Command : '.$event->getName().'    ****');
		/** @var \Composer\Repository\WritableRepositoryInterface $repository */
		$repository = $this->composer->getRepositoryManager()->getLocalRepository();
		
		/** @var \Composer\Package\CompletePackage $package */
		foreach($repository->getPackages() as $package){
			if ($package instanceof BasePackage) {
				$this->cleanPackage($package);
			}
		}
	}

	/**
	 * Clean a package, based on its rules.
	 *
	 * @param BasePackage  $package  The package to clean
	 * @return bool True if cleaned
	 */
	protected function cleanPackage(BasePackage $package)
	{
		// Only clean 'dist' packages
		if ($package->getInstallationSource() !== 'dist') return false;
		
		$vendorDir = $this->config->get('vendor-dir');
		$targetDir = $package->getTargetDir();
		$packageName = $package->getPrettyName();
		$packageDir = $targetDir ? $packageName.'/'.$targetDir : $packageName ;
		
		if (! isset($this->rules[$packageName])) return;
		
		$dir = $this->filesystem->normalizePath(realpath($vendorDir.'/'.$packageDir));
		if (! is_dir($dir)) return false;
		
		$this->io->write('Clean package : '.$packageName);
		
		foreach($this->rules[$packageName] as $part)
		{
			// Split patterns for single globs (should be max 260 chars)
			$patterns = explode(' ', trim($part));
			
			foreach ($patterns as $pattern)
			{
				try {
					foreach (glob($dir.'/'.$pattern) as $file) {
						$this->filesystem->remove($file);
					}
				}
				catch (\Exception $e) {
					$this->io->write('Could not parse '.$packageDir.' ('.$pattern.') : '.$e->getMessage());
				}
			}
		}
		return true;
	}
}
