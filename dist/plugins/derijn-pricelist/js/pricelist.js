/*! nieuwerijn - v0.0.0 - 2014-01-27
* Copyright (c) 2014 ; Licensed  */
!function(a){a(document).ready(function(){function b(b){b.preventDefault();var e=a("#dienst")[0],f=a("#price")[0],g=a("#order")[0],h=e.value,i=f.value,j=g.value,k={action:"derijn_pricelist",name:h,price:i,ordering:j};a.post(ajaxurl,k,function(b){a("#priceTableUpdate").html(b),a(".update-button").click(c),a(".delete-button").click(d)}),e.value="",f.value="",g.value="",e.focus()}function c(){var b=a(this).parent()[0].id,e="#"+b+"-name",f="#"+b+"-price",g="#"+b+"-ordering",h=a(e)[0].value,i=a(f)[0].value,j=a(g)[0].value,k={action:"derijn_update_pricelist",name:h,price:i,ordering:j,id:b},l=a("#priceTableUpdate");a(this).addClass("ajaxing"),a.post(ajaxurl,k,function(b){l.html(b),a(".update-button").click(c),a(".delete-button").click(d)})}function d(){var b=a(this).parent()[0].id,e={action:"derijn_delete_pricelist",priceid:b};confirm("Zeker weten ?")&&a.post(ajaxurl,e,function(b){a("#priceTableUpdate").html(b),a(".update-button").click(c),a(".delete-button").click(d)})}var e=a("#pricelistSave"),f=a(".update-button"),g=a(".delete-button");e.click(b),f.click(c),g.click(d),a("#priceTableUpdate").keypress(function(b){if(13===b.which){var c=b.target.parentNode.id,d="#"+c+" .update-button";a(d).trigger("click")}})})}(jQuery);