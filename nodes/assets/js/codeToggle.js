console.log('msg in codeToggle.js');

var togBtn = '<p class="toggler" style="margin:0;margin-bottom:-12px;padding:0;text-align:center;background-color: #f8f8f8;">\n\
              ----------------- <input type="button" value="展开代码" readonly/> --------------\n\
          </p>';

$('code').parent().before(togBtn);
$('code').parent().addClass('hidden');

$('body').delegate('.toggler input', 'click', function() {
  var _code = $(this).parent().next();
  _code.slideToggle('slow').toggleClass('flag');
  if (!_code.hasClass('flag')) {
    $(this).val('展开代码');
  } else {
    $(this).val('隐藏代码');
  }
});