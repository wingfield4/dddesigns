window.selectImage = function (id, path) {
  var miniImage = document.getElementById('mini-image-' + id);
  var mainImage = document.getElementById('main-image');
  var miniImages = document.getElementsByName('mini-image');

  for(var i = 0; i < miniImages.length; i++) {
    miniImages[i].setAttribute('class', 'mini-image');
  }
  mainImage.setAttribute('src', path);
  miniImage.setAttribute('class', 'mini-image active');
}

window.openImage = function() {
  var mainImage = document.getElementById('main-image');
  window.open(mainImage.getAttribute('src'));
}

window.onSelectTab = function(tabNumber) {
  var tabs = document.getElementsByName('tab');
  for(var i = 0; i < tabs.length; i++) {
    tabs[i].className = tabs[i].className.replace(' tab-active', '');
  }

  var tab = document.getElementById('tab-' + tabNumber);
  tab.className = tab.className + ' tab-active';

  var contents = document.getElementsByName('tab-content');
  for(var i = 0; i < contents.length; i++) {
    contents[i].className = 'hidden';
  }

  var activeContent = document.getElementById('tab-content-' + tabNumber);
  activeContent.className = '';
}