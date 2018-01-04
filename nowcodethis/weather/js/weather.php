<?php
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$data_json = file_get_contents(/*這裡放連結*/,false, stream_context_create($arrContextOptions));
?>

var data = <?php echo $data_json; ?>;
var data_region = new Array(22);
for(var i=0;i<22;i++)
{
    data_region[i] = new Object();
}
data_region[0].eng_name = "yunlin";
data_region[1].eng_name = "nantou";
data_region[2].eng_name = "lienchiang";
data_region[3].eng_name = "taitung";
data_region[4].eng_name = "kinmen";
data_region[5].eng_name = "yilan";
data_region[6].eng_name = "pingtung";
data_region[7].eng_name = "taipei";
data_region[8].eng_name = "penghu";
data_region[9].eng_name = "miaoli";
data_region[10].eng_name = "hsinchu_co";
data_region[11].eng_name = "hualien";
data_region[12].eng_name = "kaohsiung";
data_region[13].eng_name = "new_taipei";
data_region[14].eng_name = "changhua";
data_region[15].eng_name = "hsinchu_ci";
data_region[16].eng_name = "keelung";
data_region[17].eng_name = "taichung";
data_region[18].eng_name = "tainan";
data_region[19].eng_name = "taoyuan";
data_region[20].eng_name = "chiayi_co";
data_region[21].eng_name = "chiayi_ci";

for(var i=0;i<22;i++)
{
    var locations = data.records.locations[0].location;
    data_region[i].region = locations[i].locationName;
    
    var element = locations[i].weatherElement;
    var PoP_a = element[0].time;
    var Wx_a = element[1].time;
    var minT_a = element[2].time;
    var UVI_a = element[3].time;
    var maxT_a = element[4].time;
    var Wind_a = element[5].time;
    //
    data_region[i].date_today = PoP_a[0].startTime.split(" ")[0];
    var Date_now = new Date();
    var n = Date_now.getDay();
    var wNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
    data_region[i].w_today = wNames[n];
    data_region[i].Wx_today = Wx_a[0].elementValue;
    data_region[i].minT_today = minT_a[0].elementValue;
    data_region[i].maxT_today = maxT_a[0].elementValue;
    var wind = Wind_a[0].parameter;
    data_region[i].wind_d_today = wind[1].parameterValue;
    data_region[i].wind_l_today = wind[3].parameterValue;
    data_region[i].PoP_today = PoP_a[0].elementValue;
    var UVI = UVI_a[0].parameter;
    data_region[i].UVI1_name_today = UVI[0].parameterName;
    data_region[i].UVI1_value_today = UVI[0].parameterValue;
    data_region[i].UVI2_name_today = UVI[1].parameterName;
    data_region[i].UVI2_value_today = UVI[1].parameterValue;
    data_region[i].img_today = choose_img(Wx_a[0].parameter[0].parameterValue);
    //
    data_region[i].date_n1 = PoP_a[2].startTime.split(" ")[0];
    data_region[i].Wx_n1 = Wx_a[2].elementValue;
    data_region[i].minT_n1 = minT_a[2].elementValue;
    data_region[i].maxT_n1 = maxT_a[2].elementValue;
    data_region[i].PoP_n1 = PoP_a[2].elementValue;
    data_region[i].img_n1 = choose_img(Wx_a[2].parameter[0].parameterValue);
    //
    data_region[i].date_n2 = PoP_a[4].startTime.split(" ")[0];
    data_region[i].Wx_n2 = Wx_a[4].elementValue;
    data_region[i].minT_n2 = minT_a[4].elementValue;
    data_region[i].maxT_n2 = maxT_a[4].elementValue;
    data_region[i].PoP_n2 = PoP_a[4].elementValue;
    data_region[i].img_n2 = choose_img(Wx_a[4].parameter[0].parameterValue);
    //pop index>=6 = null
    data_region[i].date_n3 = PoP_a[6].startTime.split(" ")[0];
    data_region[i].Wx_n3 = Wx_a[6].elementValue;
    data_region[i].minT_n3 = minT_a[6].elementValue;
    data_region[i].maxT_n3 = maxT_a[6].elementValue;
    data_region[i].PoP_n3 = PoP_a[6].elementValue;
    data_region[i].img_n3 = choose_img(Wx_a[6].parameter[0].parameterValue);
    //
    data_region[i].date_n4 = PoP_a[8].startTime.split(" ")[0];
    data_region[i].Wx_n4 = Wx_a[8].elementValue;
    data_region[i].minT_n4 = minT_a[8].elementValue;
    data_region[i].maxT_n4 = maxT_a[8].elementValue;
    data_region[i].PoP_n4 = PoP_a[8].elementValue;
    data_region[i].img_n4 = choose_img(Wx_a[8].parameter[0].parameterValue);
    //
}

