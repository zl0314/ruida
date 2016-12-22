<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 公共Model 
 * @auther Wellben wellben@126.com
 * @version 2013-12-28
 */
class MY_Model extends CI_Model
{
	protected $master ;
	protected $slave ;
	public $table ;
	
	/**
	 * 加载读写数据库
	 * @auther Wellben wellben@126.com
	 * @version 2013-12-28
	 */
	function __construct()
	{
		parent::__construct() ;
		$this->db = $this->slave = $this->master = $this->load->database('default' , TRUE);
		$this->table = DB_PREFIX . $this->table;
	}
	
	public function save( $data )
	{
		if( empty( $data ['id']))
		{
			$id = $this->insertData( $data , TRUE );
		}
		else
		{
			$this->updateData( $data , array('id' => $data['id'] ) );
			$id = $data['id'];
		}
		return $id;
	}
	
	/**
	 * ----------------------------------------------------
	 * 获取数据列表 
	 * ----------------------------------------------------
	 * @param $field(string)(array) 查询字段
	 * @param $where (array) 查询数组
	 * @param $limit(int) 查询条数
	 * @param $offset(int) 开始位置
	 * @param $order(string) 排序
	 * @auther Wellben wellben@126.com
	 * @version 2013-12-28
	 */
	public function getList( $field = '*' , $where = array() , $limit = 1 , $offset = Null , $order = '' , $group = '')
	{
		$this->slave->from( $this->table );
		$this->slave->select( $field );
		$this->like( $where );
		$this->_in( $where );
		$this->_or( $where );
		$this->slave->where( $where );
		if(intval( $limit ) > 0){
			$this->slave->limit( $limit , $offset);
		}
	
		if( !empty( $order))
		{
			$this->slave->order_by( $order);
		}
		if( !empty( $group ))
		{
			$this->slave->group_by( $group );
		}
		$rec = $this->slave->get();
		//echo $this->slave->last_query();
		return $rec->result_array();
	}
	
	/**
	 * ----------------------------------------------------------------
	 * 多表关联查多条数据
	 * ----------------------------------------------------------------
	 * @param $tables (array) array('goods' => 'goods' ,'库名'	=> '别名');
	 * @param $join (array) array('goods.goods_id = detail.goods_id');
	 * @param $field (array) 查询字符串 goods.id
	 * @param $where (array) 查询条件  array('goods.goods_id' => 1)
	 * @param $limit (int) 查询条数
	 * @param $offset (int) 偏移量
	 * @param $order (string)排序
	 * @return (array) 二维数组
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function getJoinList( $tables , $join , $field = "*" , $where , $limit = 1 , $offset = 0 , $order = NULL ,  $group = NULL)
	{
		$this->slave->select($field);
		$i = 0;
		foreach( $tables as $k => $v){
			if( $i == 0){
				$this->slave->from( $k." As ".$v);
			}else{
				$this->slave->join( $k." As ".$v , $join[$i-1] , 'left');
			}
			$i++;
		}
		$this->slave->where($where );
		$this->slave->limit($limit , $offset);
		if(isset($order)){
			$this->slave->order_by($order);
		}
		if( !empty( $group ))
		{
			$this->slave->group_by( $group );
		}
		$query = $this->slave->get();
		//echo $this->slave->last_query();
		return $query->result_array();
	}
	
	/**
	 *
	 * 模糊搜索	
	 * @param $where (array) 模糊搜索条件  array('or_where' => array('username' => $data['key']),);
	 * @modify		
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function like( &$where )
	{
		if( isset($where['search']) && !empty($where['search']) && is_array($where['search']))
		{
			foreach( $where['search'] as $k => $v)
			{
				foreach( $v as $key => $val)
				{
					$k = trim( $k );
					$this->slave->$k($key , $val);
				}
			}
			unset( $where['search']);
		}
	}
	
	/**
	 * IN搜索
	 * @param $where (array) 模糊搜索条件  $where['in'] = array('userid' => $ids);
	 * @author		ZhangLong
	 * @date		2013-7-22
	 */
	public function _in( &$where ){
		if(isset($where['in']) && !empty($where['in']) && is_array($where['in'])){
			foreach ($where['in'] as $k => $v){
				$this->slave->where_in($k, $v);
			}
			unset($where['in']);
		}
	}
	
