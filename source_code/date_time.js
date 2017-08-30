function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
	year_ROC = date.getFullYear()-1911;
        month = date.getMonth()+1;
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	months_abbrev = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	months_zh = new Array('一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	days_abbrev = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	days_zh = new Array('日', '一', '二', '三', '四', '五', '六');
        h = date.getHours();
        
	if(month<10)
        {
                month = "0"+month;
        }
	if(d<10)
        {
                d = "0"+d;
        }

	if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = year+'/'+month+'/'+d+'&nbsp;(&nbsp;星期'+days_zh[day]+'&nbsp;)&nbsp;'+'<br>'+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
