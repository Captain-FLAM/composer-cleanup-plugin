<?php

namespace CaptainFLAM\Composer;

class CleanupRules
{
	public static function getRules()
	{
		// Default patterns for common files
		$docs = 'README* CHANGELOG* FAQ* CONTRIBUTING* HISTORY* UPGRADING* UPGRADE* TESTING* LICENSE* package* demo example examples doc docs readme* changelog*';
		$tests = '.travis.yml .scrutinizer.yml phpcs.xml* phpcs.php phpunit.xml* phpunit.php test* Test* travis patchwork.json';

		return array(
			'aws/aws-sdk-php'                 	    => array($docs, $tests),
			'anahkiasen/former'                     => array($docs, $tests),
			'anahkiasen/html-object'                => array($docs, 'phpunit.xml* tests/*'),
			'anahkiasen/rocketeer'                  => array($docs, $tests),
			'anahkiasen/underscore-php'             => array($docs, $tests),
			'barryvdh/composer-cleanup-plugin'      => array($docs, $tests),
			'barryvdh/laravel-debugbar'             => array($docs, $tests),
			'barryvdh/laravel-ide-helper'           => array($docs, $tests),
			'bllim/datatables'                      => array($docs, $tests),
			'cartalyst/sentry'                      => array($docs, $tests),
			'classpreloader/classpreloader'         => array($docs, $tests),
			'd11wtq/boris'                          => array($docs, $tests),
			'danielstjules/stringy'                 => array($docs, $tests),
			'dflydev/markdown'                      => array($docs, $tests),
			'dnoegel/php-xdg-base-dir'              => array($docs, $tests),
			'doctrine/annotations'                  => array($docs, $tests),
			'doctrine/cache'                        => array($docs, $tests),
			'doctrine/collections'                  => array($docs, $tests),
			'doctrine/common'                       => array($docs, $tests),
			'doctrine/data-fixtures'                => array($docs, $tests),
			'doctrine/dbal'                         => array($docs, $tests, 'build*'),
			'doctrine/deprecations'                 => array($docs, $tests, 'test_fixtures'),
			'doctrine/doctrine-bundle'              => array($docs, $tests),
			'doctrine/doctrine-fixtures-bundle'     => array($docs, $tests),
			'doctrine/doctrine-migrations-bundle'   => array($docs, $tests),
			'doctrine/event-manager'                => array($docs, $tests),
			'doctrine/inflector'                    => array($docs, $tests),
			'doctrine/instantiator'                 => array($docs, $tests),
			'doctrine/lexer'                        => array($docs, $tests),
			'doctrine/migrations'                   => array($docs, $tests),
			'doctrine/orm'                          => array($docs, $tests),
			'doctrine/persistence'                  => array($docs, $tests, 'tests_php*'),
			'doctrine/sql-formatter'                => array($docs, $tests, 'bin'),
			'dompdf/dompdf'                         => array($docs, $tests, 'www'),
			'filp/whoops'                           => array($docs, $tests),
			'guzzle/guzzle'                         => array($docs, $tests),
			'guzzlehttp/guzzle'                     => array($docs, $tests),
			'guzzlehttp/oauth-subscriber'           => array($docs, $tests),
			'guzzlehttp/streams'                    => array($docs, $tests),
			'imagine/imagine'                       => array($docs, $tests, 'lib/Imagine/Test'),
			'intervention/image'                    => array($docs, $tests, 'public'),
			'ircmaxell/password-compat'             => array($docs, $tests),
			'jakub-onderka/php-console-color'       => array($docs, $tests, 'build.xml example.php'),
			'jakub-onderka/php-console-highlighter' => array($docs, $tests, 'build.xml'),
			'jasonlewis/basset'                     => array($docs, $tests),
			'jeremeamia/SuperClosure'               => array($docs, $tests, 'demo'),
			'kriswallsmith/assetic'                 => array($docs, $tests),
			'laravel/framework'                     => array($docs, $tests, 'build'),
			'leafo/lessphp'                         => array($docs, $tests, 'Makefile package.sh'),
			'league/flysystem'                      => array($docs, $tests),
			'league/stack-robots'                   => array($docs, $tests),
			'maximebf/debugbar'                     => array($docs, $tests, 'demo'),
			'mccool/laravel-auto-presenter'         => array($docs, $tests),
			'mockery/mockery'                       => array($docs, $tests),
			'monolog/monolog'                       => array($docs, $tests),
			'mrclay/minify'                         => array($docs, $tests, 'MIN.txt min_extras min_unit_tests min/builder min/config* min/quick-test* min/utils.php min/groupsConfig.php min/index.php'),
			'mtdowling/cron-expression'             => array($docs, $tests),
			'mustache/mustache'                     => array($docs, $tests, 'bin'),
			'nesbot/carbon'                         => array($docs, $tests),
			'nikic/php-parser'                      => array($docs, $tests, 'test_old'),
			'oyejorge/less.php'                     => array($docs, $tests),
			'patchwork/utf8'                        => array($docs, $tests),
			'phenx/php-font-lib'                    => array($docs, $tests. 'www'),
			'phpdocumentor/reflection-docblock'     => array($docs, $tests),
			'phpoffice/phpexcel'                    => array($docs, $tests, 'Examples unitTests changelog.txt'),
			'phpoffice/phpspreadsheet'              => array($docs, $tests, 'samples'),
			'phpseclib/phpseclib'                   => array($docs, $tests, 'build'),
			'predis/predis'                         => array($docs, $tests, 'bin'),
			'psr/log'                               => array($docs, $tests),
			'psy/psysh'                             => array($docs, $tests),
			'quickbooks/v3-php-sdk'                 => array($docs, $tests, 'docs docs/* src/XSD2PHP/test src/XSD2PHP/test/*'),
			'rcrowe/twigbridge'                     => array($docs, $tests),
			'simplepie/simplepie'                   => array($docs, $tests, 'build compatibility_test ROADMAP.md'),
			'stack/builder'                         => array($docs, $tests),
			'swiftmailer/swiftmailer'               => array($docs, $tests, 'build* notes test-suite create_pear_package.php'),
			'symfony/browser-kit'                   => array($docs, $tests),
			'symfony/class-loader'                  => array($docs, $tests),
			'symfony/console'                       => array($docs, $tests),
			'symfony/css-selector'                  => array($docs, $tests),
			'symfony/debug'                         => array($docs, $tests),
			'symfony/dom-crawler'                   => array($docs, $tests),
			'symfony/event-dispatcher'              => array($docs, $tests),
			'symfony/filesystem'                    => array($docs, $tests),
			'symfony/finder'                        => array($docs, $tests),
			'symfony/http-foundation'               => array($docs, $tests),
			'symfony/http-kernel'                   => array($docs, $tests),
			'symfony/process'                       => array($docs, $tests),
			'symfony/routing'                       => array($docs, $tests),
			'symfony/security'                      => array($docs, $tests),
			'symfony/security-core'                 => array($docs, $tests),
			'symfony/translation'                   => array($docs, $tests),
			'symfony/var-dumper'                    => array($docs, $tests),
			'tecnickcom/tcpdf'                      => array($docs, $tests, 'fonts'),
			'tijsverkoyen/css-to-inline-styles'     => array($docs, $tests),
			'twig/twig'                             => array($docs, 'src/Test src/Node/Expression/Test'),
			'venturecraft/revisionable'             => array($docs, $tests),
			'vlucas/phpdotenv'                      => array($docs, $tests),
			'willdurand/geocoder'                   => array($docs, $tests),
			
			// ****  Specific to Mautic (version 4.2.0)  ****
			'mautic/core-lib'                       => array(
				'bundles/*/Test*',
				// 'bundles/ApiBundle/Tests',
				// 'bundles/AssetBundle/Tests',
				// 'bundles/CacheBundle/Tests',
				// 'bundles/CampaignBundle/Tests',
				// 'bundles/CategoryBundle/Tests',
				// 'bundles/ChannelBundle/Tests',
				// 'bundles/ConfigBundle/Tests',
				// 'bundles/CoreBundle/Test*',
				// 'bundles/DashboardBundle/Tests',
				// 'bundles/DynamicContentBundle/Tests',
				// 'bundles/EmailBundle/Tests',
				// 'bundles/FormBundle/Tests',
				// 'bundles/InstallBundle/Tests',
				// 'bundles/IntegrationsBundle/Tests',
				// 'bundles/IntegrationsBundle/Tests',
				// 'bundles/LeadBundle/Tests',
				// 'bundles/MarketplaceBundle/Tests',
				// 'bundles/PageBundle/Tests',
				// 'bundles/PluginBundle/Tests',
				// 'bundles/PointBundle/Tests',
				// 'bundles/QueueBundle/Tests',
				// 'bundles/ReportBundle/Tests',
				// 'bundles/SmsBundle/Tests',
				// 'bundles/StageBundle/Tests',
				// 'bundles/StatsBundle/Tests',
				// 'bundles/UserBundle/Tests',
				// 'bundles/WebhookBundle/Tests',
				'middlewares/Tests'
			),
			'mautic/core-project-message'           => array($docs, $tests),
			'mautic/grapes-js-builder-bundle'       => array($docs, $tests),
			'mautic/plugin-citrix'                  => array($docs, $tests),
			'mautic/plugin-crm'                     => array($docs, $tests),
			'mautic/plugin-focus'                   => array($docs, $tests),
			'mautic/plugin-tagmanager'              => array($docs, $tests),
			'koco/mautic-recaptcha-bundle'          => array($docs, $tests),
			'aws/aws-crt-php'                       => array($docs, $tests),
			'bandwidth-throttle/token-bucket'       => array($docs, $tests),
			'friendsofsymfony/oauth2-php'           => array($docs, $tests),
			'friendsofsymfony/oauth-server-bundle'  => array($docs, $tests),
			'gaufrette/extras'                      => array($docs, $tests),
			'helios-ag/fm-elfinder-bundle'          => array($docs, $tests),
			'joomla/filter'                         => array($docs, $tests),
			'joomla/string'                         => array($docs, $tests),
			'knplabs/gaufrette'                     => array($docs, $tests),
			'league/flysystem-cached-adapter'       => array($docs, $tests),
			'leezy/pheanstalk-bundle'               => array($docs, $tests),
			'lightsaml/sp-bundle'                   => array($docs, $tests),
			'lightsaml/symfony-bridge'              => array($docs, $tests),
			'maennchen/zipstream-php'               => array($docs, $tests),
			'maxmind-db/reader'                     => array('ext'),
			'misd/phone-number-bundle'              => array($docs, $tests),
			'mustangostang/spyc'                    => array($docs, $tests, 'php4/test.php4'),
			'noxlogic/ratelimit-bundle'             => array($docs, $tests),
			'oneup/uploader-bundle'                 => array($docs, $tests),
			'php-amqplib/rabbitmq-bundle'           => array($docs, $tests),
			'psr/log'                               => array($docs, $tests),
			'sendgrid/php-http-client'              => array($docs, $tests),
			'sendgrid/sendgrid'                     => array($docs, $tests),
			'sparkpost/sparkpost'                   => array($docs, $tests),
			'stack/run'                             => array($docs, $tests),
			'simshaun/recurr'                       => array($docs, $tests),
			'symfony/console'                       => array('Tester'),
			'symfony/doctrine-bridge'               => array($docs, $tests),
			'symfony/form'                          => array($docs, $tests),
			'symfony/framework-bundle'              => array($docs, $tests),
			'symfony/http-client-contracts'         => array($docs, $tests),
			'symfony/mime'                          => array($docs, $tests),
			'symfony/security-acl'                  => array($docs, $tests),
			'symfony/service-contracts'             => array($docs, $tests),
			'symfony/swiftmailer-bundle'            => array($docs, $tests),
			'symfony/translation-contracts'         => array($docs, $tests),
			'symfony/validator'                     => array($docs, $tests),
			'theofidry/psysh-bundle'                => array($docs, $tests),
			'willdurand/jsonp-callback-validator'   => array($docs, $tests),
			'willdurand/negotiation'                => array($docs, $tests),
		);
	}
}
