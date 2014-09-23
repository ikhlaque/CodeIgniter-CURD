$(document).ready(function(){
	$('#cbcountry').change(function(){

		var countryid = $('#cbcountry').val();
        if (countryid != ""){
            var post_url = base_url+"index.php/product/get_state/"+countryid;
            $.ajax({
                type: "POST",
                url: post_url,
  				success: function(states) //we're calling the response json array 'cities'
                {
                    $('#cbstate').empty();
                    $.each(JSON.parse(states),function(id,state)
                    {

						var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(state);
                        $('#cbstate').append(opt);
                    });
                } //end success
            }); //end AJAX
        } else {
            $('#cbstate').empty();
        }//end if

	});



	$('#cbstate').change(function(){

		var countryid = $('#cbcountry').val();
		var stateid = $('#cbstate').val();

        if (countryid != ""){
            var post_url = base_url+"index.php/product/get_cities/"+stateid+"/"+countryid;
            $.ajax({
                type: "POST",
                url: post_url,
  				success: function(cities) //we're calling the response json array 'cities'
                {
                    $('#cbcity').empty();
                    $.each(JSON.parse(cities),function(id,city)
                    {

						var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(id);
                        opt.text(city);
                        $('#cbcity').append(opt);
                    });
                } //end success
            }); //end AJAX
        } else {
            $('#cbcity').empty();
        }//end if

	});
});

function validateForm(){
	
	var name = $.trim($('#name').val()).length;
	var description = $.trim($('#description').val()).length;
	var countryid = $('#cbcountry').val();
	var stateid =$('#cbstate').val();
	var cityid = $('#cbcity').val();
	
	if(name != 0){
		flag = true;
	}else{
		alert('Name Blank');
		flag = false;
	}

	if(description != 0){
		flag = true;
	}else{
		alert('Description Blank');
		flag = false;
	}
	
	if(countryid >= 0){
		flag = true;
	}else{
		alert('Select Country');
		flag = false;
	}

	if(stateid >= 0){
		flag = true;
	}else{
		alert('Select State');
		flag = false;
	}

	if(cityid >= 0){
		flag = true;
	}else{
		alert('Select City');
		flag = false;
	}

	//alert(flag);
	if(flag == true){
		return true;
	}else{
		return false;
	}

}