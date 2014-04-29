// javascript Glück (!)
// 

// analyse d'une URL
var parseUrl = (function () {
	var a = document.createElement('a');
	return function (url) {
		a.href = url;
		return {
			host: a.host,
			hostname: a.hostname,
			pathname: a.pathname,
			port: a.port,
			protocol: a.protocol,
			search: a.search,
			hash: a.hash
		};
	}
})();

jQuery.noConflict();


jQuery( document ).ready(function( $ ) {

	// detection des liens internes
	$.expr[':'].internal = function (obj, index, meta, stack) {
	    // Prepare
	    var
	    $this = $(obj),
	    url = $this.attr('href') || '',
	    isInternalLink;
	    // Check link
	    isInternalLink = /*url.substring(0, rootUrl.length) === rootUrl ||*/ url.indexOf(':') === -1 || obj.hostname == location.hostname;
	    // Ignore or Keep
	    return isInternalLink;
	};


	// initialisation de la librairie skrollr
	$(window).load(function(){
		var s = skrollr.init({
			smoothScrolling: true,
			forceHeight: false,
		});

		skrollr.menu.init(s);
	});


	// on active isotope au moment du chargement des images
	$('img').load(function(){
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
	})

	var shoppAction = false;


	// au chargement de la page
	$(document).ready(function(){

		

		$('a:internal').addClass('internal');

		$('#loader').hide();

		$("#page.blog").fitVids();
		

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

			var rootURL = $('meta[name=identifier-url]').attr('content');			

			console.log('meta : identifier-url');
			console.log(parseUrl(rootURL));
			console.log('history : getState');
			console.log(parseUrl(State.url));

			$('a').each(function(){

				if($(this).attr('href') == State.url){
					$(this).addClass('active');
				}
			})


			var isBlog = false;
			if( ( parseUrl(State.url).pathname.indexOf('blog') != -1) == false){
				console.log('on est pas sur le blog !');
			}else{
				isBlog = true;
				console.log('BLOG…')
			}

			if( parseUrl(State.url).hash != '' ){

				console.log('CLICK : '+parseUrl(State.url).hash);

				//$('a[href='+parseUrl(State.url).hash+']').trigger( "click" );
				var $root = $('html, body');
				$root.animate({
					scrollTop: parseUrl(State.url).hash
				}, 500, function () {
					window.location.hash = href;
				});

			}

			/*if( State.url != $('meta[name=identifier-url]').attr('content')
				&&  State.url != $('meta[name=identifier-url]').attr('content')+'/'){*/

			if(parseUrl(rootURL).pathname != parseUrl(State.url).pathname && !isBlog){

				if(ich.boutique_content != undefined){
					$('#loader').show();

					var boutique = ich.boutique_content({});

					fancyBoutique(boutique);
				}
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


		})(window);


		$('a.closeFancy').click(function(event){
			event.preventDefault();

			console.log('mince');
			$.fancybox.close();

			return false;
		});


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
			beforeSubmit:  shoppFormRequest,
			success:       shoppFormResponse 
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
					console.log('AJAX boutique result');

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
					beforeSubmit:  shoppFormRequest,
					success:       shoppFormResponse 
				});

				$('#shopp a.closeFancy').click(function(event){
					event.preventDefault();

					console.log('mince');
					$.fancybox.close();

					return false;
				});

				// code pinterest
				// cf //assets.pinterest.com/js/pinit.js
				!function(a,b,c){var d,e,f;f="PIN_"+~~((new Date).getTime()/864e5),a[f]||(a[f]=!0,a.setTimeout(function(){d=b.getElementsByTagName("SCRIPT")[0],e=b.createElement("SCRIPT"),e.type="text/javascript",e.async=!0,e.src=c,d.parentNode.insertBefore(e,d)},10))}(window,document,"//assets.pinterest.com/js/pinit_main.js");
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


	// REQUETE ENVOYEE AVEC UN FORMULAIRE SHOPP
	function shoppFormRequest(formData, jqForm, options) {
		console.log('shoppFormRequest');
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
	function shoppFormResponse(data, statusText, xhr, $form)  {
		console.log('shoppFormResponse');

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

			$(this).width( $(this).find('img').width() );
			$largeur += $(this).outerWidth(true);
	
		});
		
		$("#collection_defil").width($largeur);
		$('#collections').jScrollPane();
	}

});