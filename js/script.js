/**
 * Javascript Glück (!)
 * @author : Loïc Horellou
 */



/**
 * DESACTIVATION DU MODE NOCONFLICT AU CHARGEMENT DE LA PAGE
 */
jQuery.noConflict();
jQuery( document ).ready(function( $ ) {


	/**
	 * ++++++++++++++++++++++++++++++++++++++++++
	 *             FONCTIONS GÉNÉRALES	
	 * ++++++++++++++++++++++++++++++++++++++++++
	 */

	/**
	 * detection des liens internes
	 */
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


	/**
	 * analyse d'une URL
	 * @return {[type]} [description]
	 */
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


	// on ajoute une classe internal sur les liens qui pointent sur le site
	$('a:internal').addClass('internal');
	// on masque le loader
	$('#loader').hide();
	// on active le mode responsive pour les vidéos
	$("#page.blog").fitVids();
	


	/**
	 * initialisation de la librairie skrollr
	 * @return {[type]} [description]
	 */
	$(window).load(function(){
		var s = skrollr.init({
			smoothScrolling: true,
			forceHeight: false,
		});

		skrollr.menu.init(s);
	});


	/**
	 * on active isotope au moment du chargement des images
	 * @return {[type]} [description]
	 */
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
	});




	/**
	 * ++++++++++++++++++++++++++++++++++++++++++
	 *             HISTORY.JS
	 * ++++++++++++++++++++++++++++++++++++++++++
	 */


	/**
	 * ACTIVATION DE history.js
	 * @param  {[type]} window    [description]
	 * @param  {[type]} undefined [description]
	 * @return {[type]}           [description]
	 */
	(function(window,undefined){

		var State = History.getState();
		var rootURL = $('meta[name=identifier-url]').attr('content');
		
		if ( !History.enabled ) {
			//console.log( 'History.js is disabled for this browser.');
			return false;
		}else{
			//console.log('History.js is OK.');
		}

		//History.log('initial:', State.data, State.title, State.url);
			
		// console.log('meta : identifier-url');
		// console.log(parseUrl(rootURL));
		// console.log('history : getState');
		// console.log(parseUrl(State.url));

		// on ajoute une classe active si un lien correspond à l'URL de la page
		$('a').each(function(){
			if($(this).attr('href') == State.url){
				$(this).addClass('active');
			}
		});

		// on vérifie si on est sur le blog ou pas
		var isBlog = false;
		if( ( parseUrl(State.url).pathname.indexOf('blog') != -1) == false){
			//console.log('on est pas sur le blog !');
		}else{
			isBlog = true;
			//console.log('BLOG…')
		}


		if(parseUrl(rootURL).pathname != parseUrl(State.url).pathname && !isBlog){

			if(ich.boutique_content != undefined){

				$('#loader').show();

				var boutique = ich.boutique_content({});

				fancyBoutique(boutique);
			}
		}


		// Bind to StateChange Event
		History.Adapter.bind(window,'statechange',function(){
			var State = History.getState();

			console.log('--------------------------');
			console.log('State : ');
			console.log(State);
			switch(State.data.shopp){
				case 'a' :
					console.log('c’est un lien AJAXBOUTIQUE' );
					//AJAXboutique( State.data.url );
					AJAXboutique( State.url );
				break;
				case 'form' :
					console.log('c’est un formulaire' );
				break;
				case 'close' : default :
					console.log('on ferme fancybox' );
					//$.fancybox.close();
				break;
			}	

			History.log('click:',State.data, State.title, State.url);

		});

	})(window);



	/**
	 * ++++++++++++++++++++++++++++++++++++++++++
	 *          FANCYBOX ET BOUTIQUE
	 * ++++++++++++++++++++++++++++++++++++++++++
	 */

	 actionsFancyBox();


	/**
	 * CLIQUE SUR UN LIEN DE LA BOUTIQUE
	 * @param  {[type]} event [description]
	 * @return {[type]}       [description]
	 */
	$('#boutique .conteneur a').click(function(event){

		History.pushState(
			{
				'shopp' : 'a',
				//'url'   : $(this).attr('href')
			},
			$('title').data('titre')+$(this).data('titre'),
			$(this).attr('href')
		);

		event.preventDefault();
	});

	// quand on clique sur le bouton pannier
	$('a#btn_panier').click(function(event){

		History.pushState(
			{
				'shopp' : 'a',
				//'url'   : $(this).attr('href')
			},
			$('title').data('titre')+$(this).text(),
			$(this).attr('href')
			);

		event.preventDefault();
	});



	/**
	 * CHARGEMENT AJAX DE LA BOUTIQUE DANS UN POPIN FANCYBOX
	 * @param {[type]} url [description]
	 */
	function AJAXboutique(url){

		if(url != undefined){

			//console.log(url);

			$('#loader').show();

			$.ajax({
				url: url,
				type:'POST',
				//dataType:html
				success:function(data){
					//console.log('AJAX boutique result');

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


	/**
	 * OUVERTURE DU POPIN FANCYBOX AVEC LA BOUTIQUE
	 * @param  {[type]} content [description]
	 * @return {[type]}         [description]
	 */
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
			maxHeight: 545,
			afterShow:function(){

				actionsFancyBox();
				
			},
			beforeClose:function(){
				if($keepFancy != true){
					History.pushState(
						{
							'shopp' : 'close',
						},
						$('title').data('titre')+$('title').data('slogan'),
						$('meta[name=identifier-url]').attr('content')
					);
				}
			}
		});
	}


	/**
	 * REQUETE ENVOYEE AVEC UN FORMULAIRE SHOPP
	 * @param  {[type]} formData [description]
	 * @param  {[type]} jqForm   [description]
	 * @param  {[type]} options  [description]
	 * @return {[type]}          [description]
	 */
	function shoppFormRequest(formData, jqForm, options) {
		// console.log('shoppFormRequest');
		// console.log(options.url);
		
		$('#loader').show();

		$keepFancy = true;

		History.pushState(
			{
				'shopp':'form'
			},
			$('title').data('titre')+"Panier",
			options.url
		);

		var queryString = $.param(formData); 
		// console.log('About to submit: \n\n' + queryString); 

		return true; 
	} 


	/**
	 * REPONSE LORS DE L'ENVOI D'UN FORMULAIRE SHOPP - post-submit callback 
	 * @param  {[type]} data       [description]
	 * @param  {[type]} statusText [description]
	 * @param  {[type]} xhr        [description]
	 * @param  {[type]} $form      [description]
	 * @return {[type]}            [description]
	 */
	function shoppFormResponse(data, statusText, xhr, $form)  {
		//console.log('shoppFormResponse');

		var dom = $(data);

		dom.filter('script').each(function(){
			$.globalEval(this.text || this.textContent || this.innerHTML || '');
		});
		
		var boutique = dom.find('#boutique_content').html();

	    //console.log('status: ' + statusText + '\n\ndata: \n' + data + '\n\nThe output div should have already been updated with the responseText.'); 

	    fancyBoutique(boutique);
	} 



	/**
	 * [actionsFancyBox description]
	 * @return {[type]} [description]
	 */
	function actionsFancyBox(){
		$keepFancy = false;

		$('#gallery-nav a').click(function(event){

			$('.product-image img').attr('src',$(this).attr('href'));

			event.preventDefault();
		});



		// quand on clique sur une des vignettes de galerie de la boutique
		$('#shopp a').not('#gallery-nav a').click(function(event){

			$keepFancy = true;

			History.pushState(
				{
					'shopp' : 'a',
				},
				$('title').data('titre')+$(this).text(),
				$(this).attr('href')
			);

			//AJAXboutique( $(this).attr('href') );
			event.preventDefault();
		});

		// quand on envoie un formulaire
		$('.shoppform').ajaxForm({
			beforeSubmit:  shoppFormRequest,
			success:       shoppFormResponse 
		});

		// quand on clique sur un lien de fermeture de la boutique
		$('#shopp a.closeFancy')
		.unbind('click')
		.click( function(event){
			event.preventDefault();

			$.fancybox.close();
		});

		// code pinterest
		// cf //assets.pinterest.com/js/pinit.js
		!function(a,b,c){var d,e,f;f="PIN_"+~~((new Date).getTime()/864e5),a[f]||(a[f]=!0,a.setTimeout(function(){d=b.getElementsByTagName("SCRIPT")[0],e=b.createElement("SCRIPT"),e.type="text/javascript",e.async=!0,e.src=c,d.parentNode.insertBefore(e,d)},10))}(window,document,"//assets.pinterest.com/js/pinit_main.js");
	}




	/**
	 * ++++++++++++++++++++++++++++++++++++++++++
	 *             LES COLLECTIONS
	 * ++++++++++++++++++++++++++++++++++++++++++
	 */

	
	/**
	 * MISE A JOUR DE LA LARGEUR D'UNE COLLECTION
	 */
	updateCollectionWidth();
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


	
	/**
	 * POUR POUVOIR CHARGER LES COLLECTIONS DANS LA PAGE SKROLLR
	 */
	AJAXcollection();
	function AJAXcollection(){

		$('#collections a').click(function(event){
			event.preventDefault();

			$('#collections').addClass('loading');

			$.collection_defil_content = $("#collection_defil").html();

			$("#collection_defil").empty();


			$.ajax({
				url         : $(this).attr('href'),
				type        : "POST",
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
						.click(function(event){
							event.preventDefault();

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

});