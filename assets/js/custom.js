jQuery(document).ready(function(){
    jQuery(document).on("click","#som-wp-submit",function(e){
        e.preventDefault();
        jQuery("#som-wp-status").hide();

        var wp_full_name = jQuery("#som-wp-name").val();
        var wp_subject = jQuery("#som-wp-subject").val();
        var wp_message = jQuery("#som-wp-message").val();
        var wp_email_id = jQuery("#som-wp-email").val();
        var wp_form_action = jQuery(".contactForm").attr("action");
        console.log(wp_form_action);
        // Full Name Validation
        if( wp_full_name == ""){
            jQuery("#som-wp-status").show();
            jQuery("#som-wp-status").text("Please Enter Your Full Name.");
            return false;
        }else if(/^[a-zA-Z0-9- ]*$/.test(wp_full_name) == false){
            jQuery("#som-wp-status").show();
            jQuery("#som-wp-status").text("Please Enter Your Full Name.");
            jQuery("#som-wp-name").val("");
            return false;
        }

        if( wp_email_id == ""){
            jQuery("#som-wp-status").show();
            jQuery("#som-wp-status").text("Please Enter Your Valid Email ID.");
            return false;
        }else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(wp_email_id)) {
            jQuery("#som-wp-status").show();
                jQuery("#som-wp-status").text("Please Enter Your Valid Email ID.");
                return false;
            }
        }


        // Subject Validation
        if( wp_subject == ""){
            jQuery("#som-wp-status").show();
            jQuery("#som-wp-status").text("Please Enter Valid Mail Subject.");
            return false;
        }

        // Message Validation
        if( wp_message == ""){
            jQuery("#som-wp-status").show();
            jQuery("#som-wp-status").text("Please Enter Your Valid Message.");
            return false;
        }

        var form_data_kid = new FormData();
				form_data_kid.append('action', 'contact_form_record');
				form_data_kid.append('wp_full_name', wp_full_name);
				form_data_kid.append('wp_subject', wp_subject);
				form_data_kid.append('wp_message', wp_message);
				form_data_kid.append('wp_email_id', wp_email_id);

			jQuery.ajax({  
				type: 'POST',  
				url: wp_form_action+"wp-admin/admin-ajax.php",
				dataType: 'JSON',
				contentType: false,
				processData: false,
				data: form_data_kid, 
				success: function(result){
					console.log(result);
                    if(result['status'] == 1){
                        jQuery("#som-wp-status").show();
						jQuery("#som-wp-status").text("Thank You For connection Us. We will get back To you.");
                        jQuery("#som-wp-name").val("");
                        jQuery("#som-wp-email").val("");
                        jQuery("#som-wp-message").val("");
                        jQuery("#som-wp-subject").val("");
					}else{
                        jQuery("#som-wp-status").show();
						jQuery("#som-wp-status").text("Data inserted Error.");
                        jQuery("#som-wp-name").val("");
                        jQuery("#som-wp-email").val("");
                        jQuery("#som-wp-message").val("");
                        jQuery("#som-wp-subject").val("");
					}
					
				}
			});


    });

    jQuery(document).on("click",".delete-som-record",function(e){
        e.preventDefault();
        var contact_id = jQuery(this).data("id");
        var home_url = jQuery(this).attr("href");

        var form_data_kid = new FormData();
        form_data_kid.append('action', 'contact_record_delete');
        form_data_kid.append('contact_id', contact_id);

        jQuery.ajax({  
            type: 'POST',  
            url: home_url+"wp-admin/admin-ajax.php",
            dataType: 'JSON',
            contentType: false,
            processData: false,
            data: form_data_kid, 
            success: function(result){
                console.log(result);
                if(result['status'] == 1){
                    alert("Delete successfully.");
                    location.reload();
                }else{
                    alert("Delete Faild.");

                }
                
            }
        });
    });


    jQuery("#som-wp-name").keyup(function(){
        var validate_wp_name = jQuery("#som-wp-name").val();
        if(validate_wp_name.length == 1 && validate_wp_name == " "){
            jQuery("#som-wp-name").val("");
        }else{
            validate_wp_name = validate_wp_name.replace(/[^a-zA-Z ]/g, '');

            if( validate_wp_name != ""){
                jQuery("#som-wp-name").val(validate_wp_name);
            }
        }

    });
});

