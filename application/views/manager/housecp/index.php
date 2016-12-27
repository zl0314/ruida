  <div class="set-area">
<?php $this->load->view('search_start') ?>    
<?php $this->load->view('search_title') ?>    
发布时间：<input type="text" id="start_time" name="start_time" class="input-txt Wdate"   onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd',readOnly:true})" value="<?=!empty($_GET['start_time']) ? request_get('start_time') : '';?>" >--
<input type="text"  class="input-txt Wdate" name="end_time" readonly="" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd',readOnly:true})"  value="<?=!empty($_GET['end_time']) ? request_get('end_time') : '';?>">

小区名：<input type="text"  value="<?=request_get('village')?>" name="village" class="input-txt w100" style="">
房产类型：<select name="type" id="" onchange="$('#searchForm').submit()">
  <option value="">全部</option>
  <?php foreach ($type as $key => $r): ?>
  <option value="<?php echo $key ?>" <?php if($key == request_get('type')){ echo 'selected';} ?>><?php echo $r; ?></option>
  <?php endforeach ?>
</select>

<?php if(request_get('type') == 1): ?>
  <select name="sales_type" id="">
    <option value="">全部</option>
    <option value="1" <?php if(1 == request_get('sales_type')){ echo 'selected';} ?>>出租</option>
    <option value="2" <?php if(2 == request_get('sales_type')){ echo 'selected';} ?>>出售</option>
  </select>
<?php endif; ?>

<br><br>
面积：<select name="acreage" id="">
  <option value="">全部</option>
  <option value="1" <?php if(1 == request_get('acreage')){ echo 'selected';} ?>>小于等于</option>
  <option value="2" <?php if(2 == request_get('acreage')){ echo 'selected';} ?>>大于等于</option>
</select>
  <input type="text"  value="<?=request_get('acreage_str')?>" name="acreage_str" class="input-txt w100" style="">

总价：<select name="total_price" id="">
  <option value="">全部</option>
  <option value="1" <?php if(1 == request_get('acreage')){ echo 'selected';} ?>>小于等于</option>
  <option value="2" <?php if(2 == request_get('acreage')){ echo 'selected';} ?>>大于等于</option>
</select>
  <input type="text"  value="<?=request_get('total_price_str')?>" name="total_price_str" class="input-txt w100" style="">


<?php $this->load->view('search_end') ?>    
    <br>

    <form method="post" id="form1" action="#">
      <table class="table table-s1" width="100%" cellpadding="0" cellspacing="0" border="0">
        <colgroup>
        </colgroup>
        <thead class="tb-tit-bg">
          <tr>
           <th><div class="th-gap"><input type="checkbox" onclick="selallck(this)"> </div></th> 

            <th><div class="th-gap">ID</div></th>
            <th><div class="th-gap">标题</div></th>
            <th><div class="th-gap">小区名称</div></th>
            <th><div class="th-gap">总价</div></th>
            <th><div class="th-gap">单价</div></th>
            <th><div class="th-gap">面积</div></th>
            <th><div class="th-gap">房产类型</div></th>

            <th><div class="th-gap">最后发布时间</div></th>
            <th><div class="th-gap">添加时间</div></th>
            <th><div class="th-gap">操作</div></th>
          </tr>
        </thead>
       
         <tfoot class="td-foot-bg">
          <tr>
            <td colspan=" "> 
           <input type="button" class="batch delect_batch" value="删 除" onclick="delitem('a', this)">
            <div class="pre-next"> <?php if(!empty($page_html)){ echo $page_html;}?></div></td>
          </tr>
        </tfoot>
        
        <tbody>
        <?php if( $list):?>
          <?php foreach( $list as $k => $v ):?>
          <tr>
            <td><input type="checkbox" value="<?php echo $v['id'];?>" ></td>

            <td><?php echo $v['id'];?></td>
            <td><?php echo $v['title'];?></td>
            <td><?php echo $v['village'];?></td>
            <td><?php echo $v['total_price'];?></td>
            <td><?php echo $v['unit_price'];?></td>
            <td><?php echo $v['acreage'];?></td>
            <td><?php echo $type[$v['type']];?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['fb_time']);?></td>
            
           
            <td><?php echo date('Y-m-d H:i:s' , $v['addtime']);?></td>
            <td>
              <a class="icon-edit" title="编辑" href="<?php echo site_url(sprintf('manager/'.$siteclass."/add/%s" , $v['id']));?>">编辑</a>

            <a class="icon-del" onclick="delitem('<?php echo $v['id']?>',this)"  title="删除" href="javascript:;">删除</a></td>
                
                </td>
          </tr>
          <?php endforeach;?>
       	
		<?php else:?>
        <tr>
            <td colspan="5"><div class="no-data">没有数据</div></td>
          </tr>
		<?php endif;?>
          
          
        </tbody>
      </table>
    </form>
  </div>
</div>
