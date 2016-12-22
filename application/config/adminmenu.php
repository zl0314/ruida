<?php
/**
 * @author		ZhangLong
 * @since		version - 2015-7-4
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| 管理员导航菜单、权限
|--------------------------------------------------------------------------
*/

$ADMIN_MENU = array(
	'menu' => array(
		/*===========TOP菜单 首页 ===========*/
		array(
			'id' => 'index',
			'name' => '首页',
			'status' => 1,
			'lists' => array(
				'admincp' => array(
				
					'name' => '首页',
					'status' => 1,
					'method' => array(
						'index' => array(
							'name' => '首页',
							'status' => 0
						),
						'center' => array(
							'name' => '系统信息',
							'status' => 1
						),
						'logout' => array(
							'name' => '退出登陆',
							'status' => 0
						)

					)
				),
				'settingcp' => array(
							'name' => '系统设置',
							'status' => 1,
							'method' => array(
								'system' => array(
										'name' => '系统设置',
										'status' => 1
								)
							),
					),
					'adcp' => array(
				
					'name' => '广告管理',
					'status' => 1,
					'method' => array(
						'index' => array(
							'name' => '广告列表',
							'status' => 1
						),
						'add' => array(
							'name' => '广告编辑',
							'status' => 1
						),
						
						'del' => array(
							'name' => '广告删除',
							'status' => 0
						)
					)
				),
				'newscp' => array(
				
					'name' => '新闻管理',
					'status' => 1,
					'method' => array(
						'index' => array(
							'name' => '新闻列表',
							'status' => 1
						),
						'add' => array(
							'name' => '新闻添加',
							'status' => 1
						),
						'edit' => array(
							'name' => '新闻编辑',
							'status' => 0
						),
						'del' => array(
							'name' => '新闻删除',
							'status' => 0
						)
					)
				),
				'pagescp' => array(
						'name' => '单页面管理',
						'status' => 1,
						'method' => array(
								'index' => array(
										'name' => '单页面列表',
										'status' => 1
								),
								'add' => array(
										'name' => '编辑单页面',
										'status' => 1
								),
								'del' => array(
										'name' => '删除',
										'status' => 0
								),
						),
				),

			'friend_linkcp' => array(
			
				'name' => '友情链接管理',
				'status' => 1,
				'method' => array(
					'index' => array(
						'name' => '友情链接列表',
						'status' => 1
					),
					'add' => array(
						'name' => '友情链接添加',
						'status' => 1
					),
					'del' => array(
						'name' => '删除',
						'status' => 0
					)
				)
			),
		
		),
),

/*===========TOP菜单 会员中心 ===========*/
		array(
			'id' => 'member_center',
			'name' => '用户管理',
			'status' => 1,
			'lists' => array(
				'adminusercp' => array(
					'name' => '管理员管理',
					'status' => 1,
					'method' => array(
						'index' => array(
							'name' => '管理员列表',
							'status' => 1
						),
						'add' => array(
							'name' => '添加管理员',
							'status' => 1
						),
						'updpass' => array(
							'name' => '修改密码',
							'status' => 1
						),
						'del' => array(
							'name' => '删除',
							'status' => 0
						),
						'right' => array(
							'name' => '权限设置',
							'status' => 0
						)
					)
				),
				'usercp' => array(
					'name' => '会员管理',
					'status' => 1,
					'method' => array(
						'index' => array(
							'name' => '会员列表',
							'status' => 1
						),
						'edit' => array(
							'name' => '编辑会员',
							'status' => 0
						),
						'del' => array(
							'name' => '删除',
							'status' => 0
						),
					),
				),
				
			),
		),
		
/*===========TOP菜单 房源管理 ===========*/
		array(
			'id' => 'housecp',
			'name' => '房源管理',
			'status' => 1,
			'lists' => array(
				'housecp' => array(
					'name' => '房源管理',
					'status' => 1,
					'method' => array(
						'index' => array(
							'name' => '房源列表',
							'status' => 1
						),
						'add' => array(
							'name' => '房源添加',
							'status' => 1
						),
						'del' => array(
							'name' => '删除',
							'status' => 0
						),
					)
				),
				
			),
		),

		/*===========在这上面添加一级TOP菜单 ===========*/
		/**
		 * 模板
		 *
		 * array(
		'id' => '元素ID ',
		'name' => 'TOP菜单名称',
		'status' => 1,
		'lists' => array(
		'tradecp' => array(
		'name' => '栏目名',
		'status' => 1,
		'method' => array(
		'index' => array(
		'name' => '方法名',
		'status' => 1 //1显示   0 不显示
		),
		),
		),
		)
		)
		 */
	),
);