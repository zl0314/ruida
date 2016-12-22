
  <div class="set-area">
    
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
            <th><div class="th-gap">标题</div></th>
             <th><div class="th-gap">添加时间</div></th>
            <th><div class="th-gap">链接地址</div></th>
            <th><div class="th-gap">排序</div></th>
             <th><div class="th-gap">显示</div></th>
            <th><div class="th-gap">操作</div></th>
          </tr>
        </thead>
        <tfoot class="td-foot-bg">
          <tr>
            <td colspan="8"> <input type="button" value="排 序"onclick="listorder('listorder')"> 
           <input type="button" value="删 除" onclick="delitem('a', this)"> 
           <div class="pre-next"> 
            <?php if(!empty($page_html)){ echo $page_html;}?></div></td>
          </tr>
        </tfoot>
        <tbody>
          <?php if( !empty( $list ) ):?>
          <?php foreach( $list as $k => $v ): $k++?>
          <tr id="item_<?=$v['id']?>">
		 <td><input type="checkbox" value="<?php echo $v['id'];?>" ></td> 
            <td><?php echo $k;?></td>
            <td><?php echo $v['name'];?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['addtime']);?></td>
             <td><a href="<?php echo $v['link_url'];?>" target="_blank"><?php echo $v['link_url'];?></a></td>
            <td><input type="text" class="short_txt" itemid="<?php echo $v['id']?>" name="listorder[<?php echo $v['id']?>]" value="<?=$v['listorder']?>" <?php echo $v['listorder'];?></td>
           <td><?php if($v['isshow'] == 1){ echo '显示';}else{ echo '不显示';}?></th>
            <td><a class="icon-edit" title="编辑" href="<?php echo site_url('manager/'.sprintf($siteclass."/add/%s" , $v['id']));?>">编辑</a> <a class="icon-del" onclick="delitem('<?php echo $v['id']?>',this)"  title="删除" href="javascript:;">删除</a></td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan="8"><div class="no-data">没有数据</div></td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
    </form>
  </div>
</div>