	/**
	 * OR搜索
	 * @param $where (array) 模糊搜索条件 $where['or'] = array('userid' => '1', 'username' => 'c');
	 * @author		ZhangLong
	 * @date		2013-7-22
	 */
	public function _or( &$where ){
		if(isset($where['or']) && !empty($where['or']) && is_array($where['or'])){
			foreach ($where['or'] as $k => $v){
				if(is_array($v)){
					foreach($v as $ork => $orv){
						$this->slave->or_where($k, $orv);
					}
				}else{
					$this->slave->or_where($k, $v);
				}
			}
			unset($where['or']);
		}
	}
	
	
	/**
	 * --------------------------------------------------
	 * 获取一条数据
	 * ---------------------------------------------------
	 * @param $field(string)(array) 查询字段
	 * @param $where (array) 查询数组
	 * @param $order(string) 排序描述			
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function getRow(  $field = '*' , $where = array() , $order = '',$distinct=false )
	{
		$this->slave->from( $this->table );
		$this->slave->select( $field );
		if($distinct){
			$this->slave->distinct();
		}

		$this->like( $where );
		$this->_in( $where );
		$this->_or( $where );
		$this->slave->where( $where );
		$this->slave->limit( 1 );
		if( !empty( $order))
		{
			$this->slave->order_by( $order);
		}
		$rec = $this->slave->get();
		//echo $this->slave->last_query();
		return $rec->row_array();
	}
	
	/**
	 * --------------------------------------------------
	 * 获取一条数据
	 * ---------------------------------------------------
	 * @param $field(string)(array) 查询字段
	 * @param $where (array) 查询数组
	 * @param $order(string) 排序描述
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function getOne(  $field = '*' , $where = array() , $order = '',$distinct=false )
	{
	 $result = $this->getRow( $field , $where , $order,$distinct);
		
		if( !empty($result))
		{
			foreach($result as $k => $v  )
			{
				return $v;
			}
		}
		
		return '';
	}
	
	/**
	 * --------------------------------------------------
	 * 获取一条数据
	 * ---------------------------------------------------
	 * @param $field(string)(array) 查询字段
	 * @param $where (array) 查询数组
	 * @param $order(string) 排序描述
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function getJoinOne( $tables , $join , $field = "*" , $where  , $order = NULL )
	{
		$result = $this->getJoinRow( $tables , $join , $field , $where , $order);
	
		foreach($result as $k => $v  )
		{
			return $v;
		}
		return '';
	}
	
	/**
	 *----------------------------------------------------------------
	 * 多表关联查询一条数据
	 * ---------------------------------------------------------------
	 * @param $tables (array) array('goods' => 'goods' ,'库名'	=> '别名');
	 * @param $join (array) array('goods.goods_id = detail.goods_id');
	 * @param $field (array) 查询字符串 goods.id
	 * @param $where (array) 查询条件  array('goods.goods_id' => 1)
	 * @param $order (string)排序
	 * @return (array) 一维数组
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function getJoinRow( $tables , $join , $field = "*" , $where  , $order = NULL )
	{
		$this->slave->select($field);
		$i = 0;
		foreach( $tables as $k => $v){
			if( $i == 0){
				$this->slave->from( $k." As ".$v);
			}else{
				$this->slave->join( $k." As ".$v , $join[$i-1] , 'left');
			}
			$i++;
		}
		$this->slave->where($where );
		$this->slave->limit( 1 );
		if(isset($order)){
			$this->slave->order_by($order);
		}
		$query = $this->slave->get();
		//echo $this->slave->last_query();
		return $query->row_array();
	}
	/**
	 * 修改某一字段值-递增递减 
	 * @auther Wellben wellben@126.com
	 * @version 2014-2-9
	 */
	public function setFile( $data , $where )
	{
		$this->master->where( $where );
		foreach ($data as $k => $v ){
			$this->master->set($k , $v, FALSE);	
		}
		return $this->master->update($this->table );
	}
	/**
	 *
	 * 插入数据
	 * @param $data (array) 添加的数据
	 * @param $new_id (Bool) 是否返回ID
	 * @return (bool)(int) 返回 Bool 或 插入 自增ID
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function insertData( $data , $new_id = FALSE )
	{
		$rec = $this->master->insert( $this->table , $data);
		//echo $this->master->last_query();exit;
		if( $rec && $new_id){
			return $this->master->insert_id();
		}
		return $rec;
	}

	/***
	 * @param $data
	 * @return mixed
	 * @author wangsy
	 * @date 2015-10-19
	 */
	public function insert_batch( $data )
	{
		$result = $this->db->insert_batch($this->table, $data);
// 		echo $this->db->last_query();
		return $result;
	}
	
