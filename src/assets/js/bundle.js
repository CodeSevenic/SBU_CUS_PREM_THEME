import $ from 'jquery';
import './components/slider';
import './components/navigation';
import 'slick-carousel';

$(() => {
  // $('.c-post__gallery, .blocks-gallery-grid').slick({
  //   arrows: false,
  //   adaptiveHeight: true,
  // });
  $('.most_recent_widget').slick();

  wp.customize.selectiveRefresh.bind(
    'partial-content-rendered',
    (placement) => {
      console.log(placement);
      if (
        placement.partial.widgetParts &&
        placement.partial.widgetParts.idBase === '_themename_mst_recent_widget'
      ) {
        placement.container.find('.most_recent_widget').slick();
      }
    }
  );
});
