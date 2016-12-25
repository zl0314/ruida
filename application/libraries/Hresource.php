<?php
/**
 * 房源  标签、用途、位置,户型
 */
class Hresource{
	//位置
	public static function get_position($type = 1){
		$arr = array(
			'1' => '行政区域',
			'3' => '商圈',
			'3' => '地铁线',
			'4' => '学校'
		);
		return $arr;
	}

	//面积区间
	public static function get_acreage($type = 1){
		//类型 1商业地产 2投资地产 3学区房/豪宅 4新房

		$arr = array(
			'1' => array(
				'1' => '100平米以下',
				'2' => '100-300',
				'3' => '300-500',
				'4' => '500-1000',
				'5' => '1000平以上',
			),
			'3' => array(
				'1' => '50平米以下',
				'2' => '50-80',
				'3' => '80-100',
				'4' => '100-150',
				'5' => '150-300',
				'6' => '500平以上',
			)
		);
		return !empty( $arr[$type] ) ? $arr[$type] : $arr;
	}

	//价格区间
	public static function get_prices($type = 1){
		//类型 1商业地产 2投资地产 3学区房/豪宅 4新房
		$arr =  array(
			'1' => array(
				'1' => '300万以下',
				'2' => '300-500万',
				'3' => '500-1000万',
				'4' => '1000-2000万',
				'5' => '2000万以上',
			),
			'2' => array(
				'1' => '3元/平米·天以下',
				'2' => '3-4元',
				'3' => '4-5元',
				'4' => '5-6元',
				'5' => '6-8元',
				'6' => '8-10元',
				'7' => '10元以上',
			),
			'3' => array(
				'1' => '500万以下',
				'2' => '500-700万',
				'3' => '700-1000万',
				'4' => '1000-1500万',
				'5' => '1500万以上',
			),
			'4' => array(
				'1' => '100万以下',
				'2' => '100-150万',
				'3' => '150-200万',
				'4' => '200-250万',
				'5' => '250-300万',
				'6' => '300-500万',
				'7' => '500万以上',
			)
		);
		return !empty( $arr[$type] ) ? $arr[$type] : $arr;
	}

	//用途
	public static function get_functionality($type = 1){
		//1商业地产 2投资地产 3学区房/豪宅 4新房
		$arr = array(
			'1' => array(
				'1' => '写字楼',
				'2' => '底商',
				'3' => '独栋',
				'4' => '四合院',
			),
			'2' => array(
				'1' => '写字楼',
				'2' => '住宅',
				'3' => '底商',
				'4' => '独栋',
				'5' => '四合院',
			)
		);
		return !empty( $arr[$type] ) ? $arr[$type] : $arr;
	}

	//得到房型 
	public static function get_htype(){
		return array(
			'1' => '一室',
			'2' => '二室',
			'3' => '三室',
			'4' => '四室',
			'5' => '五室',
			'6' => '五室以上',
		);
	}

	//标签
	public static function get_label(){
		return array(
			'1' => '高回报率',
			'2' => '低单价',
			'3' => '高升值空间',
			'4' => '稀缺性房产',
		);
	}
	
	//朝向
	public static function get_chaoxiang(){
		return array(
			'1' => '朝南',
			'2' => '朝北',
			'3' => '朝东',
			'4' => '朝西',
			'5' => '南北朝向'
		);
	}
	
	//是否有电梯
	public static function get_dianti(){
		return array(
			'1' => '有电梯',
			'2' => '无电梯',
		);
	}
	//装修程度
	public static function get_zhuangxiu(){
		return array(
			'1' => '毛坯',
			'2' => '简装',
			'3' => '中等装修',
			'4' => '精装修',
		);
	}
	
	//房源类型
	public static function get_house_type(){
		return array(
			'1' => '商业地产',
			'2' => '投资地产',
			'3' => '学区房/豪宅',
			'4' => '新房',
		);
	}
	//出租出售
	public static function get_sales_type(){
		return array(
			'1' => '出租',
			'2' => '出售',
		);
	}
}