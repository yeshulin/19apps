

function canvasToImg(obj,param,callback){
	var _param = {
		canvasW : 300,
		canvasH : 300,
		canvasX : 0,
		canvasY : 0,
		imgW : "",
		imgH : "",
		imgX : "",
		imgY : "",
		quality: 0.8 
	}
//	参数	描述
//	img	规定要使用的图像、画布或视频。
//	sx	可选。开始剪切的 x 坐标位置。
//	sy	可选。开始剪切的 y 坐标位置。
//	swidth	可选。被剪切图像的宽度。
//	sheight	可选。被剪切图像的高度。
//	x	在画布上放置图像的 x 坐标位置。
//	y	在画布上放置图像的 y 坐标位置。
//	width	可选。要使用的图像的宽度。（伸展或缩小图像）
//	height	可选。要使用的图像的高度。（伸展或缩小图像）
	_param = $.extend(_param,param)	
	var c=$('<canvas width="'+_param.canvasW+'" height="'+_param.canvasH+'"></canvas>')[0];
	var ctx=c.getContext("2d");	
	ctx.drawImage(obj,_param.imgX,_param.imgY,_param.imgW,_param.imgH,0,0,_param.canvasW,_param.canvasH);	
	var data=c.toDataURL();		
	callback(data);
}
