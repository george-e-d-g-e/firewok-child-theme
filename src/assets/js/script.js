
//const bodyScrollLock = global.bodyScrollLock;
// const disableBodyScroll = bodyScrollLock.disableBodyScroll;
// const enableBodyScroll = bodyScrollLock.enableBodyScroll;

// Global object for all functions
const firewok = {
	showMenu: false,
};

window.onload = function(){
	addMegaMenu();
	firewok.header = makeHeader();
	updateVarForm();
	toggleMenu();
	displayAllTabs();
};

window.onscroll = function(e) {
	if (firewok.header) {
		let scrollTop = e.target.scrollingElement.scrollTop;
		if ((scrollTop == 0) && (firewok.header.getType() == "min")){
			firewok.header.grow();
		}
		else if ((scrollTop > 0) && (firewok.header.getType() == "max")){
			firewok.header.shrink();
		}
	}
};

function makeHeader() {
	let el = document.getElementById("masthead");
	let type = "max";
	return {
		grow: function() {
			type = "max";
			toggleClass( el, "min" );
		},
		shrink: function() {
			type = "min";
			toggleClass( el, "min" );
		},
		getType: function() {
			return type;
		}
	}
};

/* mobile menu */
function toggleMenu(){
	let menu = document.getElementById("masthead");
	let menuButton = document.getElementById("hamburger-mobile");
	

	menuButton.addEventListener("click", function() { 
		toggleClass( menu, "active" ); 
		toggleBodyScroll( menu );
	}, true);
}


/* Mega Menu */

function addMegaMenu() {
	let megaMenu = document.getElementsByClassName("mega-menu")[0];
	if (megaMenu.firstChild){
		// Find shop menu button
		let menu = document.getElementsByClassName("primary-navigation");
		let contact = document.getElementById("contact-info");
		let links = menu[0].getElementsByClassName('menu-item');
		let back = document.getElementById("mega-menu-back-btn");

		for (let i = links.length - 1; i >= 0; i--) {
			if(links[i].firstChild.innerText == "Shop"){
				
				let device = window.matchMedia("(max-width: 767px)");

				if (device.matches) {
					links[i].addEventListener("click", function(event){
						event.preventDefault();
						toggleClass( megaMenu, "active" );
						toggleClass( contact, "hide" );
					});
					back.addEventListener("click", function(event){
						event.preventDefault();
						toggleClass( megaMenu, "active" );
						toggleClass( contact, "hide" ); 
					});
				}
				else {
					// Check if mouse is already over
					if(links[i].matches(':hover')) {
						megaMenu.classList.add("active");
					}
					// Add event listeners
					links[i].addEventListener("mouseenter", function() { 
						toggleClass( megaMenu, "active" );
						toggleClass( contact, "hide" );  
					}, false);
					links[i].addEventListener("mouseleave", function() { 
						toggleClass( megaMenu, "active" );
						toggleClass( contact, "hide" ); 
					}, false);
				}
				
			}
		}
	}	
};

function toggleClass( el, cssClass ){
	el.classList.toggle( cssClass );
};

function toggleBodyScroll( el ){
	firewok.showMenu = !firewok.showMenu;
	if(firewok.showMenu === false){
		console.log("disable");
		// disableBodyScroll(el);
	}
	else {
		console.log("enable");
		// enableBodyScroll(el);
	}

};

/* Prduct Page */

function updateVarForm() {
	
	let varForm = document.getElementsByClassName("variations_form");
	if (varForm.length !== 0) {
		// Update initial price
		updateVarPrice();
		let selectors = document.querySelectorAll(".variations select");
		for (let i = selectors.length - 1; i >= 0; i--) {
			// Update price on change
			selectors[i].addEventListener("change", function(){
				updateVarPrice();
			}, true);
		}
	}
};


function updateVarPrice(){
	let t = 0;
	let checkPrice = setInterval( function(){
		let summaryPrice = document.querySelectorAll(".summary p.price");
		let variationPrice = document.querySelectorAll(".woocommerce-variation-price span.price span.amount");
		if (variationPrice.length !== 0) {
			console.log(summaryPrice[0].textContent);

			if (summaryPrice[0].textContent !== variationPrice[0].lastChild.textContent) {
				summaryPrice[0].textContent = "£"+variationPrice[0].lastChild.textContent;
				window.clearInterval(checkPrice);
			}
		}
		if (t > 5){
			window.clearInterval(checkPrice);
			//console.log("tock");
		}	
		t++;
		//console.log(t);	 
	},200);	
};

function displayAllTabs(){
	let tabs = document.getElementsByClassName("woocommerce-tabs");
	if (tabs.length > 0){
		tabs = tabs[0].getElementsByClassName("wc-tab");
		for (var i = 0; i < tabs.length; i++) {
			tabs[i].style.display = "block";
		}
	}
}

(function($){

    // Initialize each block on page load (front end).
    $(document).ready(function(){
    	if($(".commentlist").length > 0){
    		
    		// Display reviews in slide show
    		$(".commentlist").slick({
	   			slidesToShow: 2,
	   			slidesToScroll: 2,
	   			dots: true,
	            adaptiveHeight: true,
	            speed: 500,
	            responsive: [
	            	{
	            		breakpoint: 768,
	            		settings: {
	            			slidesToShow: 1,
	            			slidesToScroll: 1,
	            		} 
	            	}
	            ]
        	});

        	// Add review button
        	if ($("#review_form_wrapper")) {
        		
        		// Add review button
        		$("#reviews").append(
        			`<a class="button" id="review-form-btn"> Add Review </a>`
        		);

        		// show form on click
        		$("#reviews").delegate(
        			$("#review-form-btn"), "click", function() {
        				$("#review-form-btn").css("display","none");
						$("#review_form_wrapper").css("height", "auto");
						
				});

        	}
    	}
   		
    });

})(jQuery);


