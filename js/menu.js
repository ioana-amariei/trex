function selectCurrentMenuItem(menuItem){
  var menuItems = document.getElementsByClassName("selected-menu-option");

  var index;
  for(index = 0; index < menuItems.length; index++){
    menuItems[index].classList.remove("selected-menu-option");
  }

  menuItem.classList.add("selected-menu-option");
}
