var region_select=document.getElementById("region");
for(var i=0;i<22;i++)
{
	if(i==1)
	{
		region_select.add(new Option(data_region[i].region, i,false,true), null);
	}
	else
	{
		region_select.add(new Option(data_region[i].region, i), null);
	}
}
        
function change_info()
{
	var id = region_select.options[region_select.selectedIndex].value;
	show_info(id);
}