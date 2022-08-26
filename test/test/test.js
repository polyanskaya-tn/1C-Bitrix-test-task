BX.namespace('BX.My.MyAjax');

(function() {
	'use strict';

    BX.My.MyAjax = {

        init: function(parameters)
		{
            this.ajaxUrl = parameters.ajaxUrl || '';
        },

        ajaxGetDiscount: function() {
            
            $.ajax({
                type: "POST",
                url: this.ajaxUrl,
                dataType: "html",
                data: {"AJAX": "Y", "action": "GetDiscount"},
                success: function (data) {
                    var obj;
                    obj = JSON.parse(data);
                    $('#discount').html(obj['discount']);
                    $('#discode').html(obj['discode']);
                }
            });
        }
    }

})();




