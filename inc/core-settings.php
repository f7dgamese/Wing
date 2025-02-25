<?php
// 主题设置选项
function theme_customize_register( $wp_customize ) {
	$category_checkbox = "";
	foreach ( get_categories() as $category ) {
		$category_checkbox .= '<label style="margin-right: 5px;"><input class="biji_setting_exclude" type="checkbox" value="' . $category->term_id . '" onchange="bijiHandleExcludeChange()">' . $category->name . '</label>';
	}
	$sections = [
		[
			"id"       => "biji_setting",
			"args"     => [
				'title'    => '主题设置',
				'priority' => 100,
			],
			"settings" => [
				[
					"id"      => "biji_setting_icp",
					"setting" => [ "default" => "" ],
					"control" => [
						'label' => '网站备案号',
					]
				],
				[
					"id"      => "biji_setting_cdn",
					"setting" => [ "default" => "" ],
					"control" => [
						'label' => '静态文件CDN',
						'type'  => 'url',
					]
				],
				[
					"id"      => "biji_setting_avatar",
					"setting" => [ "default" => "" ],
					"control" => [
						'label' => 'Gravatar地址',
						'type'  => 'url',
					]
				],
				[
					"id"      => "biji_setting_exclude",
					"setting" => [ "default" => "" ],
					"control" => [
						'label'       => '首页过滤分类',
						'description' => $category_checkbox . '
						<script>
							const biji_setting_exclude = jQuery("#_customize-input-biji_setting_exclude").hide();
							function bijiHandleExcludeChange(result = []) {
								jQuery(".biji_setting_exclude:checked").each(function() {
									result.push(this.value);
								});
								biji_setting_exclude.val(String(result)).trigger("input");
							}
						</script>',
						// 'input_attrs' => ['placeholder' => "例如：1, 2, 3"],
					]
				],
				[
					"id"      => "biji_setting_prettify",
					"setting" => [ "default" => true ],       // , "transport" => "postMessage"
					"control" => [
						'label'       => '开启代码高亮',
						'description' => '如安装了代码高亮插件，可以关闭此选项',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_lately",
					"setting" => [ "default" => true ],
					"control" => [
						'label'       => '开启时间格式化',
						'description' => '开启后文章时间显示为：XX前',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_view_image",
					"setting" => [ "default" => true ],
					"control" => [
						'label'       => '开启图片灯箱',
						'description' => '开启后文章图片可以使用灯箱放大查看',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_author_information",
					"setting" => [ "default" => true ],
					"control" => [
						'label'       => '开启作者信息栏',
						'description' => '文章结尾显示作者信息栏，支持点赞和二维码',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_adjacent_articles",
					"setting" => [ "default" => false ],
					"control" => [
						'label'       => '开启相邻文章',
						'description' => '文章结尾显示前一篇、后一篇文章',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_mode",
					"setting" => [ "default" => "auto" ],
					"control" => [
						'label'   => '主题色彩模式',
						'type'    => 'radio',
						'choices' => [
							'auto'    => "自适应",
							'default' => "标准",
							'dark'    => "暗黑",
//							'relax'   => "护眼",
						]
					]
				],
				[
					"id"      => "biji_setting_preview_update",
					"setting" => [ "default" => false ],
					"control" => [
						'label'       => '接收预览版更新',
						'description' => '率先体验新特性，可能存在一些未知问题，请提前备份好数据，以免造成不必要的损失',
						'type'        => 'checkbox',
					]
				],
			]
		],
		[
			"id"       => "biji_comment",
			"args"     => [
				'title'    => '评论设置',
				'priority' => 101,
			],
			"settings" => [
				[
					"id"      => "biji_setting_enc",
					"setting" => [ "default" => false ],
					"control" => [
						'label'       => '允许纯英文评论',
						'description' => '中文博客建议关闭纯英文评论',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_hyperlinks",
					"setting" => [ "default" => true ],
					"control" => [
						'label'       => '输出访客网站',
						'description' => '评论者的链接是否可以点击',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_autoload",
					"setting" => [ "default" => false ],
					"control" => [
						'label'       => '评论自动加载',
						'description' => '进入文章自动加载第一页评论',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_rolling",
					"setting" => [ "default" => true ],
					"control" => [
						'label'       => '评论滚动加载',
						'description' => '滚动到底部自动加载下一页评论',
						'type'        => 'checkbox',
					]
				],
				[
					"id"      => "biji_setting_placeholder",
					"setting" => [ "default" => "Comment" ],
					"control" => [
						'label' => '评论占位消息',
					]
				],
				[
					"id"      => "biji_setting_bark",
					"setting" => [ "default" => "" ],
					"control" => [
						'label'       => 'Bark Key',
						'description' => '有新的评论时通过 <a href="https://github.com/Finb/Bark" target="_blank">Bark</a> 通知你',
					]
				],
				[
					"id"      => "biji_setting_friend",
					"setting" => [ "default" => "" ],
					"control" => [
						'label'       => '认证读者',
						'description' => '填入邮箱地址，每行一条',
						'type'        => 'textarea',
					]
				]
			]
		]
	];

	foreach ( $sections as $section ) {
		$wp_customize->add_section( $section["id"], $section["args"] );
		foreach ( $section["settings"] as $item ) {
			$wp_customize->add_setting( $item["id"], $item["setting"] );
			$wp_customize->add_control( $item["id"], array_merge( $item["control"], [ "section" => $section["id"] ] ) );
		}
	}
}

add_action( 'customize_register', 'theme_customize_register' );

// End of page.
