$(document).ready(function()
{
	$("#btnCari").click(function()
	{
		var cari = $("#txtKeyword").val();
		
		if (cari != '') 
		{
			return true;
		}
		else
		{
			//alert("Harap Diisi")
			return false;
		}
	});
});
