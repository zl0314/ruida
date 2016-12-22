/**
 * 
 * @authors lizhicheng (lizhicheng99@163.com)
 * @qq 289530302 
 * @date    2015-09-01 14:02:24
 */



var time_interval = function(){
	var sh;
	var title = "";
	var endtime = "";


	//确定当前时间在哪个时间内
	var find_position = function() {

		var center_p = -1; //区间位置标记
		var prev_p = -1; //没有在区间的位置标记 


		//先判断正好在区间内
		for (var i = 0; i < time_obj.time_section.length; i++) {
			if ((time_obj.now_time > time_obj.time_section[i][0]) && (time_obj.now_time <= time_obj.time_section[i][1])) {
				center_p = i;
				endtime = time_obj.time_section[i][1];

				//title = "距第" + parseInt(i + 1) + "轮活动剩余时间";
				title = "距离本次活动结束时间";

				$("#colockbox1").hide();
				$("#colockbox2").show();
				
				break;
			}
		}


		//如果没有在时间段内 判断是否在时间段开始之前
		if (center_p == -1) {
			for (var j = 0; j < time_obj.time_section.length; j++) {
				if (time_obj.now_time < time_obj.time_section[j][0]) {
					prev_p = j;
					endtime = time_obj.time_section[j][0];


					if (j == 0) {
						title = "距离本次活动开始时间";
					} else {
						title = "距第" + parseInt(j + 1) + "轮活动开始时间";
					}


					break;
				}
			}
		}


		if (center_p == -1 && prev_p == -1) {
			title = "本活动已结束";
		}
		//console.log(title);
		//console.log(endtime);
	}


	var init = function() {

		var len = time_obj.time_section.length;
		find_position();

	}

	init();

	var modi = function(num){

		return num<10?"0"+num:num;
	}

	function _fresh() {

		//var endtime=new Date("2015-09-01 14:55:00"); 
		//var endtime=1441090980000;   //2015-09-01 15:03:00
		//var nowtime =1441090500000;    //2015-09-01 14:55:00
		time_obj.now_time += 1000; //尽量和服务器同步
		console.log('endtime:'+ endtime);
		var leftsecond = parseInt((endtime - time_obj.now_time) / 1000);
		__d = parseInt(leftsecond / 3600 / 24);
		__h = parseInt((leftsecond / 3600) % 24);
		__m = parseInt((leftsecond / 60) % 60);
		__s = parseInt(leftsecond % 60);
		//document.getElementById("times").innerHTML = title + __d + "天 " + __h + "小时" + __m + "分" + __s + "秒";

	document.getElementById("colockbox1").innerHTML = '<span class="tit">'+title+'</span>\
	            <span class="time day">'+modi(__d)+'</span>\
	            <span>天</span>\
	            <span class="time hour">'+modi(__h)+'</span>\
	            <span>小时</span>\
	            <span class="time minute">'+modi(__m)+'</span>\
	            <span>分</span>\
	            <span class="time second">'+modi(__s)+'</span>\
	            <span>秒</span>';

		//console.log( '当前时间：'+leftsecond);

		if (leftsecond <= 0) {
			console.log( title );
			time_obj.now_time += 1000; //尽量和服务器同步
			init();
			if (title == "本活动已结束") {
			console.log('结束');
			document.getElementById('colockbox2').style.display = 'none';
			document.getElementById('colockbox1').style.display = 'block';
			document.getElementById("colockbox1").innerHTML = '<span class="tit">本活动已结束</span>';
				clearInterval(sh);

			}

		}
	}

	sh = setInterval(_fresh, 1000);


};
time_interval();



