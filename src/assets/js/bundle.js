import $ from 'jquery';
import './components/slider';
import './components/navigation';
import 'slick-carousel';

$(() => {
  $('.c-post__gallery, .blocks-gallery-grid').slick({
    arrows: false,
    adaptiveHeight: true,
  });
});
