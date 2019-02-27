<script type="text/javascript">
	$(document).ready(function() {
		var send_contact;
        $("#form-send-contact").submit(function(event){
            if ($(this).parsley().isValid()) {
	            if (send_contact) {
	                send_contact.abort();
	            }
	            var $form = $(this);
	            var $inputs = $form.find("input, button");
	            var serializedData = $form.serialize();
	            send_contact = $.ajax({
	                url: "<?php echo MURL ?>cr-include/ajax/send-contact.php",
	                type: "post",
	                beforeSend: function(){ $("#button-send-contact").html('SENDING...');$("#button-send-contact").attr('disabled','disabled');},
	                data: serializedData
	            });
	            send_contact.done(function (msg){
	            	if(msg == 'empty-field') {
	                    $("#button-send-contact").removeAttr('disabled');
	                    $("#button-send-contact").html('PRESS ME');
	                    $("#response").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Please fill all field.</div>');
	                }
	                else if(msg == 'invalid-recaptcha') {
	                    $("#button-send-contact").removeAttr('disabled');
	                    $("#button-send-contact").html('PRESS ME');
	                    $("#response").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Invalid reCAPTCHA code.</div>');
	                }
	                else if(msg == 'reenter-recaptcha') {
	                    $("#button-send-contact").removeAttr('disabled');
	                    $("#button-send-contact").html('PRESS ME');
	                    $("#response").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Please re-enter your reCAPTCHA.</div>');
	                }
	                else if(msg == 'success'){
	                	$form.find("input, textarea").val('');
	                	$form.find("textarea").html('');
	                	$form.parsley().reset();
	                	$("#button-send-contact").removeAttr('disabled');
	                    $("#button-send-contact").html('PRESS ME');
	                    $("#response").html('<div class="alert alert-success fade in"><strong>Success!</strong> Your message has been sent successfully.</div>');
	                }
	                else if(msg == 'failed') {
	                    $("#button-send-contact").removeAttr('disabled');
	                    $("#button-send-contact").html('PRESS ME');
	                    $("#response").html('<div class="alert alert-danger fade in"><strong>Failed!</strong> Can\'t send your message. Please try again.</div>');
	                }
	                else {
	                    $("#button-send-contact").removeAttr('disabled');
	                    $("#button-send-contact").html('PRESS ME');
	                    $("#response").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Can\'t send your message. Please try again.</div>');
	                }
	            });
	            send_contact.always(function () {
	                $inputs.prop("disabled", false);
	            });
	            event.preventDefault();
	        }
        });
    });
</script>