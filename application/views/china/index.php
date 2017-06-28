<script type="text/javascript" src="/static/web/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="/static/web/js/blocksit.min.js"></script>

<!-- ========main======= -->
<div class="qgdc_banner"></div>
<div id="wrapper">
    <div id="container">
        <?php foreach ($list as $key => $r): ?>
        	
        <div class="grid">
            <a href="<?=site_url('/house?t=5&province_id='.$r['city_id'])?>">
                <div class="imgholder"><img class="lazy" src="/static/web/images/blank.gif" data-original="<?=$r['pic']?>" width="258" /></div>
                <strong><?=$r['city_name']?></strong>
            </a>
        </div>
        <?php endforeach ?>
        
    </div>
    <!-- <div class="dc_more">
        <a href="javascript:;">
            加载更多...
        </a>
    </div> -->
</div> 

<script type="text/javascript">
    $(function(){
        $("img.lazy").lazyload({        
            load:function(){
                $('#container').BlocksIt({
                    numOfCol:5,
                    offsetX: 8,
                    offsetY: 8
                });
            }
        });       
        //window resize
        var currentWidth = 1100;
        $(window).resize(function() {
            var winWidth = $(window).width();
            var conWidth;
            if(winWidth < 660) {
                conWidth = 440;
                col = 2
            } else if(winWidth < 880) {
                conWidth = 660;
                col = 3
            } else if(winWidth < 1100) {
                conWidth = 880;
                col = 4;
            } else {
                conWidth = 1100;
                col = 5;
            }
            
            if(conWidth != currentWidth) {
                currentWidth = conWidth;
                $('#container').width(conWidth);
                $('#container').BlocksIt({
                    numOfCol: col,
                    offsetX: 8,
                    offsetY: 8
                });
            }
        });
    });
</script>