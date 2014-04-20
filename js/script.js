
//var $ = jQuery.noConflict();


// initialisation de la librairie skrollr
jQuery(window).load(function(){
	var s = skrollr.init({
		forceHeight: false
	});

	skrollr.menu.init(s);
});

/*setTimeout(function() {
	var s = skrollr.init({
		forceHeight: false
	});

	skrollr.menu.init(s)
}, 500);*/


var shoppAction = false;

// au chargement de la page
jQuery(document).ready(function(){

	jQuery('#loader').hide();

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

		if( State.url != jQuery('meta[name=identifier-url]').attr('content')
			&&  State.url != jQuery('meta[name=identifier-url]').attr('content')+'/'){

			jQuery('#loader').show();

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
			//jQuery('title').text(jQuery('title').data('titre')+State.data.title);
		});


		var container = jQuery('#boutique .conteneur');

		container.isotope({
			layoutMode : 'fitRows'
		});

		jQuery('#filters a').click(function(event){
			jQuery('#filters a').removeClass('selected');
			jQuery(this).addClass('selected');

			var selector = jQuery(this).attr('data-filter');
			container.isotope({ filter: selector });
			event.preventDefault();
		});

	})(window);


	// CLIQUE SUR LE PANIER
	jQuery('a#btn_panier').click(function(event){
		History.pushState(
			null,
			jQuery('title').data('titre')+jQuery(this).text(),
			jQuery(this).attr('href')
		);

		AJAXboutique( jQuery(this).attr('href') );

		event.preventDefault();
	});

	// CLIQUE SUR UN LIEN DE LA BOUTIQUE
	jQuery('#boutique .conteneur a').click(function(event){

		History.pushState(
			null,
			jQuery('title').data('titre')+jQuery(this).text(),
			jQuery(this).attr('href')
		);

		AJAXboutique( jQuery(this).attr('href') );

		event.preventDefault();
	});

	// QUAND UN FORMULAIRE DE LA BOUTIQUE EST ENVOYE
	jQuery('#shopp form').ajaxForm({
		beforeSubmit:  showRequest,
		success:       showResponse 
    }); 


	
});


// POUR POUVOIR CHARGER LES COLLECTIONS DANS LA PAGE SKROLLR
function AJAXcollection(){

	jQuery('#collections a').click(function(event){
		event.preventDefault();

		jQuery('#collections').addClass('loading');

    	jQuery.collection_defil_content = jQuery("#collection_defil").html();

    	jQuery("#collection_defil")
    	.empty();


		jQuery.ajax({
	        url         : jQuery(this).attr('href'),
	        type        : "POST",
	        data        : {},
	        dataType    : 'html'
	    }).done(function ( data ) {

	    	jQuery('#collections').removeClass('loading');

	    	jQuery("#collection_defil").append(
				jQuery('<div>')
				.addClass('article')
				.addClass('back')
				.append(
					jQuery('<a>')
					.html('Retour<br/>aux<br/>collections')
					.click(function(e){
						e.preventDefault();

						jQuery("#collection_defil")
						.empty()
						.html( jQuery.collection_defil_content );

						updateCollectionWidth();

						AJAXcollection();
					})
				)
			);

	    	jQuery(data)
	    	.find('.gallerie-collection>div.article')
	    	.each(function(){
	    		jQuery("#collection_defil").append( jQuery(this) );
	    	});

	    	updateCollectionWidth();
	    	
	    });
	});
}


// OUVERTURE DU POPIN FANCYBOX AVEC LA BOUTIQUE
function fancyBoutique(content){

	jQuery('#loader').hide();

	jQuery.fancybox(content,{
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

			jQuery('#gallery-nav a').click(function(event){
				shoppAction == true;

				jQuery('.product-image img').attr('src',jQuery(this).attr('href'));
				event.preventDefault();
			});

			jQuery('a#btn_panier').click(function(event){
				shoppAction == true;

				History.pushState(
					null,
					jQuery('title').data('titre')+jQuery(this).text(),
					jQuery(this).attr('href')
				);

				AJAXboutique( jQuery(this).attr('href') );
				event.preventDefault();
			});

			jQuery('#shopp a').not('#gallery-nav a').click(function(event){
				shoppAction == true;


				History.pushState(
					null,
					jQuery('title').data('titre')+jQuery(this).text(),
					jQuery(this).attr('href')
				);

				AJAXboutique( jQuery(this).attr('href') );
				event.preventDefault();
			});

			jQuery('#shopp form').ajaxForm({
				beforeSubmit:  showRequest,
				success:       showResponse 
		    }); 
		},
		beforeClose:function(){
			console.log('close fancy !');

			if(!shoppAction){
				History.pushState(
					null,
					jQuery('title').data('titre')+jQuery('title').data('slogan'),
					jQuery('meta[name=identifier-url]').attr('content')
				);
			}
		}
	});
}


// CHARGEMENT AJAX DE LA BOUTIQUE DANS UN POPIN FANCYBOX
function AJAXboutique(url){

	if(url != undefined){

		console.log(url);

		jQuery('#loader').show();

		jQuery.ajax({
			url: url,
			type:'POST',
			//dataType:html
			success:function(data){
				console.log('success');

				jQuery('#loader').hide();

				// http://stackoverflow.com/questions/2699320/jquery-script-tags-in-the-html-are-parsed-out-by-jquery-and-not-executed
				var dom = jQuery(data);

		        dom.filter('script').each(function(){
		            jQuery.globalEval(this.text || this.textContent || this.innerHTML || '');
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
		jQuery('title').data('titre')+"Panier",
		options.url
	);

    var queryString = jQuery.param(formData); 
 
    console.log('About to submit: \n\n' + queryString); 
 
    return true; 
} 
 
// REPONSE LORS DE L'ENVOI D'UN FORMULAIRE SHOPP - post-submit callback 
function showResponse(data, statusText, xhr, $form)  {
	console.log('showResponse');

	shoppAction == true;

	var dom = jQuery(data);

    dom.filter('script').each(function(){
        jQuery.globalEval(this.text || this.textContent || this.innerHTML || '');
    });
	
	var boutique = dom.find('#boutique_content').html();

    //console.log('status: ' + statusText + '\n\ndata: \n' + data + '\n\nThe output div should have already been updated with the responseText.'); 

    fancyBoutique(boutique);
} 


// MISE A JOUR DE LA LARGEUR D'UNE COLLECTION
function updateCollectionWidth(){
	jQuery.largeur = 0;

	jQuery("#collection_defil .article")
	.each(function(){

		jQuery(this).width(jQuery(this).find('img').width());

		jQuery.largeur += jQuery(this).outerWidth(true);
	});
	
	jQuery("#collection_defil").width(jQuery.largeur);

	jQuery('#collections').jScrollPane();
}


