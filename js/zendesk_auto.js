/*Automatic popup of zopim live chat only for desktop view delay set to 15 sec*/
	if (window.innerWidth > 1000) { 
	window.setTimeout(function() {
    $zopim(function() {
		var audio = new Audio("https://k21academy.com/wp-content/uploads/2021/11/new_chat.mp3");
audio.play();
    $zopim.livechat.window.show();
        }); },15000);
	}
/*End of the Script*/

/* Whatsapp chat widget*/ 
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?22338';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#4dc247",
      "ctaText":"",
      "borderRadius":"25",
      "marginLeft":"20",
      "marginBottom":"10",
      "marginRight":"30",
      "position":"left"
  },
  "brandSetting":{
      "brandName":"K21 Academy",
      "brandSubTitle":"We typically reply within a few minutes",
      "brandImg":"https://k21academy.com/wp-content/uploads/2022/01/K21_social_logo.png",
      "welcomeText":"Have a question? Connect with us on WhatsApp...",
      "messageText":"Hello, I have a question about {{page_link}}",
      "backgroundColor":"#0a5f54",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"917427897876"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
