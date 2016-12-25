
  <div class="set-area">
    <form method="post" id="form1" action="#">
      <table class="table table-s1" width="100%" cellpadding="0" cellspacing="0" border="0">
        <colgroup>
        </colgroup>
        <thead class="tb-tit-bg">
          <tr>
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
            <td colspan="5"><div class="pre-next"> <?php echo $page_html;?></div></td>
          </tr>
        </tfoot>
        <tbody>
        <?php if( $list):?>
          <?php foreach( $list as $k => $v ):?>
          <tr>
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

            	<a class="icon-del" onclick="if( !confirm('您确定要删除？')){ return false;}"  title="删除" href="<?php echo site_url( sprintf($siteclass."/del/%s" , $v['id']));?>">删除</a>
                
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
