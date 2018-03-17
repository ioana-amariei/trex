function selectCurrentDisplayType(displayType, classToAdd, classToRemove) {
  var displayTypes = document.getElementsByClassName("selected-display-type");

  var index;
  for(index=0; index < displayTypes.length; index++){
    displayTypes[index].classList.remove("selected-display-type");
  }

  displayType.classList.add("selected-display-type");

  var resources = document.getElementsByClassName("resource");

  for(index=0; index < resources.length; index++){
    resources[index].classList.remove(classToRemove);
    resources[index].classList.add(classToAdd);
  }
}
