import $ from 'jquery';

$('.c-navigation')
  .on('mouseenter', '.menu-item-has-children', (e) => {
    $(e.currentTarget).addClass('open');
  })
  .on('mouseleave', '.menu-item-has-children', (e) => {
    $(e.currentTarget).removeClass('open');
  });

$('.c-navigation').on('click', '.menu .menu-button', (e) => {
  e.preventDefault();
  let menu_button = $(e.currentTarget);
  let menu_link = menu_button.parent();
  let menu_item = menu_link();
  if (menu_item.hasClass('open')) {
  } else {
    menu_item.addClass('open');
    menu_link.attr('aria-button-show', 'true');
    menu_button.find('.menu-button-show').attr('aria-hidden', 'true');
    menu_button.find('.menu-button-hide').attr('aria-hidden', 'true');
  }
});
