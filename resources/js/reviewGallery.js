window.onOpenGalleryDialog = function(galleryId, imageSrc, imageAlt) {
  var dialog = document.getElementById('review-gallery-dialog-' + galleryId);

  var mainImageElem = document.getElementById('review-gallery-main-image');
  mainImageElem.src = imageSrc;
  mainImageElem.alt = imageAlt;

  dialog.style="";
}

window.onCloseGalleryDialog = function(galleryId) {
  var dialog = document.getElementById('review-gallery-dialog-' + galleryId);

  dialog.style="display: none;";
}