
  <div class="set-area">
    <form id="search">
    类型：	
	<select name="type" onchange="$('#search').submit()">
	<option value="" >全部</option>
	<option value="1" <?php if(request_get('type') == 1): ?> selected <?php endif;?> >委托找房</option>
	<option value="2"  <?php if(request_get('type') == 2): ?> selected <?php endif;?> >投放房源</option>
	</select>

	手机号：<input type="text"  value="<?=request_get('mobile')?>" name="mobile" class="input-txt w100" style="">
	Email：<input type="text"  value="<?=request_get('email')?>" name="email" class="input-txt w100" style="">
		<input type="submit" value="提 交" class="input-button input_btn">
    </form>
    <br>
    <form method="post" id="form1" action="#">
      <table class="table table-s1" width="100%" cellpadding="0" cellspacing="0" border="0">
        <colgroup>
        <col class="w90">
        <col class="w160">
       <col class="w160">
 
        <col class="w170">
        <col class="">
        </colgroup>
        
        <thead class="tb-tit-bg">
          <tr>
        	 <th><div class="th-gap"><input type="checkbox" onclick="selallck(this)"> </div></th> 
            <th><div class="th-gap">ID</div></th>
            <th><div class="th-gap">手机</div></th>
          
            <th><div class="th-gap">咨询类型</div></th>
            <th><div class="th-gap">邮箱</div></th>
          
            <th><div class="th-gap">添加时间</div></th>
            <th><div class="th-gap">操作</div></th>
          </tr>
        </thead>
        <tfoot class="td-foot-bg">
          <tr>
            <td> 
           <input type="button" class="batch delect_batch" value="删 除" onclick="delitem('a', this)">
            <div class="pre-next"> <?php if(!empty($page_html)){ echo $page_html;}?></div></td>
          </tr>
        </tfoot>
        <tbody>
          <?php if( !empty($list) ):?>
          <?php foreach( $list as $k => $v ): $k++?>
          <tr id="item_<?php echo $v['id']?>">
            <td><input type="checkbox" value="<?php echo $v['id'];?>" ></td>
            <td><?php echo $v['id'];?></td>
            <td><?php echo  $v['mobile'] ?></td>
            <td><?php echo  $v['type'] == 1 ? '委托找房' : '投放房源' ?></td>
            <td><?php echo  $v['email'] ?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['addtime']);?></td>
            <td>
			 <a class="icon-del" onclick="delitem('<?php echo $v['id']?>',this)"  title="删除" href="javascript:;">删除</a></td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td ><div class="no-data">没有数据</div></td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
    </form>
  </div>
</div>