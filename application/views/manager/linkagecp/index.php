
  <div class="set-area">
  <?php if(!empty($parent_linkage)): ?>
<div style="font-weight: bold;font-size:19px; margin:10px 0">
  所属城市　： <?php echo $parent_linkage['name'] ?>
</div>
<?php endif; ?>
    <form id="search" action="" method="get" class="searchform">
        名称：<input type="text" value="<?php echo request_get('name') ?>" name="name" class="input-txt w100" style="">	
		<input type="submit" value="查 询" class="input-btn w70" >
    </form>
    <form method="post" id="form1" action="#">
      <table class="table table-s1" width="100%" cellpadding="0" cellspacing="0" border="0">
      
        <thead class="tb-tit-bg">
          <tr>
            <!-- <th><div class="th-gap"><input type="checkbox" onclick="selallck(this)"> </div></th>  -->
            <th><div class="th-gap">ID</div></th>
            <th><div class="th-gap">城市名</div></th>
            <th><div class="th-gap">操作</div></th>
          </tr>
        </thead>
        <tfoot class="td-foot-bg">
          <tr>
            <td colspan="6">
           <!-- <input type="button" value="删 除" onclick="delitem('a', this)"> -->
           <div class="pre-next"> 
            <?php if(!empty($page_html)){ echo $page_html;}?></div></td>
          </tr>
        </tfoot>
        <tbody>
          <?php if( !empty( $list ) ):?>
          <?php foreach( $list as $k => $v ): $k++?>
          <tr id="item_<?=$v['id']?>">
          <!-- <td><input type="checkbox" value="<?php echo $v['id'];?>" >  </td> -->
            <td><?php echo $v['id'];?></td>
            <td><?php echo $v['name'];?></td>
            <td>
            <a  title="编辑" href="<?php echo site_url(sprintf('manager/'.$siteclass."/add/%s" , $v['id']));?>">编辑</a> | 
            <a  href="<?php echo site_url(sprintf('manager/'.$siteclass."/index/%s" , $v['id']));?>">子列表</a> | 
            <a  href="<?php echo site_url(sprintf('manager/'.$siteclass."/add?parentid=%s" , $v['id']));?>">添加子项目</a> | 
            <a   onclick="if( !confirm('您确定要删除？')){ return false;}"   href="<?php echo site_url(sprintf('manager/'.$siteclass."/del/%s" , $v['id']));?>"">删除</a>
            </td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan="6"><div class="no-data">没有数据</div></td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
    </form>
  </div>
</div>

