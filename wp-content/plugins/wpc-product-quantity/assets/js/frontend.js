'use strict';

var woopq_timeout = null;

jQuery(document).on('ready', function() {
  woopq_init_qty();
});

jQuery(document).on('found_variation', function(e, t) {
  woopq_init_qty();
});

jQuery(document).on('woosq_loaded', function() {
  woopq_init_qty();
});

jQuery(document).on('keyup', '.woopq-quantity .qty', function() {
  var $this = jQuery(this);

  if (woopq_timeout != null) clearTimeout(woopq_timeout);
  woopq_timeout = setTimeout(woopq_check_qty, 1000, $this);
});

jQuery(document).
    on('click touch', '.woopq-quantity-input-plus, .woopq-quantity-input-minus',
        function() {
          // get values
          var $qty = jQuery(this).
                  closest('.woopq-quantity-input').
                  find('.qty'),
              qty_val = parseFloat($qty.val()),
              max = parseFloat($qty.attr('max')),
              min = parseFloat($qty.attr('min')),
              step = $qty.attr('step');

          // format values
          if (!qty_val || qty_val === '' || qty_val === 'NaN') {
            qty_val = 0;
          }

          if (max === '' || max === 'NaN') {
            max = '';
          }

          if (min === '' || min === 'NaN') {
            min = 0;
          }

          if (step === 'any' || step === '' || step === undefined ||
              parseFloat(step) === 'NaN') {
            step = 1;
          } else {
            step = parseFloat(step);
          }

          // change the value
          if (jQuery(this).is('.woopq-quantity-input-plus')) {
            if (max && (
                max == qty_val || qty_val > max
            )) {
              $qty.val(max);
            } else {
              $qty.val((qty_val + step).toFixed(woopq_decimal_places(step)));
            }
          } else {
            if (min && (
                min == qty_val || qty_val < min
            )) {
              $qty.val(min);
            } else if (qty_val > 0) {
              $qty.val((qty_val - step).toFixed(woopq_decimal_places(step)));
            }
          }

          // trigger change event
          $qty.trigger('change');
        });

function woopq_init_qty() {
  jQuery('.woopq-quantity').each(function() {
    var _this = jQuery(this);
    var _min = _this.attr('data-min');
    var _max = _this.attr('data-max');
    var _step = _this.attr('data-step');

    _this.find('.qty').
        attr('min', _min).
        attr('max', _max).
        attr('step', _step).
        trigger('change');
  });
}

function woopq_check_qty($qty) {
  var val = parseFloat($qty.val());
  var min = parseFloat($qty.attr('min'));
  var max = parseFloat($qty.attr('max'));
  var step = parseFloat($qty.attr('step'));
  var fix = Math.pow(10, Number(woopq_decimal_places(step)) + 1);

  if ((val === '') || isNaN(val)) {
    val = 0;
  }

  if ((step === '') || isNaN(step)) {
    step = 1;
  }

  var remainder = woopq_float_remainder(val, step);

  if (remainder >= 0) {
    val = Math.round((val - remainder) * fix) / fix;
  }

  if (!isNaN(min) && (
      val < min
  )) {
    val = min;
  }

  if (!isNaN(max) && (
      val > max
  )) {
    val = max;
  }

  $qty.val(val);
}

function woopq_decimal_places(num) {
  var match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);

  if (!match) {
    return 0;
  }

  return Math.max(
      0,
      // Number of digits right of decimal point.
      (match[1] ? match[1].length : 0)
      // Adjust for scientific notation.
      - (match[2] ? +match[2] : 0));
}

function woopq_float_remainder(val, step) {
  var valDecCount = (val.toString().split('.')[1] || '').length;
  var stepDecCount = (step.toString().split('.')[1] || '').length;
  var decCount = valDecCount > stepDecCount ? valDecCount : stepDecCount;
  var valInt = parseInt(val.toFixed(decCount).replace('.', ''));
  var stepInt = parseInt(step.toFixed(decCount).replace('.', ''));
  return (valInt % stepInt) / Math.pow(10, decCount);
}