
//var $ = $.noConflict();

jQuery.noConflict();

jQuery( document ).ready(function( $ ) {

	// initialisation de la librairie skrollr
	$(window).load(function(){
		var s = skrollr.init({
			forceHeight: false
		});

		skrollr.menu.init(s);
	});

	var shoppAction = false;

	// au chargement de la page
	$(document).ready(function(){

		$('#loader').hide();

		updateCollectionWidth();
		AJAXcollection();

		(function(window,undefined){

			var State = History.getState(); // Note: We are using a capital H instead of a lower h
			if ( !History.enabled ) {
				console.log( 'History.js is disabled for this browser.');
				 // This is because we can optionally choose to support HTML4 browsers or not.
				return false;
			}else{
				console.log('History.js is OK.');
			}

			History.log('initial:', State.data, State.title, State.url);

			if( State.url != $('meta[name=identifier-url]').attr('content')
				&&  State.url != $('meta[name=identifier-url]').attr('content')+'/'){

				$('#loader').show();

				var boutique = ich.boutique_content({});

				fancyBoutique(boutique);

			}

			// Bind to StateChange Event
			History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
				var State = History.getState(); // Note: We are using History.getState() instead of event.state
				History.log('click:',State.data, State.title, State.url);

				//History.log(State);
				//History.log('Change : '+State.data.url);

				AJAXboutique(State.data.url);

				//window.history.pushState("", State.data.title, State.data.url);
				//$('title').text($('title').data('titre')+State.data.title);
			});


			var container = $('#boutique .conteneur');

			container.isotope({
				layoutMode : 'fitRows'
			});

			$('#filters a').click(function(event){
				$('#filters a').removeClass('selected');
				$(this).addClass('selected');

				var selector = $(this).attr('data-filter');
				container.isotope({ filter: selector });
				event.preventDefault();
			});

		})(window);


		// CLIQUE SUR LE PANIER
		$('a#btn_panier').click(function(event){
			History.pushState(
				null,
				$('title').data('titre')+$(this).text(),
				$(this).attr('href')
			);

			AJAXboutique( $(this).attr('href') );

			event.preventDefault();
		});

		// CLIQUE SUR UN LIEN DE LA BOUTIQUE
		$('#boutique .conteneur a').click(function(event){

			History.pushState(
				null,
				$('title').data('titre')+$(this).text(),
				$(this).attr('href')
			);

			AJAXboutique( $(this).attr('href') );

			event.preventDefault();
		});

		// QUAND UN FORMULAIRE DE LA BOUTIQUE EST ENVOYE
		$('#shopp form').ajaxForm({
			beforeSubmit:  showRequest,
			success:       showResponse 
	    }); 


		
	});


	// POUR POUVOIR CHARGER LES COLLECTIONS DANS LA PAGE SKROLLR
	function AJAXcollection(){

		$('#collections a').click(function(event){
			event.preventDefault();

			$('#collections').addClass('loading');

	    	$.collection_defil_content = $("#collection_defil").html();

	    	$("#collection_defil")
	    	.empty();


			$.ajax({
		        url         : $(this).attr('href'),
		        type        : "POST",
		        data        : {},
		        dataType    : 'html'
		    }).done(function ( data ) {

		    	$('#collections').removeClass('loading');

		    	$("#collection_defil").append(
					$('<div>')
					.addClass('article')
					.addClass('back')
					.append(
						$('<a>')
						.html('Retour<br/>aux<br/>collections')
						.click(function(e){
							e.preventDefault();

							$("#collection_defil")
							.empty()
							.html( $.collection_defil_content );

							updateCollectionWidth();

							AJAXcollection();
						})
					)
				);

		    	$(data)
		    	.find('.gallerie-collection>div.article')
		    	.each(function(){
		    		$("#collection_defil").append( $(this) );
		    	});

		    	updateCollectionWidth();
		    	
		    });
		});
	}




	// OUVERTURE DU POPIN FANCYBOX AVEC LA BOUTIQUE
	function fancyBoutique(content){

		$('#loader').hide();

		$.fancybox(content,{
			scrollOutside:false,
			padding:[13,15,13,15],
			autoSize:true,
				helpers: {
	            overlay: {
	              locked: true 
	            }
	        },
			afterShow:function(){

				shoppAction == false;

				$('#gallery-nav a').click(function(event){
					shoppAction == true;

					$('.product-image img').attr('src',$(this).attr('href'));
					event.preventDefault();
				});

				$('a#btn_panier').click(function(event){
					shoppAction == true;

					History.pushState(
						null,
						$('title').data('titre')+$(this).text(),
						$(this).attr('href')
					);

					AJAXboutique( $(this).attr('href') );
					event.preventDefault();
				});

				$('#shopp a').not('#gallery-nav a').click(function(event){
					shoppAction == true;


					History.pushState(
						null,
						$('title').data('titre')+$(this).text(),
						$(this).attr('href')
					);

					AJAXboutique( $(this).attr('href') );
					event.preventDefault();
				});

				$('#shopp form').ajaxForm({
					beforeSubmit:  showRequest,
					success:       showResponse 
			    }); 
			},
			beforeClose:function(){
				console.log('close fancy !');

				if(!shoppAction){
					History.pushState(
						null,
						$('title').data('titre')+$('title').data('slogan'),
						$('meta[name=identifier-url]').attr('content')
					);
				}
			}
		});
	}




	// CHARGEMENT AJAX DE LA BOUTIQUE DANS UN POPIN FANCYBOX
	function AJAXboutique(url){

		if(url != undefined){

			console.log(url);

			$('#loader').show();

			$.ajax({
				url: url,
				type:'POST',
				//dataType:html
				success:function(data){
					console.log('success');

					$('#loader').hide();

					// http://stackoverflow.com/questions/2699320/jquery-script-tags-in-the-html-are-parsed-out-by-jquery-and-not-executed
					var dom = $(data);

			        dom.filter('script').each(function(){
			            $.globalEval(this.text || this.textContent || this.innerHTML || '');
			        });
					
					var boutique = dom.find('#boutique_content').html();

				    fancyBoutique(boutique);
				}
			});
		}
	}


	// REQUETE ENVOYEE AVEC UN FORMULAIRE SHOPP
	function showRequest(formData, jqForm, options) {
		console.log('showRequest');
		console.log(options.url);

		shoppAction == true;

		History.pushState(
			null,
			$('title').data('titre')+"Panier",
			options.url
		);

	    var queryString = $.param(formData); 
	 
	    console.log('About to submit: \n\n' + queryString); 
	 
	    return true; 
	} 
	 
	// REPONSE LORS DE L'ENVOI D'UN FORMULAIRE SHOPP - post-submit callback 
	function showResponse(data, statusText, xhr, $form)  {
		console.log('showResponse');

		shoppAction == true;

		var dom = $(data);

	    dom.filter('script').each(function(){
	        $.globalEval(this.text || this.textContent || this.innerHTML || '');
	    });
		
		var boutique = dom.find('#boutique_content').html();

	    //console.log('status: ' + statusText + '\n\ndata: \n' + data + '\n\nThe output div should have already been updated with the responseText.'); 

	    fancyBoutique(boutique);
	} 


	// MISE A JOUR DE LA LARGEUR D'UNE COLLECTION
	function updateCollectionWidth(){
		$largeur = 0;

		$("#collection_defil .article")
		.each(function(){

			$(this).width($(this).find('img').width());

			$largeur += $(this).outerWidth(true);
		});
		
		$("#collection_defil").width($largeur);

		$('#collections').jScrollPane();
	}


});

