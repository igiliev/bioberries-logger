<?php
/**
 * Project information shared by abilities and future REST endpoints.
 */

namespace Bioberries\Sales;

defined( 'ABSPATH' ) || exit;

final class Project_Service {

	public static function get_info(): array {
		return array(
			'project'   => 'Bioberries Sales Hub',
			'version'   => '0.1.0',
			'milestone' => 'First custom read-only MCP ability',
		);
	}
}
