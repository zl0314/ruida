function noMsg(){
    $.msgbox.show({
        message: '已取消收藏此项目',
        icon: 'no',
        timeOut: 1000
    });
}
function okMsg(){
    $.msgbox.show({
        message: '已收藏此项目',
        icon: 'ok',
        timeOut: 1000
    });
}
$(function(){
	$(".scbtn").hover(function(){
        $(this).animate({
            backgroundPositionY : "-19px"
        }, 100);
    },function(){
        if($(this).hasClass("off")){
            $(this).animate({
                backgroundPositionY : "-19px"
            }, 100);
        }else{
            $(this).animate({
                backgroundPositionY : "0"
            }, 100);
        }
    });
    $(".scbtn").click(function(){
        if($(this).hasClass("off")){
            $(this).removeClass("off");
            $(this).animate({
                backgroundPositionY : "0"
            }, 100);
            noMsg();
        }else{
            $(this).addClass("off");
            okMsg();
        }
    });

    $(".sc").hover(function(){
        $(this).animate({
            backgroundPositionY : "-26px"
        }, 100);
    },function(){
        if($(this).hasClass("curr")){
            $(this).animate({
                backgroundPositionY : "-26px"
            }, 100);
        }else{
            $(this).animate({
                backgroundPositionY : "0"
            }, 100);
        }
    });
    //楼盘详情里点周收藏按扭
    $(".sc").click(function(){
        if($(this).hasClass("curr")){
            $(this).removeClass("curr");
            $(this).animate({
                backgroundPositionY : "0"
            }, 100);
            noMsg();
        }else{
            $(this).addClass("curr");
            okMsg();
        }
    });

    $(".qqwb a").not(".top").hover(function(){
        if(!$(this).is(":animated")){
            $(this).animate({left:-($(this).width()+20)});
        }
    },function(){
        $(this).animate({left:0});
    });
    $(".qqwb .top").click(function(){
        $("html,body").animate({
            scrollTop:0
        },500);
        return false;
    });

    if($("#addLink").length > 0){
        $(".dqxmxsycwk").each(function() {
            $(this).find("ul li:last").css("marginRight","0");
        });
        // $("#addLink .column dd ul li").click(function(){
        //     var e = $(this).index();
        //     if($(this).hasClass("curr")){
        //         $(this).removeClass("curr");
        //         $(".dqxmbg").slideUp(500,"easeInCubic",function(){
        //             $(".dqxmxsycwk").eq(e).hide();
        //         });
        //     }else if($(".dqxmbg").is(":hidden")){
        //         $(this).addClass("curr").siblings().removeClass("curr");
        //         $(".dqxmxsycwk").eq(e).show();
        //         $(".dqxmbg").slideDown(500,"easeOutCubic");
        //     }else{
        //         $(this).addClass("curr").siblings().removeClass("curr");
        //         $(".dqxmxsycwk").eq(e).fadeIn(300).siblings(".dqxmxsycwk").fadeOut(300);
        //     }
        // });
    }
    $("#addLink .qbcsbtn1").hover(function(){
        $(this).addClass("curr").find("ul").fadeIn(200);
    },function(){
        $(this).removeClass("curr").find("ul").fadeOut(200);
    });
    $("#addLink .column dd>ul>li").hover(function(){
        $(this).addClass('curr').siblings('li').removeClass('curr');
        $(".dqxmbg").stop().fadeIn(200);
        $(this).find('.dqxmxsycwk').stop().fadeIn(200);
    },function(){
        $(this).removeClass('curr').find('.dqxmxsycwk').stop().fadeOut(200);
        $(".dqxmbg").stop().fadeOut(200);
    });
});

$(window).load(function(){
    if($('#inbar .flexslider li').length > 0){
        $('#inbar .flexslider').flexslider();
    }
    if($('#nybar .flexslider li').length > 0){
        $('#nybar .flexslider').flexslider();
    }
});