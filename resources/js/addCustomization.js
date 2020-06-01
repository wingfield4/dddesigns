window.optionCount = 1;

window.onAddOption = function() {
  window.optionCount++;

  var optionContainer = document.getElementById('options-container-' + window.optionCount);
  optionContainer.style = '';
}

window.onDeleteOption = function(optionNumber) {
  var optionContainer = document.getElementById('options-container-' + optionNumber);
  optionContainer.style = 'display: none;';

  var optionTitle = document.getElementById('option-' + optionNumber + '-title');
  optionTitle.value = '';

  var optionDescription = document.getElementById('option-' + optionNumber + '-description');
  optionDescription.value = '';

  var optionPrice = document.getElementById('option-' + optionNumber + '-price');
  optionPrice.value = '';
}

window.onChangeCustomizationTypeId = function(selectObject) {
  var customizationTypeId = selectObject.value;

  var containers = document.getElementsByName('customization-container');
  for(var i = 0; i < containers.length; i++)
  {
    containers[i].style = 'display: none;';
  }

  var elem = document.getElementById('customization-type-' + customizationTypeId + '-container');
  elem.style = '';
}

window.onInitializeCustomizationType = function(customizationTypeId) {
  var elem = document.getElementById('customization-type-' + customizationTypeId + '-container');
  elem.style = '';
}

window.addOption = function(option) {
  var optionContainer = document.getElementById('options-container-' + window.optionCount);
  optionContainer.style = '';

  var titleElem = document.getElementById('option-' + window.optionCount + '-title');
  titleElem.value = option.title;

  var descriptionElem = document.getElementById('option-' + window.optionCount + '-description');
  descriptionElem.value = option.description;

  var priceElem = document.getElementById('option-' + window.optionCount+ '-price');
  priceElem.value = option.price;

  window.optionCount++;
}