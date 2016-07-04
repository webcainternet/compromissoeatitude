;(function($, window, document, undefined) {

	'use strict';

	var _updater_el;

	function showLogin(status){
		$('.prompt-box .show-login').show();
		$('.prompt-box .show-error').hide();
		if(status == 'error'){
			if($('.prompt-box .prompt-error').length == 0){
				$('.prompt-box .prompt-msg').after('<p class="prompt-error">' + themify_lang.invalid_login + '</p>');
			}
		} else {
			$('.prompt-box .prompt-error').remove();
		}
		$(".overlay, .prompt-box").fadeIn(500);	
	}	
	function hideLogin(){
		$('.overlay, .prompt-box').fadeOut(500, function(){
			var $prompt = $('.prompt-box'), $iframe = $prompt.find('iframe');
			if ( $iframe.length > 0 ) {
				$iframe.remove();
			}
			$prompt.removeClass('show-changelog');
		});
	}
	function showAlert(){
		$(".alert").addClass("busy").fadeIn(800);
	}
	function hideAlert(status){
		if(status == 'error'){
			status = 'error';
			showErrors();
		} else {
			status = 'done';	
		}
		$(".alert").removeClass("busy").addClass(status).delay(800).fadeOut(800, function(){
			$(this).removeClass(status);											   
		});
	}
	function showErrors(verbose){
		$(".overlay, .prompt-box").delay(900).fadeIn(500);	
		$('.prompt-box .show-error').show();
		$('.prompt-box .show-error p').remove();
		$('.prompt-box .error-msg').after('<p class="prompt-error">' + verbose + '</p>');
		$('.prompt-box .show-login').hide();
	}
	
	$(function(){
		//
		// Upgrade Theme / Framework
		//
		$(".themify-builder-upgrade-plugin").on('click', function(e){
			e.preventDefault();
			_updater_el = $(this);
			showLogin();
		});
		
		//
		// Login Validation
		//
		$(".themify-builder-upgrade-login").on('click', function(e){
			e.preventDefault();
			var el = $(this), 
				username = el.parent().parent().find('.username').val(),
				password = el.parent().parent().find('.password').val(),
				login = $(".themify-builder-upgrade-plugin").parent().hasClass('login');
			if(username != "" && password != ""){
				hideLogin();
				showAlert();
				$.post(
					ajaxurl,
					{
						'action':'themify_builder_validate_login',
						'type':'plugin',
						'login':login,
						'username':username,
						'password':password
					},
					function(data){
						data = $.trim(data);
						if('subscribed' == data){
							hideAlert();
							$('#themify_update_form').append( '<input type="hidden" name="plugin" value="'+ _updater_el.data( 'plugin' ) +'" /><input type="hidden" name="package_url" value="'+ _updater_el.data( 'package_url' ) +'" />' ).submit();
						} else if('invalid' == data) {
							hideAlert('error');
							showLogin('error');
						} else if('unsuscribed' == data) {
							hideAlert('error');
							showLogin('unsuscribed');
						}
					}
				);																					
			} else {
				hideAlert('error');	
				showLogin('error');							   
			}
		});

		/**
		 * Hide Overlay
		 */
		$('body').on('click', '.overlay', function(){
			hideLogin();
		});

		/**
		 * Changelogs
		 */
		$('.themify_changelogs').on('click', function(e){
			e.preventDefault();
			var $self = $(this),
				url = $self.data('changelog'),
				$body = $('body');

			if ( $('.overlay').length <= 0 ) {
				$body.prepend('<div class="overlay" />');
			}

			$('.show-login, .show-error').hide();
			$('.alert').addClass('busy').fadeIn(300);
			$('.overlay, .prompt-box').fadeIn(300);
			var $iframe = $('<iframe src="'+url+'" />');
			$iframe.on('load', function(){
				$('.alert').removeClass('busy').fadeOut(300);
			}).prependTo( '.prompt-box' );
			$('.prompt-box').addClass('show-changelog');

		});
	});
}(jQuery, window, document));