	/**
	 *
	 * 插入数据
	 * @param $data (array) 添加的数据
	 * @param $new_id (Bool) 是否返回ID
	 * @return (bool)(int) 返回 Bool 或 插入 自增ID
	 * @author	wangsy
	 * @date		2013-12-30
	 */
	public function insertDatatotable( $data , $new_id = FALSE ,$table='')
	{
	    $table = $table ? $table : $this->table;
	    $rec = $this->master->insert( $table , $data);
	    //echo $this->master->last_query();exit;
	    if( $rec && $new_id){
	        return $this->master->insert_id();
	    }
	    return $rec;
	}
	
	function saveData( $data )
	{
		if( empty( $data['id']))
		{
			$data['id'] = $this->insertData( $data , true);
		}
		else
		{
			$where = array(
				'id' => $data['id'], 
			);
			$this->updateData($data, $where);
		}
		return $data['id'];
	}
	
	/**
	 *----------------------------------------------------------
	 * 编辑数据库条目
	 * ---------------------------------------------------------
	 * @param $where (array) 条件
	 * @param $data (array) 更新数据			
	 * @return (bool)
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function updateData( $data ,$where  )
	{
		return $this->master->update( $this->table ,$data , $where );
	}
	
	/**
	 *---------------------------------------------
	 * 物理删除数据			
	 * -------------------------------------------
	 * @param $where 删除where条件
	 * @return bool
	 * @author		Weibin Li <weibin_li@126.com>
	 * @date		2013-12-30
	 */
	public function delData( $where )
	{
		$r =  $this->master->delete( $this->table , $where );
		//echo $this->master->last_query();
		return $r;
	}
	
	public function last_query( $table = 'slave')
	{
		$table = ( $table == 'slave')?'slave':'master';
		return $this->$table->last_query();
	}
	
	
	public function __destruct(){
		if(DBLOG){
			$query = $this->get_queries();
			$dblog_path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.'db'; 
			$logfile = date('Y_m_d_H').'.log';
			$write_file = $dblog_path.DIRECTORY_SEPARATOR.$logfile;
			creat_dir_with_filepath($write_file);
			
			
			foreach($query as $k => $sql){
				$sql = str_replace(array("\r","\n"), ' ', $sql);
				@file_put_contents($write_file, date('Y-m-d H:i:s').' '.$sql."\r\n\r\n", FILE_APPEND);
			}
		}
	}
	/**
	 * 得到所有查询语句
	 * @param book $dump 是否在页面直接打印
	 * @return array $queries
	 */
	public function get_queries($dump = false){
		$queries = array();
		if(!empty($this->slave->queries)){
			$queries = $this->slave->queries;
			if($dump){
				Dump($this->slave->queries);
			}
		}
		return $queries;
	}
	
	public function query($sql){
	    $r = $this->slave->query($sql);
	    return $r;
	} 
	
}
/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */