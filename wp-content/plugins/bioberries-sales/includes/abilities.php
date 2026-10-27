<?php
/**
 * Register the project's first WordPress ability and expose it through MCP.
 */

namespace Bioberries\Sales;

defined( 'ABSPATH' ) || exit;

add_action(
	'wp_abilities_api_categories_init',
	static function (): void {
		wp_register_ability_category(
			'bioberries',
			array(
				'label'       => 'Bioberries',
				'description' => 'Mushroom sales management abilities.',
			)
		);
	}
);

add_action(
	'wp_abilities_api_init',
	static function (): void {
		wp_register_ability(
			'bioberries/get-project-info',
			array(
				'label'               => 'Get Bioberries Project Information',
				'description'         => 'Returns the Bioberries plugin version and current learning milestone. Does not read customer data or change any records.',
				'category'            => 'bioberries',
				'input_schema'        => array(
					'type'                 => 'object',
					'properties'           => new \stdClass(),
					'additionalProperties' => false,
				),
				'output_schema'       => array(
					'type'                 => 'object',
					'properties'           => array(
						'project'   => array( 'type' => 'string' ),
						'version'   => array( 'type' => 'string' ),
						'milestone' => array( 'type' => 'string' ),
					),
					'required'             => array( 'project', 'version', 'milestone' ),
					'additionalProperties' => false,
				),
				'permission_callback' => static function (): bool {
					// A basic capability is sufficient for this non-sensitive demo.
					return current_user_can( 'read' );
				},
				'execute_callback'    => array( Project_Service::class, 'get_info' ),
				'meta'                => array(
					'mcp'         => array(
						'public' => true,
						'type'   => 'tool',
					),
					'annotations' => array(
						'readonly'    => true,
						'destructive' => false,
						'idempotent'  => true,
					),
				),
			)
		);
	}
);
