$(function()
{
    $(".btnClickTest").click(function () {

        var d = {"var1": "asdf", "var2": "222asdf"};
        $.ajax({
            type: 'POST',
            url: '/contact/sendFrm',
            data: d,
            success: function(data) {
                alert(data);
            }
        });
    });

});