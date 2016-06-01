$(document).ready(function()
{
	$("#btnCari").click(function()
	{
		var cari = $("#search").val();
		
		if (cari != '') {
			return true;
		}
		else{
			//alert("Harap Diisi")
			return false;
		}
	});

	$("#search").keypress(function(e)
	{
		var cari = $("#search").val();
		if(e.keyCode == 13){
			if (cari != '') {
				return true;
			}
			else{
				//alert("Harap Diisi")
				return false;
			}
		}
	});

	$('#search').keyup(function(){
		$('#btnCari').css('visibility','visible');

		var cari = $("#search").val();
		if (cari.length < 1) 
		{
			$('#btnCari').css('visibility','hidden');
		}
	});

	$('#search').mouseover(function(){
		$('#btnCari').css('visibility','visible');

		var cari = $("#search").val();
		if (cari.length < 1) 
		{
			$('#btnCari').css('visibility','hidden');
		}
	});

	$('#readMore').click(function(){
		$('#hasilUtamaLengkap').show();
		$('#hasilUtama').hide();
	});

	$('#readMin').click(function(){
		$('#hasilUtamaLengkap').hide();
		$('#hasilUtama').show();
	});

});
