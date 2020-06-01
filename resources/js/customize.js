// window.onChangePrice = function(selectObject) {
//   var value = selectObject.value;

//   var item = window.item;
//   console.log('item', item);
//   var customizations = item.customizations;

//   var customization;
//   var option;
//   if(customizations) {
//     for(var i = 0; i < customizations.length; i++) {
//       if(customizations[i].options) {
//         for(var j = 0; j < customizations[i].options; j++) {
//           if(customization.options[j].id === value) {
//             customization = customizations[i];
//             option = customization.options[j];
//           }
//         }
//       }
//     }
//   }

//   var priceElement = document.getElementById('price-' + customization.id);
//   priceElement.innerHTML = "$" + option.price;
//   //var selects = document.getElementsByName('customization-select');
// }

// window.onChangePrice = function(select) {
//   var value = select.value;
//   var values = value.split(',');
//   var customizationId = values[0];
//   var optionId = values[0];
//   var price = values[2];
//   console.log('id', id);
//   console.log('price', price);

//   var priceElement = document.getElementById('price-' + customizationId);
//   priceElement.innerHTML = "$" + price;
// }

window.onSelectChange = function(customizationId, selectObject) {
  var optionId = selectObject.value;

  if(optionId === 'custom') {
    //UPDATE RECEIPT
    var priceElement = document.getElementById('price-' + customizationId);
    priceElement.innerHTML = 'TBD';
    var optionTitleObject = document.getElementById('option-title-' + customizationId);
    optionTitleObject.innerHTML = 'Custom';

    //SHOW CUSTOM INPUT
    var inputContainerElem = document.getElementById('select-' + customizationId + '-custom-container');
    inputContainerElem.style = '';

    var inputElem = document.getElementById('select-' + customizationId + '-custom');
    inputElem.required = true;
  } else {
    var option;
    for(var i = 0; i < window.options.length; i++) {
      if(window.options[i].id === parseInt(optionId, 10)) {
        option = window.options[i];
      }
    }
  
    if(option) {
      //UPDATE RECEIPT
      var priceElement = document.getElementById('price-' + customizationId);
      priceElement.innerHTML = option.price ? "$" + option.price : 'TBD';
      var optionTitleObject = document.getElementById('option-title-' + customizationId);
      optionTitleObject.innerHTML = option.title;

      //hide custom input
      var inputContainerElem = document.getElementById('select-' + customizationId + '-custom-container');
      inputContainerElem.style = 'display: none;';
      var inputElem = document.getElementById('select-' + customizationId + '-custom');
      inputElem.required = false;
    }
  }

  window.updateTotalPrice();
}

window.updateTotalPrice = function() {
  var selects = document.getElementsByTagName('select');

  var price = 0.00;
  for(var i = 0; i < selects.length; i++) {
    var optionId = selects[i].value;

    if(optionId) {
      var option;
      for(var i = 0; i < window.options.length; i++) {
        if(window.options[i].id === parseInt(optionId, 10)) {
          option = window.options[i];
        }
      }

      if(option && option.price) {
        price += parseFloat(option.price);
      }
    }
  }

  var totalPrice = price + parseFloat(window.item.price);
  var totalPriceObject = document.getElementById('total-price');
  totalPriceObject.innerHTML = '$' + totalPrice.toFixed(2);
}

window.onSubmit = function() {
  var submitButton = document.getElementById('submit');
  submitButton.disabled = true;

  var loadingOverlay = document.getElementById('loading-overlay');
  loadingOverlay.style = '';
  loadingOverlay.className = 'loading-overlay';
}