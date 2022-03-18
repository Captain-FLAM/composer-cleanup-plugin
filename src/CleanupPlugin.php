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
	/** @var  \Composer\Composer $installManager */
	protected $installManager;
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
		$this->installManager = $composer->getInstallationManager();
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
	 * Run after a package has been installed
	 */
	public function onPostPackageInstall(PackageEvent $event)
	{
		$this->io->write('****    Clean Packages - Post Package Install    ****');
		
		$this->cleanPackage($event->getOperation()->getPackage());
	}

	/**
	 * Run after a package has been updated
	 */
	public function onPostPackageUpdate(PackageEvent $event)
	{
		$this->io->write('****    Clean Packages - Post Package Update    ****');
		
		$this->cleanPackage($event->getOperation()->getTargetPackage());
	}

	/**
	 * Run after composer command install or update
	 *
	 * @param CommandEvent $event
	 */
	public function onPostInstallUpdateCmd(Event $event)
	{
		$this->io->write('****    Clean Packages - Command : '.$event->getName().'    ****');
		
		$packages = $this->composer->getRepositoryManager()->getLocalRepository()->getPackages();
		
		foreach($packages as $package)
		{
			if ($package instanceof BasePackage) $this->cleanPackage($package);
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
		// if ($package->getInstallationSource() !== 'dist') return false;
		
		$packageName = $package->getPrettyName();
		if (! isset($this->rules[$packageName])) return;
		
		$packageDir = $this->installManager->getInstallPath($package);
		$targetDir  = $package->getTargetDir();
		if ($targetDir) $packageDir .= '/'.$targetDir;
		
		$packageDir = $this->filesystem->normalizePath(realpath($packageDir));
		if (! is_dir($packageDir)) return false;
		
		// $this->io->write('Clean package : '.$packageName);
		
		foreach($this->rules[$packageName] as $part)
		{
			// Split patterns for single globs (should be max 260 chars)
			$patterns = explode(' ', trim($part));
			
			foreach ($patterns as $pattern)
			{
				try {
					foreach (glob($packageDir.'/'.$pattern) as $file)
					{
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
