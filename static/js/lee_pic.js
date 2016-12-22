/**
 * Created by zhibo on 15-8-20.
 */
/*
 *	上传图片插件改写
 *	@author:
 *	@data:		2013年2月17日
 *	@version:	1.0
 *	@rely:		jQuery
 */
$(function(){
    /*
     *		参数说明
     *		baseUrl:	【字符串】表情路径的基地址
     */
    var lee_pic = {
        uploadTotal : 0,
        uploadLimit : 8, //最多传多少张

        uploadify:function(){
            //文件上传测试
            $('#file').uploadify({
                swf : 'http://ln.localhost.com/static/uploadify/uploadify.swf',
                uploader : '',
                width : 120,
                height : 30,
                fileTypeDesc : '图片类型',
                buttonCursor:'pointer',
                buttonText:'上传图片',
                fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
                fileSizeLimit : '1MB',
                overrideEvents : ['onSelectError','onSelect','onDialogClose'],
                //错误替代
                onSelectError : function (file, errorCode, errorMsg) {
                    switch (errorCode) {
                        case -110 :
                            $('#error').dialog('open').html('超过1024KB...');
                            setTimeout(function () {
                                $('#error').dialog('close').html('...');
                            }, 1000);
                            break;
                    }
                },
                //开始上传前
                onUploadStart : function () {
                    if (lee_pic.uploadTotal == 8) {
                        $('#file').uploadify('stop');
                        $('#file').uploadify('cancel');
                        $('#error').dialog('open').html('限制为8张...');
                        setTimeout(function () {
                            $('#error').dialog('close').html('...');
                        }, 1000);
                    } else {
                        $('.weibo_pic_list').append('<div class="weibo_pic_content"><span class="remove"></span><span class="text">删除</span><img src="' + ThinkPHP['IMG'] + '/loading_100.png" class="weibo_pic_img"></div>');
                    }
                },
                //上传成功后的函数
                onUploadSuccess : function (file, data, response) {
                    // alert(data); //打印出返回的数据
                    $('.weibo_pic_list').append('<input type="hidden" name="images" value='+ data +'> ')
                    var imageUrl= $.parseJSON(data);

                    /*
                     data是返回的回调信息alert
                     file上传的图片信息 用console.log(file);测试
                     response上传成功与否 alert
                     alert(response);
                     alert(data);

                     $('.weibo_pic_list').append('<div class="weibo_pic_content"><span class="remove"></span><span class="text">删除</span><img src="' + ThinkPHP['IMG'] + '/loading_100.png" class="weibo_pic_img"></div>');   //把上传的图片返回的缩略图结果写入html页面中
                     */

                    lee_pic.thumb(imageUrl['thumb']);  //执行缩略图显示问题
                    lee_pic.hover();
                    lee_pic.remove();
                    //共 0 张，还能上传 8 张（按住ctrl可选择多张
                    lee_pic.uploadTotal++;
                    lee_pic.uploadLimit--;
                    $('.weibo_pic_total').text(lee_pic.uploadTotal);
                    $('.weibo_pic_limit').text(lee_pic.uploadLimit);
                }
            });

        },
        hover:function(){
            //上传图片鼠标经过显示删除按扭
            var content=$('.weibo_pic_content');
            var len=content.length;
            $(content[len - 1]).hover(function(){
                $(this).find('.remove').show();
                $(this).find('.text').show();
            },function(){
                $(this).find('.remove').hide();
                $(this).find('.text').hide();
            });
        },
        remove:function(){
            //删除上传的图片操作
            var remove=$('.weibo_pic_content .text');
            var removelen=remove.length;
            $(remove[removelen-1]).on('click',function(){
                $(this).parent('.weibo_pic_content').next('input[name="images"]').remove();
                $(this).parents('.weibo_pic_content').remove();

                //共 0 张，还能上传 8 张（按住ctrl可选择多张
                lee_pic.uploadTotal--;
                lee_pic.uploadLimit++;
                $('.weibo_pic_total').text(lee_pic.uploadTotal);
                $('.weibo_pic_limit').text(lee_pic.uploadLimit);
            });
        },
        thumb : function (src) {
            /*调节缩略图显示问题-即不以中心点为起点显示*/
            var img = $('.weibo_pic_img');
            var len = img.length;
            //alert(src);
            $(img[len - 1]).attr('src', ThinkPHP['LOCALNAME']+src).hide();
            setTimeout(function () {
                if ($(img[len - 1]).width() > 100) {
                    $(img[len - 1]).css('left', -($(img[len - 1]).width() - 100) / 2);
                }
                if ($(img[len - 1]).height() > 100) {
                    $(img[len - 1]).css('top', -($(img[len - 1]).height() - 100) / 2);
                }
                //记图片淡入淡出
                $(img[len - 1]).attr('src', ThinkPHP['LOCALNAME']+src).fadeIn();
            }, 50);
        },
        init:function(){
            /*绑定上传图片弹出按钮响应，初始化。*/


                //绑定uploadify函数
                lee_pic.uploadify();

            /*绑定关闭按钮*/
            $('#pic_box a.close').on('click',function(){
                $('#pic_box').hide();
                $('.pic_arrow_top').hide();
            });

            /*绑定document点击事件，对target不在上传图片弹出框上时执行引藏事件
             //由于鼠标离开窗口就会关闭，影响使用，所以取消
             $(document).on('click',function(e){
             var target = $(e.target);
             if( target.closest("#pic_btn").length == 1  || target.closest(".weibo_pic_content .text").length == 1)
             return;
             if( target.closest("#pic_box").length == 0 ){
             $('#pic_box').hide();
             $('.pic_arrow_top').hide();
             }
             });
             */
        }

    };

    lee_pic.init();	//调用初始化函数。
    window.uploadCount = {
        clear : function () {
            lee_pic.uploadTotal = 0;
            lee_pic.uploadLimit = 8;
        }
    };
});