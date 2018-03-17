function selectCurrentDisplayType(displayType) {
  var displayTypes = document.getElementsByClassName("selected-display-type");

  var index;
  for(index=0; index < displayTypes.length; index++){
    displayTypes[index].classList.remove("selected-display-type");
  }

  displayType.classList.add("selected-display-type");
}
