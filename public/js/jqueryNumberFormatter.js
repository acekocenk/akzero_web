(function($) {
    $.fn.numberFormatter = function(options) {
      const settings = $.extend({
        thousandSeparator: ',',
        decimalSeparator: '.'
      }, options);
  
      return this.each(function() {
        const $input = $(this);
        $input.on('input', function() {
          let value = $input.val().replace(/\D/g, '');
          const decimalIndex = value.indexOf(settings.decimalSeparator);
          const integerPart = decimalIndex > -1 ? value.slice(0, decimalIndex) : value;
          const integerPartWithSeparator = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, settings.thousandSeparator);
          const formattedValue = decimalIndex > -1 ? integerPartWithSeparator + settings.decimalSeparator + value.slice(decimalIndex + 1) : integerPartWithSeparator;
          $input.val(formattedValue);
        });
  
        $input.on('blur', function() {
          let value = $input.val();
          value = value.replace(new RegExp('\\' + settings.thousandSeparator, 'g'), '');
          value = value.replace(settings.decimalSeparator, '.');
  
          if (!isNaN(value)) {
            const formattedValue = parseFloat(value).toLocaleString('en-US', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
  
            $input.val(formattedValue);
          }
        });
      });
    };
  }(jQuery));

  