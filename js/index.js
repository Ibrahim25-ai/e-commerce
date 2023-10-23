const $megamenuParentListItem = $('.megamenu-nav > li.is-parent');

const $megamenuBackground = $('#megamenu-background');

const isTouch = 'ontouchstart' in window || !!navigator.msMaxTouchPoints;

const handleMenuItemOpenState = elem => {
  elem.addClass('is-open');
  elem.find('a').first().attr('aria-expanded', true);
};

const handleMenuItemCloseState = elem => {
  elem.removeClass('is-open');
  elem.find('a').first().attr('aria-expanded', false);
};

const openMegamenu = (bgElem, heightVal) => {
  $('body').addClass('megamenu-visible');
  bgElem.height(heightVal);
};

const closeMegamenu = (bgElem, heightVal) => {
  $('body').removeClass('megamenu-visible');
  bgElem.height(heightVal);
};

const $megamenuContentElem = $('.megamenu-nav .megamenu-content');

const getTallestMenuHeight = () => {
  let maxHeight = 0;
  $megamenuContentElem.each((index, item) => {
    if ($(item).outerHeight() > maxHeight) {
      maxHeight = $(item).outerHeight();
    }
  });
  return maxHeight;
};

const debouncedClose = _.debounce(closeMegamenu, 400);
const throttledContentHeightCount = _.throttle(getTallestMenuHeight, 100);

let megamenuContentMaxHeight = 0;

window.onresize = () => {
  megamenuContentMaxHeight = throttledContentHeightCount();
};

$(() => {
  megamenuContentMaxHeight = getTallestMenuHeight();

  $megamenuParentListItem.each((index, item) => {
    if (!isTouch) {
      $(item).hoverIntent({
        sensitivity: 10,
        interval: 50,
        over: () => {
          debouncedClose.cancel();
          $megamenuParentListItem.removeClass('is-open');
          handleMenuItemOpenState($(item));
          openMegamenu($megamenuBackground, megamenuContentMaxHeight);
        },
        out: () => {
          handleMenuItemCloseState($(item));
          debouncedClose($megamenuBackground, 0);
        } });

    }

    $(item).find('a').first().on('click touch', () => {
      if (!$(item).hasClass('is-open')) {
        $megamenuParentListItem.removeClass('is-open');
        handleMenuItemOpenState($(item));
        openMegamenu($megamenuBackground, megamenuContentMaxHeight);
      } else {
        handleMenuItemCloseState($(item));
        closeMegamenu($megamenuBackground, 0);
      }
    });
  });

  $('#megamenu-dim').on('click touch', e => {
    if ($('body').hasClass('megamenu-visible')) {
      e.preventDefault();
      $megamenuParentListItem.removeClass('is-open');
      closeMegamenu($megamenuBackground, 0);
    }
  });
});