function choose_img(n)
{
    var img = ""; 
    if(n == 1)
    {
        img = "images/sunny.png";
    }
    else if(n ==2 || n ==3 ||(5<= n && n <=7))
    {
        img = "images/cloudy.png";
    }

    else if(n==8||n==24||n==34||n==43||n==46)
    {
        img = "images/mostlyClear.png";
    }
    else
    {
        if(n == 4 || n >=12)
        {
            img = "images/rainy.png";
        }
    }
    return img;
}

function show_info(id)
{
    document.getElementById("title").innerHTML = data_region[id].region + "天氣預測";
    document.getElementById("date_today").innerHTML = data_region[id].date_today + "&nbsp" + data_region[id].w_today + "&nbsp&nbsp" + "<img id='icon_today' class='w_today_icon'>";
    document.getElementById("icon_today").src = data_region[id].img_today;

    document.getElementById("wx_today").innerHTML = data_region[id].Wx_today;

    document.getElementById("T_today").innerHTML = "氣溫 " + data_region[id].minT_today + "°C ~ " +data_region[id].maxT_today + "°C";

    document.getElementById("wind_today").innerHTML = data_region[id].wind_d_today + "&nbsp&nbsp&nbsp" + data_region[id].wind_l_today + "級";
    document.getElementById("pop_today").innerHTML = "降雨機率：" + data_region[id].PoP_today + "%";
    document.getElementById("UVI1_today").innerHTML = data_region[id].UVI1_name_today + "：" + data_region[id].UVI1_value_today;
    document.getElementById("UVI2_today").innerHTML = data_region[id].UVI2_name_today + "：" + data_region[id].UVI2_value_today;
    
    //
    document.getElementById("l1_n1").innerHTML = data_region[id].date_n1 + "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + data_region[id].Wx_n1 + "&nbsp&nbsp<img id='icon_n1' class='w_icon'>";
    document.getElementById("icon_n1").src = data_region[id].img_n1;
    document.getElementById("l2_n1").innerHTML = data_region[id].minT_n1 + "°C ~ " +data_region[id].maxT_n1 + "°C" + "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"+ "降雨機率：" + data_region[id].PoP_n1 + "%";
    document.getElementById("hr_n1").innerHTML = "<hr class='ani'>";
    //
    document.getElementById("l1_n2").innerHTML = data_region[id].date_n2 + "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + data_region[id].Wx_n2 + "&nbsp&nbsp<img id='icon_n2' class='w_icon'>";
    document.getElementById("icon_n2").src = data_region[id].img_n2;
    document.getElementById("l2_n2").innerHTML = data_region[id].minT_n2 + "°C ~ " +data_region[id].maxT_n2 + "°C" + "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"+ "降雨機率：" + data_region[id].PoP_n2 + "%";
    document.getElementById("hr_n2").innerHTML = "<hr class='ani'>";
    //
    document.getElementById("l1_n3").innerHTML = data_region[id].date_n3 + "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + data_region[id].Wx_n3 + "&nbsp&nbsp<img id='icon_n3' class='w_icon'>";
    document.getElementById("icon_n3").src = data_region[id].img_n3;
    document.getElementById("l2_n3").innerHTML = data_region[id].minT_n3 + "°C ~ " +data_region[id].maxT_n3 + "°C";
    document.getElementById("hr_n3").innerHTML = "<hr class='ani'>";
    //
    document.getElementById("l1_n4").innerHTML = data_region[id].date_n4 + "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + data_region[id].Wx_n4 + "&nbsp&nbsp<img id='icon_n4' class='w_icon'>";
    document.getElementById("icon_n4").src = data_region[id].img_n4;
    document.getElementById("l2_n4").innerHTML = data_region[id].minT_n4 + "°C ~ " +data_region[id].maxT_n4 + "°C";
    document.getElementById("hr_n4").innerHTML = "<hr class='ani'>";
    //
	var waiting_time = 200;
	function set_hr()
	{
        var hr = document.getElementsByClassName("ani");
		hr[0].style.width="100%";
        hr[1].style.width="100%";
        hr[2].style.width="100%";
        hr[3].style.width="100%";
	}
    window.setTimeout(set_hr,waiting_time);
}
window.onload = init_info;
function init_info()
{
    show_info(1);
}
