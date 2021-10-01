import $ from 'jquery';
import strip_tags from './helpers/strip-tags';

console.log(wp);

wp.customize('blogname', (value) => {
  value.bind((to) => {
    $('.c-header__blogname').html(to);
  });
});

console.log(_themename);

wp.customize('_themename_accent_color', (value) => {
  value.bind((to) => {
    $('#_themename-stylesheet-inline-css').html(_themename.x);
  });
});

wp.customize('_themename_site_info', (value) => {
  value.bind((to) => {
    $('.c-site-info__text').html(strip_tags(to, '<a>'));
  });
});
