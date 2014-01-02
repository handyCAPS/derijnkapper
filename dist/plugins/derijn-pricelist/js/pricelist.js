/*! nieuwerijn - v0.0.0 - 2014-01-02
* Copyright (c) 2014 ; Licensed  */
!function(a){a(document).ready(function(){function b(b){b.preventDefault();var c=a("#dienst")[0],d=a("#price")[0],e=d.value.replace(".",","),f={action:"derijn_pricelist",name:c.value,price:e};a.post(ajaxurl,f,function(b){a("#load").html(b)}),c.value="",d.value=""}var c=a("#pricelistSave");c.click(b)})}(jQuery);