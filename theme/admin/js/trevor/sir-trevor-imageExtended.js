/*
 * Extended Image Block
 * 2014 Ændrew Rininsland <aendrew.rininsland@the-times.co.uk>
 * Based on neyre/sir-trevor-wp's ImageCaption.js block.
 */
(function() {
  SirTrevor.Blocks.ImageExtended = SirTrevor.Blocks.Image.extend({
  type: "image_extended",
  title: function() { return i18n.t('blocks:image:title'); },
  droppable: true,
  uploadable: true,
  icon_name: 'image',
  loadData: function(data){
  // Create our image tag
  this.$editor.html($('<img>', { src: data.file.url })).show();
  this.$editor.append($('<label class="editlabel" for="alt">Image Alt Text:</label>'));
  this.$editor.append($('<input>', {type: 'text', class: 'st-input-string js-caption-input', name: 'caption', placeholder: '', style: 'width: 100%; margin-top:10px; text-align: center;', value: data.caption}));
  this.$editor.append($('<label class="editlabel" for="link">Link to page or file? include "http://" (leave empty for none):</label>'));
  this.$editor.append($('<input>', {type: 'text', class: 'st-input-string js-source-input', name: 'source', placeholder: 'http://', style: 'width: 100%; margin-top:10px; text-align: center;', value: data.source}));},
  onBlockRender: function(){
  /* Setup the upload button */
  this.$inputs.find('button').bind('click', function(ev){ ev.preventDefault(); });
  this.$inputs.find('input').on('change', _.bind(function(ev){
  this.onDrop(ev.currentTarget);
  }, this));
  },
  onDrop: function(transferData){
  var file = transferData.files[0],
  urlAPI = (typeof URL !== "undefined") ? URL : (typeof webkitURL !== "undefined") ? webkitURL : null;
  // Handle one upload at a time
  if (/image/.test(file.type)) {
  this.loading();
  // Show this image on here
  this.$inputs.hide();
  this.loadData({file: {url: urlAPI.createObjectURL(file)}});
  this.uploader(
  file,
  function(data) {
  this.setData(data);
  this.ready();
  },
  function(error){
  this.addMessage(i18n.t('blocks:image:upload_error'));
  this.ready();
  }
  );
  }
  }
  });
}).call(this);
