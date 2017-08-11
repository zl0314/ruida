
  <div class="set-area"> 
     <form id="search" action="" method="get" class="searchform">
        用户名：<input  type="text" value="<?=!empty($search['username']) ? $search['username'] : ''?>" name="username" class="input-txt w100" style="">	
	真实姓名：<input type="text" value="<?=!empty($search['realname']) ? $search['realname'] : ''?>" name="realname" class="input-txt w100" style="">	
  手机号：<input type="text" value="<?=!empty($search['mobile']) ? $search['mobile'] : ''?>" name="mobile" class="input-txt w100" style=""> 
	
		<input type="submit" value="查 询" class="input-btn w70" >
    </form>
    
    <form method="post" id="form1" action="#">
    
      <table class="table table-s1" width="100%" cellpadding="0" cellspacing="0" border="0">
        
        <thead class="tb-tit-bg">
        
          <tr>
         <th><div class="th-gap"><input type="checkbox" onclick="selallck(this)"> </div></th>
            <th><div class="th-gap">ID</div></th>
            <th><div class="th-gap">手机号</div></th>
             <th><div class="th-gap">注册时间</div></th>

            <th><div class="th-gap">操作</div></th>
          </tr>
        </thead>
        <tfoot class="td-foot-bg">
          <tr>
            <td colspan="10">
          
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
            <td><?php echo $v['id'];?></td>
            <td> <?php echo $v['mobile'];?></td>
            <td><?php echo date('Y-m-d H:i:s' , $v['addtime']);?></td>

            <td>
	
            <a  onclick="delitem('<?php echo $v['id']?>',this)"  title="删除" href="javascript:;">删除</a>
            
            </td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan="10><div class="no-data">没有数据</div></td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
    </form>
  </div>
</div>