/* Old Code */


// window.onscroll = function() {
// 	growShrinkLogo();
// };

// window.onload = function(){

// 	growShrinkLogo();
// 	updatePersonalisedMessage();
// 	updateVarForm();

// 	// Product pages
// 	if (document.body.classList.contains("product-template-default")){
// 		 insertReviewButton();
// 	}

// 	// Event Listeners
// 	// document.addEventListener( "scroll", vimeoScrollHack );

// };

// window.resize = function(){
// 	growShrinkLogo();
// 	updatePersonalisedMessage();
// 	updateVarForm();
// };

// // Media Query 

// function growShrinkLogo() {
// 	var logo = document.getElementById("firewok-logo");
// 	var header = document.getElementById("masthead");

// 	if ((document.body.scrollTop > 5) || 
// 		(document.documentElement.scrollTop > 5) || 
// 		(window.matchMedia("(max-width: 768px)").matches === true)
// 		){
// 		logo.style.width = '50px';
// 		header.classList.add("scrolled");
// 	} 
// 	else {
// 		if (window.matchMedia("(max-width: 768px)").matches === false) {
// 			logo.style.width = '100px';
// 		}
// 		header.classList.remove("scrolled");
// 	}
// }

// function mainMargin() {
// 	var header = document.getElementById("masthead");
// 	var content =  document.getElementById("main");
// 	var headerHeight = header.offsetHeight;

// 	/*content.style.marginTop = headerHeight+40+"px";*/

// }




// /*

// Varible product page

// */

// /* Personal Message */

// function updatePersonalisedMessage(){

// 	var pers = document.getElementById("personalised");
// 	var savedMessage = "";

// 	// Initiate function
// 	if (pers !== null){
// 		// on load
// 		togglePersonalised(pers,savedMessage);
// 		// on selector change
// 		pers.addEventListener("change", function(){
// 			togglePersonalised(pers,savedMessage);
// 		});
// 	}

// }

// function togglePersonalised(p,m) {
// 	// check value
// 	var val = p.value;
// 	var message = document.getElementById("alg-product-input-fields-table");
// 	var messageInput = document.getElementById("alg_wc_pif_local_1");
// 	if (val == "Yes") {
// 		messageInput.value = m;
// 		if (!message.classList.contains("curtainIn")) {
// 			message.classList.toggle("curtainIn");	
// 		}			
// 	}
// 	else{
// 		if (message.classList.contains("curtainIn")) {
// 			message.classList.toggle("curtainIn");
// 		}
// 		savedMessage = messageInput.value;
// 		messageInput.value = "";
// 	}
// }


// function updateVarForm() {
// 	var varForm = document.getElementsByClassName("variations_form");
// 	if (varForm.length !== 0) {
// 		// Update initial price
// 		updateVarPrice();
// 		var selectors = document.querySelectorAll(".variations select");
// 		for (var i = selectors.length - 1; i >= 0; i--) {
// 			// Update price on change
// 			selectors[i].addEventListener("change", function(){
// 				updateVarPrice();
// 			});
// 		}
// 	}
// }


// function updateVarPrice(){
// 	var t = 0;
// 	var checkPrice = setInterval( function(){
// 		var summaryPrice = document.querySelectorAll(".summary p.price");
// 		var variationPrice = document.querySelectorAll(".woocommerce-variation-price span.price span.amount");
// 		if (variationPrice.length !== 0) {
// 			if (summaryPrice[0].textContent !== variationPrice[0].lastChild.textContent) {
// 				summaryPrice[0].textContent = "£"+variationPrice[0].lastChild.textContent;
// 				window.clearInterval(checkPrice);
// 			}
// 		}
// 		if (t > 5){
// 			window.clearInterval(checkPrice);
// 			//console.log("tock");
// 		}	
// 		t++;
// 		//console.log(t);	 
// 	},200);	
// }

// function insertReviewButton(){

// 	// Create button

// 	var container = document.createElement("div");
// 	container.className = "add-review-container";

// 	var btn = document.createElement("button");
// 	btn.id = "add-review-btn";

// 	var label = document.createTextNode("Add A Review");

// 	btn.appendChild(label);
// 	container.appendChild(btn);

// 	// Insert button
// 	var reviews = document.getElementById("reviews");
// 	reviews.insertBefore(container, reviews.childNodes[2]); // after comments before form

// 	// Assign listener 
// 	btn.addEventListener("click",function() {
// 		console.log("I want to review this");
// 		showReviewForm();
// 	} );

// }

// function showReviewForm(){

// 	// Show form
// 	var reviewForm = document.getElementById("review_form_wrapper");
// 	console.log(reviewForm);
// 	reviewForm.style.height = "auto";

// 	// Hide Button
// 	//var reviewBtn = document.getElementById("add-review-btn");
// 	var reviewBtn = document.getElementsByClassName("add-review-container")[0];
// 	console.log(reviewBtn);
// 	reviewBtn.style.display = "none";

// }

// function showAllReviews() {
// 	var reviews = document.querySelectorAll("#reviews .commentlist");
// 	reviews.classList.add("showall");
// }

// function vimeoScrollHack() {
// 	console.log("scrolling");
// 	// While scrolling 
// 		// Change (".embed-container iframe")style.pointer-events = none;  

// 	// else {
// 		// pointer-events = auto
// 	// } 
// }

