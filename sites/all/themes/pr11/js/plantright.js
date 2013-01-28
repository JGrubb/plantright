// $Id: tao.js,v 1.1.2.1 2010/09/28 19:39:45 yhahn Exp $

Drupal.behaviors.tao = function (context) {
  $('fieldset.collapsible:not(.tao-processed) > legend > .fieldset-title').each(function() {
    var fieldset = $(this).parents('fieldset').eq(0);
    fieldset.addClass('tao-processed');

    // Expand any fieldsets containing errors.
    if ($('input.error, textarea.error, select.error', fieldset).size() > 0) {
      $(fieldset).removeClass('collapsed');
    }

    // Add a click handler for toggling fieldset state.
    $(this).click(function() {
      if (fieldset.is('.collapsed')) {
        $(fieldset).removeClass('collapsed').children('.fieldset-content').show();
      }
      else {
        $(fieldset).addClass('collapsed').children('.fieldset-content').hide();
      }
      return false;
    });
  });
  $('body#page-node-add-business input#edit-title').change(function(){
    $('span.nursery-name').text($(this).val()); 
 });
};

jQuery(document).ready(function($) {
  $('#page-node-add-survey-photos input.form-radio').click(function() {
    $code = $(this).siblings('span.views-field-field-store-code-value').children('.field-content').html();
    //console.log($code);
    $('input#edit-title').val($code);
  });
  $('#page-node-add-survey-photos input#edit-field-survey-image-field-survey-image-add-more').val('Add another photo');
  $('.folded').hide();
  $('h3.fold').click(function() {
    $(this).toggleClass('open');
    $(this).next('.folded').toggle();
  });
  $('.testimonial-nav a').each(function(){
    if (this.href === window.location.href) {
      this.className += ' active';
    }
  });
  $('#progress-block .dropdown').hide();
  $('#progress-block a.dropdown-toggle').click(function(e) {
    console.log(this);
    $(this).toggleClass('expanded');
    $(this).next('.dropdown').toggle();
    e.preventDefault();
  });
  $('#tabbed .tab-content:not(:first)').hide();
  $('#tabbed h3:first').addClass('active');
  $('#tabbed h3').click(function(){
    var boxHeight, 
        thisId = this.id;
    $('#tabbed h3.active').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();
    $('.tab-content.' + thisId).show();
    boxHeight = $('.tab-content.' + thisId).outerHeight();
    $('#tab-box').height(boxHeight);
  });
  $('#block-admin-account li:eq(1)').remove();
});
