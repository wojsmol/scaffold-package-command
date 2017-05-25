<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

$registration = function () {
	$autoload = dirname( __FILE__ ) . '/vendor/autoload.php';
	if ( file_exists( $autoload ) ) {
		require_once $autoload;
	}

	WP_CLI::add_command( 'scaffold package', array( 'WP_CLI\ScaffoldPackageCommand', 'package' ) );
	WP_CLI::add_command( 'scaffold package-readme', array( 'WP_CLI\ScaffoldPackageCommand', 'package_readme' ) );
	WP_CLI::add_command( 'scaffold package-tests', array( 'WP_CLI\ScaffoldPackageCommand', 'package_tests' ) );
	WP_CLI::add_command( 'scaffold package-github', array( 'WP_CLI\ScaffoldPackageCommand', 'package_github' ) );
};

// Only use command hooks in versions that support them.
$wp_cli_version = preg_replace( '#-alpha(.+)#', '-alpha', WP_CLI_VERSION );
if ( version_compare( $wp_cli_version, '1.2.0-alpha', '>=' ) ) {
	WP_CLI::add_hook( 'after_add_command:scaffold', $registration );
} else {
	$registration();
}
