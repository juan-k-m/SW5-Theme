$.subscribe('plugin/swCollapseCart/onMenuOpen',function(){
  //remove fix class
$('#jk-navigation').removeClass('jk-fixed');
});

$.subscribe('plugin/swCollapseCart/onCloseMenu',function(){
  //add fix class
$('#jk-navigation').addClass('jk-fixed');
});

//when the overlay element is Clicked and closes element
$.subscribe('plugin/swOffcanvasMenu/onCloseMenu', function(){
  //verify if class exists and when so add fix class
  if ($('#jk-navigation').length > 0) {
    $('#jk-navigation').addClass('jk-fixed');
  }
});
