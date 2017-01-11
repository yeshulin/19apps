/**
 * Created by sobey on 2016/8/11.
 */
//时间转换
function   formatDate(now)   {
    var   now= new Date(now*1000);
    var   year=now.getFullYear();
    var   month=now.getMonth()+1;
    var   date=now.getDate();
    var   hour=now.getHours();
    var   minute=now.getMinutes();
    var   second=now.getSeconds();
    return   year+"年"+fixZero(month,2)+"月"+fixZero(date,2)+"日    "+fixZero(hour,2)+":"+fixZero(minute,2)+":"+fixZero(second,2);
}
//时间如果为单位数补0
function fixZero(num,length){
    var str=""+num;
    var len=str.length;
    var s="";
    for(var i=length;i-->len;){
        s+="0";
    }
    return s+str;
}
/**
 * 时长显示
 * @param duration 时长
 * @param unit 单位 h 小时（默认） i 分钟 s 秒
 * @returns {string}
 */
function duration (duration, unit)
{
    var durations = 0 + '秒';
    if (!isNaN(duration))
    {
        duration = parseFloat(duration);
        var _h = 0, _i = 0, _s = 0;
        var _isI = false, _isS = false;
        if (unit == 'h' || unit == undefined)
        {
            duration = duration.toFixed(2);
            _h = parseInt(duration);
            duration = (duration -_h) * 60;
            if (duration > 0) _isI = true;
        }
        if (unit == 'i' || _isI)
        {
            if (duration >= 60)
            {
                var Mc = parseInt(duration/60);
                _h += Mc;
                duration = duration - Mc*60;
            }
            duration = duration.toFixed(1);
            _i = parseInt(duration);
            duration = (duration - _i) * 60;

            if (duration > 0) _isS = true;

        }

        if (unit == 's' || _isS) {
            if (duration >= 60)
            {
                var Mc = parseInt(duration/60);
                _i += Mc;
                duration = duration - Mc*60;
            }
            _s  = Math.ceil(duration);
        }

        var durations = '';
        if (_h > 0) durations += _h + '小时';
        if (_i > 0) durations += _i +  '分';
        if (_s > 0) durations += _s + '秒';
        //console.log(durations);
    }
    return durations;
}

function formatSeconds(value) {
    var theTime = Number(value), theTime1 = 0, theTime2 = 0;
    if(theTime > 60) {
        theTime1 = Number(theTime/60);
        theTime = Number(theTime);
        //alert(theTime1+"-"+theTime);
        if(theTime1 > 60) {
            theTime2 = Number(theTime1/60);
            theTime1 = Number(theTime);
        }
    }
    var result = ""+theTime+"s";
    if(theTime1 > 0) {
        result = ""+parseInt(theTime1)+"m"+result;
    }
    if(theTime2 > 0) {
        result = ""+parseInt(theTime2)+"h"+result;
    }
    return result;
}
/*
 数字转中文
 @number {Integer} 形如123的数字
 @return {String} 返回转换成的形如 一百二十三 的字符串
 */
function numberToChinese(number) {
    var units = '个十百千万@#%亿^&~', chars = '零一二三四五六七八九';
    var a=(number+'').split(''),s=[];
    if(a.length>12){
        throw new Error('too big');
    }else{
        for(var i=0,j=a.length-1;i<=j;i++){
            if(j==1||j==5||j==9){//两位数 处理特殊的 1*
                if(i==0){
                    if(a[i]!='1')s.push(chars.charAt(a[i]));
                }else{
                    s.push(chars.charAt(a[i]));
                }
            }else{
                s.push(chars.charAt(a[i]));
            }
            if(i!=j){
                s.push(units.charAt(j-i));
            }
        }
    }
    //return s;
    return s.join('').replace(/零([十百千万亿@#%^&~])/g,function(m,d,b){//优先处理 零百 零千 等
        b=units.indexOf(d);
        if(b!=-1){
            if(d=='亿')return d;
            if(d=='万')return d;
            if(a[j-b]=='0')return '零'
        }
        return '';
    }).replace(/零+/g,'零').replace(/零([万亿])/g,function(m,b){// 零百 零千处理后 可能出现 零零相连的 再处理结尾为零的
        return b;
    }).replace(/亿[万千百]/g,'亿').replace(/[零]$/,'').replace(/[@#%^&~]/g,function(m){
        return {'@':'十','#':'百','%':'千','^':'十','&':'百','~':'千'}[m];
    }).replace(/([亿万])([一-九])/g,function(m,d,b,c){
        c=units.indexOf(d);
        if(c!=-1){
            if(a[j-c]=='0')return d+'零'+b
        }
        return m;
    });
}
/*
* 截取字符串，包含中文截取
* */
function subString(str, len, hasDot)
{
    var newLength = 0;
    var newStr = "";
    var chineseRegex = /[^\x00-\xff]/g;
    var singleChar = "";
    var strLength = str.replace(chineseRegex,"**").length;
    for(var i = 0;i < strLength;i++)
    {
        singleChar = str.charAt(i).toString();
        if(singleChar.match(chineseRegex) != null)
        {
            newLength += 2;
        }
        else
        {
            newLength++;
        }
        if(newLength > len)
        {
            break;
        }
        newStr += singleChar;
    }

    if(hasDot && strLength > len)
    {
        newStr += "...";
    }
    return newStr;
}
