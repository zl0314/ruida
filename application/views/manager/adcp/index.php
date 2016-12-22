
  <div class="set-area">
    <form id="search">
    位置：	
	<select name="pos" onchange="$('#search').submit()">

	<option value="" <?=$pos == '' ? 'selected' : ''?>>所有位置</option>
	 <?php
             foreach( $posArr as $k => $v ):
            ?>
            <option <?php if ( $k == $pos ) {echo 'selected';}else{echo '';}?> value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php endforeach;?>
	</select>
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
            <th><div class="th-gap">编号</div></th>
            <th><div class="th-gap">位置</div></th>
          
            <th><div class="th-gap">链接</div></th>
            <th><div class="th-gap">图片</div></th>
          
            <th><div class="th-gap">添加时间</div></th>
            <!-- <th><div class="th-gap">排序</div></th> -->
            <th><div class="th-gap">操作</div></th>
          </tr>
        </thead>
        <tfoot class="td-foot-bg">
          <tr>
            <td colspan=" <?php if(request_get('pos') == 'index-index'):?> 9 <?php else:?>8<?php endif;?>"> 
           <input type="button" class="batch delect_batch" value="删 除" onclick="delitem('a', this)">
            <!-- <input type="button" class="batch listorder_batch" value="排 序" onclick="listorder()">  -->
            <div class="pre-next"> <?php if(!empty($page_html)){ echo $page_html;}?></div></td>
          </tr>
        </tfoot>
        <tbody>
          <?php if( !empty($list) ):?>
          <?php foreach( $list as $k => $v ): $k++?>
          <tr id="item_<?php echo $v['id']?>">
            <td><input type="checkbox" value="<?php echo $v['id'];?>" ></td>
            <td><?php echo $k;?></td>
            <td><?php
            if($v['poscontent']){
				echo @$posArr[$v['pos'].'|'.$v['poscontent']];	
			}else{
				echo @$posArr[$v['pos']];
			}
            
            
            ?></td>
           
            <td><a href="<?php echo $v['url']?>" target="_blank"><?php echo $v['url'];?></a></td>
            <td><a href="<?php echo $v['pic']?>" class="itempic" target="_blank">查看</a></td>
          
            
            <td><?php echo date('Y-m-d H:i:s' , $v['addtime']);?></td>
            <!-- <td><input type="text" class="short_txt" itemid="<?php echo $v['id']?>" name="listorder[<?php echo $v['id']?>]" value="<?=$v['listorder']?>" <?php echo $v['listorder'];?></td> -->
            <td>
			<a class="icon-edit" title="编辑" href="<?php echo site_url(sprintf('manager/'.$siteclass."/add/%s" , $v['id']));?>">编辑</a>
			 <a class="icon-del" onclick="delitem('<?php echo $v['id']?>',this)"  title="删除" href="javascript:;">删除</a></td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan=" <?php if(request_get('pos') == 'index-index'):?> 9 <?php else:?>8<?php endif;?>"><div class="no-data">没有数据</div></td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
    </form>
  </div>
</div>